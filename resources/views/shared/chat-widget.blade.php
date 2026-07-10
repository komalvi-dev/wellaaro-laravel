<style>[x-cloak] { display: none !important; }</style>

<div
    x-data="wellaaroChat()"
    x-init="init()"
    id="wellaaro-chat-widget"
    style="position:fixed; bottom:24px; right:24px; z-index:1050;"
>
    <button
        type="button"
        @click="open = !open"
        style="width:56px; height:56px; border-radius:50%; background:#1a6bcc; color:#fff; border:none; box-shadow:0 8px 24px rgba(0,0,0,0.2); display:flex; align-items:center; justify-content:center; font-size:1.4rem;"
        :aria-expanded="open"
        aria-label="Chat with Wellaaro Assistant"
    >
        <i class="bi" :class="open ? 'bi-x-lg' : 'bi-chat-dots-fill'"></i>
    </button>

    <div
        x-show="open"
        x-cloak
        x-transition
        style="position:absolute; bottom:70px; right:0; width:340px; max-width:calc(100vw - 32px); height:460px; max-height:70vh; background:#fff; border-radius:16px; box-shadow:0 12px 40px rgba(0,0,0,0.2); display:flex; flex-direction:column; overflow:hidden;"
    >
        <div style="background:#1a6bcc; color:#fff; padding:0.9rem 1rem;">
            <div class="fw-semibold">{{ __('Wellaaro Assistant') }}</div>
            <div class="small" style="opacity:0.85;">{{ __('Ask about treatments, hospitals & costs') }}</div>
        </div>

        <div x-ref="scrollArea" style="flex:1; overflow-y:auto; padding:0.75rem; background:#f8fafc;">
            <template x-for="(msg, index) in messages" :key="index">
                <div style="margin-bottom:0.6rem; display:flex;" :style="msg.role === 'user' ? 'justify-content:flex-end;' : 'justify-content:flex-start;'">
                    <div
                        style="max-width:80%; padding:0.5rem 0.75rem; border-radius:12px; font-size:0.875rem; white-space:pre-wrap;"
                        :style="msg.role === 'user' ? 'background:#1a6bcc; color:#fff; border-bottom-right-radius:2px;' : 'background:#fff; color:#374151; border:1px solid #e5e7eb; border-bottom-left-radius:2px;'"
                        x-text="msg.text"
                    ></div>
                </div>
            </template>

            <div x-show="loading" style="display:flex; justify-content:flex-start; margin-bottom:0.6rem;">
                <div style="background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:0.5rem 0.75rem; font-size:0.875rem; color:#9ca3af;">
                    {{ __('Typing…') }}
                </div>
            </div>

            <div x-show="showCta" x-cloak style="margin-top:0.5rem;">
                <a href="{{ route('get_quote') }}" class="btn btn-sm w-100" style="background:#1a6bcc; color:#fff; font-weight:600; border-radius:8px;">
                    {{ __('Get a Free Quote') }}
                </a>
            </div>
        </div>

        <form @submit.prevent="send()" style="display:flex; gap:0.5rem; padding:0.6rem; border-top:1px solid #e5e7eb; background:#fff;">
            <input
                type="text"
                x-model="input"
                placeholder="{{ __('Type your question…') }}"
                style="flex:1; border:1px solid #d1d5db; border-radius:8px; padding:0.45rem 0.6rem; font-size:0.875rem;"
                :disabled="loading"
            >
            <button type="submit" style="background:#1a6bcc; color:#fff; border:none; border-radius:8px; width:40px; display:flex; align-items:center; justify-content:center;" :disabled="loading || !input.trim()">
                <i class="bi bi-send-fill"></i>
            </button>
        </form>
    </div>
</div>

<script>
    function wellaaroChat() {
        return {
            open: false,
            input: '',
            loading: false,
            showCta: false,
            messages: [
                { role: 'assistant', text: "{{ __('Hi! I can help with questions about treatments, hospitals, packages and costs. What would you like to know?') }}" }
            ],

            init() {},

            scrollToBottom() {
                this.$nextTick(() => {
                    const el = this.$refs.scrollArea;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            },

            async send() {
                const text = this.input.trim();
                if (!text || this.loading) return;

                this.messages.push({ role: 'user', text: text });
                this.input = '';
                this.loading = true;
                this.scrollToBottom();

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch('{{ route('chat.respond') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify({ message: text }),
                    });

                    if (!response.ok) {
                        throw new Error('Request failed');
                    }

                    const data = await response.json();
                    this.messages.push({ role: 'assistant', text: data.reply });
                    this.showCta = !!data.show_cta;
                } catch (e) {
                    this.messages.push({ role: 'assistant', text: "{{ __('Sorry, something went wrong. Please try again or use the Get a Quote form.') }}" });
                } finally {
                    this.loading = false;
                    this.scrollToBottom();
                }
            },
        };
    }
</script>
