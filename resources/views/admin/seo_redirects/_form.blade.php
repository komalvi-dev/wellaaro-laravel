<div class="mb-3">
    <label class="form-label fw-medium">From Path <span class="text-danger">*</span></label>
    <input type="text" name="from_path" value="{{ old('from_path', $redirect->from_path ?? '') }}" class="form-control font-monospace" placeholder="/old-url" required>
    <div class="form-text">The URL path that should be redirected (e.g. /old-page).</div>
</div>
<div class="mb-3">
    <label class="form-label fw-medium">To Path <span class="text-danger">*</span></label>
    <input type="text" name="to_path" value="{{ old('to_path', $redirect->to_path ?? '') }}" class="form-control font-monospace" placeholder="/new-url" required>
    <div class="form-text">The destination URL path (e.g. /new-page or https://...).</div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Redirect Type <span class="text-danger">*</span></label>
        <select name="redirect_type" class="form-select">
            <option value="301" {{ old('redirect_type', $redirect->redirect_type ?? '301') == '301' ? 'selected' : '' }}>301 — Permanent</option>
            <option value="302" {{ old('redirect_type', $redirect->redirect_type ?? '') == '302' ? 'selected' : '' }}>302 — Temporary</option>
        </select>
    </div>
    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                {{ old('is_active', $redirect->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>
</div>
