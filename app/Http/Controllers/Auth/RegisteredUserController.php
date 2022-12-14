<?php

namespace App\Http\Controllers\Auth;




use App\Models\User;
use App\Events\conformemail;
use Illuminate\Http\Request;
use App\Services\LoginService;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\signupEngineerRequest;


class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(signupEngineerRequest $request, LoginService $loginService)
    {
        $user = $loginService->storeSignupdata($request);
        event(new Registered($user));
        Auth::login($user);
        $users = Auth::user()->role;
        $userstatus = Auth::user()->status;
       

        if ($users == 'admin') {
            return redirect(RouteServiceProvider::ADMIN);
        }
        if ($users == 'enge') {
            Event(new conformemail($user));
           
            Cache::put('userlogin'.Auth::user()->id,true);
            if (Auth::user()->emailstatus == 0) {
                return redirect(RouteServiceProvider::EMAILVERIFY);
            } else {
                if (Auth::user()->docsstatus == 0) {
                    return redirect(RouteServiceProvider::DOCSSTATUS);
                } else {
                    if ($userstatus == 0) {
                        return redirect(RouteServiceProvider::ADMINSTATUS);
                    } else {
                        return redirect(RouteServiceProvider::ENGE);
                    }
                }
            }
        }
        if($users == 'user'){
            if (session()->has('search_id')) {
                return redirect()->route('search_engineer');
            }
            if (session()->has('select_date')) {
                return redirect()->route('proceedlogin');
            }
            if (session()->has('city_name')) {
                return redirect()->route('getsearchbarengineer');
            }
            return redirect(RouteServiceProvider::INDEXPAGE);
        }
        return redirect()->route('indexpage');
    }
}
