<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __invoke(Request $request) { }

    // Show Register/Create Form
    public function create(){
        return view('/users.register');
    }

    // Create New User
    public function store(Request $request){
        //Validations
        $formFields= $request->validate(
            [
                'name' => ['required', 'min:3'],
                'email' =>['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required | confirmed | min:6'
            ]
        );
        //Encrypt Password
            $formFields['password'] = bcrypt($formFields['password']);
        // Create User
        $user = User::create($formFields);
        //Login
        auth()->login($user);
        //Redirect w/message
        return redirect('/')->with('success' , 'User Register Succesfully');

    }

    //Logout User
    public function logout(Request $request){
        auth()->logout();
        // invalidate user session and tocken
        $request->session()->invalidate();
        // remove Token
        $request->session()->regenerateToken();
        //redirect
        return redirect('/')->with('success', 'Logout');
    }

    //Login Form
    public function login(){
        return view('users.login');
    }

    //Authenticate
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        // attempt to login
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            // return
            return redirect ('/')->with('success', 'Loged In');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('emai');
    }
}
