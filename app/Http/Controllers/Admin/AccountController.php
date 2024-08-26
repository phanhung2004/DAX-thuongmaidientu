<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin/accounts/index', compact('users'));
    }
    public function updateStatus($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active; // Chuyển đổi giữa 0 và 1
        $user->save();

        return redirect()->route('listAccount')->with('success', 'User status updated successfully');
    }
    public function delete($id){

        $user = User::find($id);

        if ($user) {
            $user->delete(); // Hoặc dùng User::destroy($id);
            return redirect()->route('listAccount')->with('delete', 'User deleted successfully');
        } else {
            return redirect()->route('listAccount')->with('error', 'User not found');
        }
    }
    public function edit($id){
        $user = User::find($id);
        return view('admin/accounts/edit', compact('user'));
    }
    public function updateAccount(Request $request, $id){

        $user = User::findOrFail($id);

        // Cập nhật thông tin người dùng
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        // Lưu thông tin người dùng
        $user->save();

        return redirect()->route('listAccount')->with('success', 'User updated successfully');
    }
    public function create(){
        $account = User::all();
        return view('admin/accounts/create', compact('account'));
    }
    public function store(Request $request){

        // $validator = Validator::make($request->all(), [
        //     'fullname' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:users,username',
        //     'email' => 'required|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // // Check if validation fails
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // dd($request->all());

        User::create([
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' =>  Hash::make($request->input('password')),
        ]);
        return redirect()->route('listAccount')->with('success', 'User created successfully');
    }
}
