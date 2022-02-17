<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function __construct(protected UserService $userService)
    {
    }

    public function create(Request $request)
    {
        $fields = [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt('123456');
        $user = $this->userService->create($data);
    }
}