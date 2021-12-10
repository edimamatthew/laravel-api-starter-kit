<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordVerifyRequest;
use App\Http\Requests\Auth\ForgotPasswordResetRequest;
use App\User;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function forgot(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (is_null($user)) {
            throw new ConflictHttpException('User not found.');
        }

        $user->sendForgotPasswordOtpNotification();

        return response()->json(['message' => 'The verification code has been sent successfully.']);
    }

    public function verify(ForgotPasswordVerifyRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (is_null($user)) {
            throw new ConflictHttpException('User not found.');
        }

        if ($user->forgot_password_otp != $data['otp']) {
            throw new ConflictHttpException('The OTP is incorrect.');
        }

        $accessToken = $user->createToken('Personal Access Token')->accessToken;

        return response([
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $accessToken,
        ]);
    }

    public function reset(ForgotPasswordResetRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();

        if (is_null($user->forgot_password_otp)) {
            throw new ConflictHttpException('The password has already been reset successfully.');
        }

        $data['password'] = Hash::make($data['password']);

        $user->update($data);

        $user->removeForgotPasswordOtp();

        return response()->json(['message' => 'The password has been updated successfully.']);
    }
}
