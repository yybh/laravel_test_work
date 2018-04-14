<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth', [            
            'except' => ['create','store']
        ]);
    }


    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {   
        $se_name = Input::get('name');
        if($se_name){
            $where = '%'.$se_name.'%';
            $field = 'title';
            $do = 'like';
        }else{
            $where = 0;
            $field = 'id';
            $do = '>';
        }
        $books = DB::table('books_log')->where($field,$do,$where)->where('user_id',Auth::id())->orderBy('updated_at', 'desc')->get();

        return view('users.show', compact('user','books','se_name'));
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'age' => 'required|numeric'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'is_admin' => 0,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success', '注册成功');
        return redirect()->route('users.show', [$user]);
    }
}