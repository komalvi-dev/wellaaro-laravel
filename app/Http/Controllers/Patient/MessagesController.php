<?php

namespace App\Http\Controllers\Patient;

use App\Models\Inquiry;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends BaseController
{
    public function index(int $inquiryId)
    {
        $inquiry = $this->patientProfile->inquiries()->findOrFail($inquiryId);
        $conversation = $inquiry->conversation()->with('messages.sender')->firstOrFail();

        return view('patient.messages.index', compact('inquiry', 'conversation'));
    }

    public function store(Request $request, int $inquiryId)
    {
        $inquiry = $this->patientProfile->inquiries()->findOrFail($inquiryId);
        $conversation = $inquiry->conversation()->firstOrFail();

        $request->validate(['body' => 'required|string|max:5000']);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_user_id'  => auth()->id(),
            'body'            => $request->body,
            'message_type'    => 'text',
        ]);

        return redirect()->route('patient.inquiries.messages.index', $inquiryId)
            ->with('success', 'Message sent.');
    }
}
