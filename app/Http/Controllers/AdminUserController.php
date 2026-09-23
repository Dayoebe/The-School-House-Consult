<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', 'in:member,admin'],
        ]);

        abort_if($user->is(auth()->user()) && $validated['role'] !== 'admin', 422, 'You cannot remove your own admin access.');

        $user->update(['role' => $validated['role']]);

        return back()->with('status', $user->name.' is now '.$validated['role'].'.');
    }
}
