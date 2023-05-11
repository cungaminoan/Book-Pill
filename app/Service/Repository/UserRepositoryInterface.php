<?php

namespace App\Service\Repository;

interface UserRepositoryInterface
{
    public function getUser($email, $password);

    public function getUserByEmail($email);

    public function getExistForgetUrlUser($forgetUrl);

    public function getListUser($searchKey);

    public function getUserByID($id);

    public function changeStatusUser($id, $status);

    public function createUserTmp($email, $registerUrl);

    public function updateUser($user, $request);

    public function createUser($request);
}
