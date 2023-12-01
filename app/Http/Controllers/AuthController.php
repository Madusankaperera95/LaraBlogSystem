<?php

namespace App\Http\Controllers;

use App\Actions\UserRegistrationAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\BlogPost;
use App\Models\User;
use App\Servicses\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    //
    public function register(RegisterRequest $request){

        $user = UserRegistrationAction::execute($request->all());
        Auth::login($user);
        return redirect("dashboard")->withSuccess('Great! You have Successfully logged In');
    }


    public function registration()
    {
        return view('User.registration');
    }

    public function login(LoginRequest $request){

       if(Auth::attempt($request->only(['email','password'])))
       {
           return redirect("dashboard")->with('message','Great! You have Successfully logged In');
       }
        return redirect("login")->withErrors('Oppes! You have entered invalid credentials');
    }

    public function loginView(){
        return view('User.login');
    }

    public function dashboard(){
        $blogposts = $this->blogService->getUserBlogPostWithPagination(Auth::user());
        return view('User.dashboard')->with('blogposts',$blogposts);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }





}
