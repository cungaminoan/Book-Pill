<?php

namespace App\Service\Admin;

use App\Enum\Result;
use App\ResponseObject\ResponseObject;
use App\Service\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserAdminService
{
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserList(Request $request)
    {
        if($request->searchKey) {
            $key = '%' . trim(str_replace('%', '\%', $request->searchKey)) . '%';
        } else {
            $key = '%%';
        }

        $userList = $this->userRepository->getListUser($key);
        return view('pages.admin.user.list', compact('userList'));
    }

    public function getUserDetail(Request $request)
    {
        $foundUser = $this->userRepository->getUserByID($request->id);
        return view('pages.admin.user.detail', compact('foundUser'));
    }

    public function changeStatusUser(Request $request)
    {
        $result = $this->userRepository->changeStatusUser($request->id, $request->status);

        if (!$result) {
            $response = new ResponseObject(Result::FAILURE, '', '');
            return response()->json($response->responseObject());
        }
        $response = new ResponseObject(Result::SUCCESS, '', '');
        return response()->json($response->responseObject());
    }

}
