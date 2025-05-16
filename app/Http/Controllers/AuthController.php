<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,employee,manager',

        ]);
        $plainPassword = $data['password'];
        $data['password'] = bcrypt($plainPassword);

         User::create($data);
        return redirect()->route('admin.dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Optionally redirect based on role:
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            elseif(Auth::user()->role === 'manager') {
                return redirect()->intended('/manager/dashboard');
            }
            return redirect()->intended('/employee/dashboard');
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role'  => 'required|in:admin,employee,manager',
        ]);
    
        $user->update($data);
    
        return redirect()->route('admin.dashboard')->with('success', 'User updated.');
    }
    
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success','User deleted.');
    }

}
