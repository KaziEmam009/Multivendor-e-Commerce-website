<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


class GithubController extends Controller
{
    public function githubredirect ()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubcallback ()
    {
         $user = Socialite::driver('github')->user();

         if(User::where('email', $user->getEmail())->exists()){
             $auth_status = Auth::attempt([
                 'email' => $user->getEmail(),
                 'password' => 'abc@123',
             ]);
             if ($auth_status == 1){
                return redirect('home');
             }
             else{
                 echo "ERROR";
             }
         }
         else{
             $login_info = User::create([
                 'name' => $user->getName(),
                 'email' => $user->getEmail(),
                 'password' => bcrypt('abc@123'),
             ]);
            $auth_status = Auth::attempt([
                 'email' => $user->getEmail(),
                 'password' => 'abc@123',
             ]);
             if ($auth_status == 1){
                return redirect('home');
             }
             else{
                 echo "ERROR";
             }
         }
    }
}
