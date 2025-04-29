<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CustomResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                Mail::to($user->email)->send(new CustomResetPasswordMail($token, $user->email));
            }
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', " A password reset link has been sent to your email address.
            Please check your inbox and follow the instructions to reset your password.")
            : back()->withErrors(['email' => __($status)]);
    }
}
