<?php

namespace App\Controllers;

use App\Models\User;
use Core\Request;
use Core\Session;

class AuthController
{
    public function registerPage()
    {
        return view("register", []);
    }
    public function loginPage()
    {
        return view("login", []);
    }

    public function login()
    {
        Session::start();
        try {
            $request = new Request();

            $user = User::query()->where('email', "=",$request->get('email'))->first();
            $profile = json_decode(json_encode($user));
            if (password_verify($request->get('password'), $profile?->password)){
                Session::set('user', $profile);
                header("Location: /users/profile");
                exit();
            }else{
                return json(['message' => 'Unauthorized'], 401);
            }
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
    public function register()
    {
        Session::start();
        try {
            $request = new Request();
            if ($request->get('password') != $request->get('password_confirmation'))
            {
                return json(['message' => "Пароли не совпадают"], 422);
            }else{
                $user = User::query()->insert([
                    'name' => $request->get('name'),
                    'phone' => $request->get('phone'),
                    'email' => $request->get('email'),
                    'password' => password_hash($request->get('password'), PASSWORD_BCRYPT)
                ]);
                $profile = json_decode(json_encode($user));
                Session::set('user', $profile);
                header("Location: /users/profile");
                exit();
            }
        }catch (\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}