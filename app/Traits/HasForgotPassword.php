<?php

namespace App\Traits;

use App\Notifications\ForgotPassword;

/**
 * Trait HasForgotPassword
 * @package App\Traits
 *
 * @property string forgot_password_otp
 */
trait HasForgotPassword
{

    /**
     * Generates a new OTP for the user.
     *
     * @return void
     */
    public function generateForgotPasswordOTP(): void
    {
        $this->forceFill(['forgot_password_otp' => mt_rand(111111, 999999)])->save();
    }

    /**
     * Remove the OTP after successful password reset
     *
     * @return bool
     */
    public function removeForgotPasswordOtp(): bool
    {
        return $this->forceFill([
            'forgot_password_otp' => null
        ])->save();
    }

    /**
     * Send the phone verification notification.
     *
     * @return void
     */
    public function sendForgotPasswordOtpNotification(): void
    {
        $this->generateForgotPasswordOTP();

        $this->notify(new ForgotPassword());
    }
}
