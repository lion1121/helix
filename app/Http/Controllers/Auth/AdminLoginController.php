<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    //
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        //attempt to log user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if successful, then redirect to their location
            return redirect()->intended(route('admin.dashboard'));
        }

        //if unsuccessful, then redirect back
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /*
     * Overwrite logout method from trait AuthenticatesUsers
     * check guard and logout depends on who was auth (user or admin)
     * */
    public function logout()
    {
            Auth::guard('admin')->logout();
            return redirect('admin/login');
    }
}
