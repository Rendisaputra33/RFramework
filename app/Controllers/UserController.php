<?php

namespace Rendi\Rframework\Controllers;

use Rendi\Rframework\App\Core\Http\Request;
use Rendi\Rframework\Exceptions\ValidateException;
use Rendi\Rframework\Models\UserLoginRequest;
use Rendi\Rframework\Models\UserRegisterRequest;
use Rendi\Rframework\Services\UserService;

class UserController
{

    private ?UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    // 
    public function register()
    {
        return template('Register/index', ['title' => 'Register | Page']);
    }
    // 
    public function login()
    {
        return template('Login/index', ['title' => 'Login | Page']);
    }

    public function submitRegister(Request $request)
    {
        try {
            $reqdata = new UserRegisterRequest($request->username, $request->password, $request->confirm);
            $register = $this->userService->register($reqdata);
            var_dump($register);
        } catch (ValidateException $exception) {
            var_dump($exception);
        }
    }

    public function submitLogin(Request $request)
    {
        try {
            $reqdata = new UserLoginRequest($request->username, $request->password);
            $user = $this->userService->login($reqdata);
            var_dump($user);
        } catch (ValidateException $exception) {
            var_dump($exception);
        }
    }
}
