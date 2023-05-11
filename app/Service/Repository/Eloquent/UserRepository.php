<?php

namespace App\Service\Repository\Eloquent;

use App\Models\User;
use App\Service\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    /**
     */
    public function __construct()
    {
        $this->user = new User();
    }

    public function getUser($email, $password)
    {
        try {
            return $this->user->where('email', $email)->where('password', sha1($password))->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        try {
            return $this->user->where('email', $email)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getExistForgetUrlUser($forgetUrl)
    {
        try {
            return $this->user->where('forget_url', $forgetUrl)->first();
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getListUser($searchKey = '')
    {
        try {
            return $this->user->where(function ($query) use ($searchKey){
                $query->where('username', 'LIKE' , $searchKey)
                    ->where('role', 2)
                    ->where(function ($query) use ($searchKey) {
                        $query->orWhere('phone_number', 'LIKE', $searchKey)
                            ->orWhere('email', 'LIKE', $searchKey);
                    })
                    ->where('status', 1);
            })->paginate(10);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUserByID($id)
    {
        try {
            return $this->user->where('id', $id)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function changeStatusUser($id, $status)
    {
        try {
            $this->user->where('id', $id)->update([
                'status' => $status
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function createUserTmp($email, $registerUrl)
    {
        try {
            return $this->user->create(array(
                'email' => $email,
                'register_url' => $registerUrl
            ));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateUser($user, $request)
    {
        try {
            $user->update(array(
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'full_name' => $request->full_name
            ));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function createUser($request)
    {
        try {
            $this->user->insert(array(
                array(
                    'full_name' => $request->full_name,
                    'username' => $request->username,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email,
                    'date_of_birth' => $request->date_of_birth,
                    'password' => sha1($request->password),
                    'gender' => $request->gender,
                    'status' => 1,
                    'role' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            ));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
