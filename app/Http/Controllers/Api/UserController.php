<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $success['token'] = $user->createToken('weather')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Unauthorized.', $validator->errors(), 401);
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth('web')->user();
            $user = $this->userService->findById($user->id);
            $success['token'] = $user->createToken('weather')->accessToken;
            $success['nome'] = $user->nome;

            return $this->sendResponse($success, 'Authenticated User.');
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function weathers()
    {
        $user = auth()->user();
        if ($user) {
            return $this->sendResponse($user->logEvents, "User's Events.");
        }

        return $this->sendError('Not Found.', ['error'=>'User not found'], 404);
    }
}
