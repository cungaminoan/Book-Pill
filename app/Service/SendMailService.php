<?php

namespace App\Service;

use App\Mail\ResetPasswordOrder;
use App\Service\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SendMailService
{

    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function sendMailRequestResetPass(Request $request)
    {
        $foundUser = $this->userRepository->getUserByEmail($request->email);

        if ($foundUser) {
            do {
                $randomString = $this->genNumString();
            } while ($this->userRepository->getExistForgetUrlUser($randomString) !== null);

            $randomString = sha1($foundUser->id . Carbon::now()->toString() . $randomString);

            $foundUser->forget_url = $randomString;
            $foundUser->forget_at = Carbon::now();
            $foundUser->save();

            Mail::queue(new ResetPasswordOrder($foundUser));

            if(Mail::failures()) {
                return false;
            }

            Session::put('mail_address', $foundUser->email);

            return true;
        }

        return false;
    }

    private function genNumString(): string
    {
        $stringNum = '0123456789';
        $lengthStringNum = Str::length($stringNum);
        $randomNumString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomNumString .= $stringNum[rand(0, $lengthStringNum - 1)];
        }

        return $randomNumString;
    }
}
