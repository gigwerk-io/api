<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\resetPasswordMailable;
use Illuminate\Contracts\Hashing\Hasher;
use Solomon04\Documentation\Annotation\Group;
use App\Contracts\Repositories\UserRepository;
use Solomon04\Documentation\Annotation\BodyParam;


/**
 * @Group(name="Reset Password", description="These routes belong are responsible for password resets.")
 */
class ResetPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var Hasher
     */
    private $hasher;

    public function __construct(UserRepository $userRepository, Mailer $mailer, Hasher $hasher)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->hasher = $hasher;
    }

    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = $this->userRepository->findWhere(["email" => $request->email])->first();

        if (!$user) {
            return ResponseFactory::error(
                'We could not find a user matching this email address.',
                null,
                401
            );
        }

        //$this->user->passwordReset->updateOrCreate();

        $passwordReset = $user->passwordReset()->updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(32),
                'expires_at' => Carbon::now()->addDay()->toDateTimeString()
            ]
        );

        $this->mailer->to($request->email)->send(new ResetPasswordMailable($user, $passwordReset->token));

        return ResponseFactory::success(
            'We have sent a password reset link to your email!',
            null
        );
    }

    public function resetView($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            return ResponseFactory::error(
                'This password reset token is invalid.',
                null,
                401
            );
        }

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return ResponseFactory::error(
                'This password reset token has expired.',
                null,
                401
            );
        }

        return ResponseFactory::success(
            'The reset link is valid, reset your password below.',
            ['passwordReset' => $passwordReset],
        );
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed'],
            'token' => ['required', 'string']
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset) {
            return ResponseFactory::error(
                'This password reset token is invalid.',
                null,
                401
            );
        }

        $user = $this->userRepository->findWhere(["email" => $passwordReset->email])->first();

        if (!$user) {
            return ResponseFactory::error(
                'We could not find a user matching this email address.',
                null,
                401
            );
        }

        $user->update([
            "passowrd" => $this->hasher->make($request->password)
        ]);

        $passwordReset->delete();

        return ResponseFactory::success(
            'Your password has been successfully reset.'
        );
    }

}
