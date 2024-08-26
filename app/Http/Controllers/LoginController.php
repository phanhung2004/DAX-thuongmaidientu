<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    // public function index(){
    //     $users = User::all();
    //     return view('admin.account.adminview', compact('users'));
    // }
    public function login(){
        return view('login');
    }
    public function edit($id){
        $user = User::findOrfail($id);
        return view('admin.account.edituser', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $data = $request->except('avatar');
        // dd($request->all());
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $path_avatar = $request->file('avatar')->store('avatars');
            $data['avatar'] = $path_avatar;
        } else {
            $data['avatar'] = $user->avatar;
        }

        // dd($request->all());
        $user->update($data);

        return redirect()->route('view')->with('message', 'Update successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('view')->with('message', 'Xóa dữ liệu thành công');

    }
    public function register(){
        return view('register');
    }
    public function postRegister(Request $request){
        $data = $request->all();
        User::query()->create($data);
        return redirect()->route('login')->with('message', 'Successfully registered');

    }
    public function postLogin(Request $request){
        $data = $request->only(['username', 'password']);
        //

        if(auth()->attempt($data)){ // ham
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('home');
            } elseif ($user->role == 'user') {
                return redirect()->route('home');
            }
        }

        return redirect()->route('login')->with('errorLogin', 'Invalid username or password');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Logout successfully');
    }
}
