<?php

namespace App\Http\Controllers;

use App\Models\ConsultationRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminInboxController extends Controller
{
    public function updateConsultationStatus(Request $request, ConsultationRequest $consultation): RedirectResponse
    {
        $validated = $request->validate(['status' => ['required', 'in:new,in-progress,resolved,archived']]);
        $consultation->status = $validated['status'];
        $consultation->save();

        return back()->with('status', 'Consultation request status updated.');
    }

    public function updateMessageStatus(Request $request, ContactMessage $message): RedirectResponse
    {
        $validated = $request->validate(['status' => ['required', 'in:new,in-progress,resolved,archived']]);
        $message->status = $validated['status'];
        $message->save();

        return back()->with('status', 'Contact message status updated.');
    }

    public function destroyConsultation(ConsultationRequest $consultation): RedirectResponse
    {
        $consultation->delete();

        return back()->with('status', 'Consultation request deleted.');
    }
}
