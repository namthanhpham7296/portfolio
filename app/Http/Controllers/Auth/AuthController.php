<?php
namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {

    public function login(Request $request){
        $validation = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => [
                'required',
                'string',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/',
            ]
        ]);
        if(Auth::attempt($validation)){
            $authUser = Auth::user();
            $is_admin  = $authUser->is_admin;
            switch ($is_admin){
                case 1: case 2:
                    return redirect()->intended('admin/dashboard/index');
            }
        }
        return redirect()->back();
    }

    public function register(Request $request){

    }
}
