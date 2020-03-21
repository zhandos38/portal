<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => ['required',"min:6"],
        ], [
            'required' => 'Поле :attribute обязательное',
            'min' => 'Пароль должен быть не менее 6 символов',
        ], [
            'login' => 'Фамилия',
            'password' => 'пароль',
        ]);

        if(Auth::attempt([
            "login"=>$request->get("login"),
            "password"=>$request->get("password")
        ],true)){
            return redirect(route('home'));
        } else {
            Flash::error('Неверный логин или пароль');
            return redirect(route("login"));
        }
    }

    public function logout()
    {
        if (Auth::check()){
            if(Auth::user()->role_id == 1){
                $security =  Security::where("user_id",Auth::id())->first();
                if($security){$security->delete();}
            }
            Auth::logout();
        }
        return redirect("/login");
    }
}
