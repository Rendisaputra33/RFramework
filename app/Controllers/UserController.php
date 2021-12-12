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
    public function register(): mixed
    {
        return template('Register/index', ['title' => 'Register | Page']);
    }
    // 
    public function login(): mixed
    {
        return template('Login/index', ['title' => 'Login | Page']);
    }

    public function submitRegister(Request $request)
    {
        try {
            $reqdata = new UserRegisterRequest($request->username, $request->password, $request->confirm);
            $register = $this->userService->register($reqdata);
            if ($register) return redirect('/user/login');
            return template('Register/index', ['title' => 'Register | Page']);
        } catch (ValidateException $exception) {
            return template('Register/index', [
                'title' => 'Login | Page',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function submitLogin(Request $request)
    {
        try {
            $reqdata = new UserLoginRequest($request->username, $request->password);
            $this->userService->login($reqdata);
            return redirect('/');
        } catch (ValidateException $exception) {
            return template('Login/index', [
                'title' => 'Login | Page',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
