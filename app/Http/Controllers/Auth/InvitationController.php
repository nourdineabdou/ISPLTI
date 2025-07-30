<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use App\Models\Auth\Invitation;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{

    public function create()
    {
        return view('auth.invitations.create');
    }

    public function edit($id)
    {
        return view('auth.invitations.edit', ['invitation' => Invitation::findOrFail($id)]);
    }

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:invitations,email',
        ]);

        DB::beginTransaction();
        try {
            $token = Str::random(32);

            $invitation = Invitation::create([
                'email' => $request->email,
                'token' => $token,
                'expires_at' => now()->addDays(7),
            ]);

            Mail::to($request->email)->send(new InvitationMail($invitation));
            DB::commit();
            return response()->json([
                'message' => 'Invitation sent successfully.',
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed to send invitation.',
                'success' => false
            ], 500);
        }

    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if ($invitation->is_used || $invitation->isExpired()) {
            return view('auth.invitations.expired', [
                'message' => 'Invalid or expired invitation.',
            ]);
        }

        return view('auth.register', ['email' => $invitation->email, 'token' => $token]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => ['required', 'same:password'],
            'token' => 'required',
        ]);

        $invitation = Invitation::where('token', $request->token)->firstOrFail();

        if ($invitation->is_used || $invitation->isExpired()) {
            return response()->json(['message' => 'Invalid or expired invitation.'], 400);
        }

        User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $invitation->email,
            'password' => bcrypt($request->password),
        ]);

        $invitation->update(['is_used' => true]);

        // login the user
        auth()->attempt($request->only('email', 'password'));

        return response()->json(['message' => 'Account created successfully.'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $invitation = Invitation::findOrFail($id);
        $invitation->expires_at = now()->addDays(7);
        $invitation->save();

        Mail::to($request->email)->send(new InvitationMail($invitation));

        return response()->json([
            'message' => 'Invitation sent successfully.',
            'success' => true
        ], 200);

    }


}
