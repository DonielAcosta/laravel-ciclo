<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller{
  
  public function index(){

    $users = User::latest()->get();

    return view('users.index',[
      'users' => $users
    ]);
  }

  public function store(Request $request){
    
    $request->validate([
      'name' => 'required|max:255',
      'email' => 'required|max:255|unique:users',
      'password' => 'required|min:8|confirmed',
    ]);
    
    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return back();
  }

  public function destroy(User $user){

    $user->delete();

    return back();
  }
    
}
