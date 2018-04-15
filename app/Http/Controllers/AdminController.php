<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\model\Books;
use App\user;
use Auth;

class AdminController extends Controller
{	

	public function __construct()
    {
        $this->middleware('auth', [            
            'except' => []
        ]);
    }

    public function index(){
    	
   		if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       	}
	   


    	$b = DB::table('books')->count();
    	$bn = DB::table('books')->sum('num');
    	$bb = DB::table('books_log')->where('is_back',0)->count();
    	$un = DB::table('users')->count()-1;
    	return view('admin.index', compact('b','bn','bb','un'));
    }

    public function books(){

    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }


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
    	$books = DB::table('books')->where($field,$do,$where)->orderBy('updated_at', 'desc')->get();
    	
        return view('admin/books', compact('books','se_name'));
    }

    public function booksadd(){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	
    	return view('admin/booksadd');
    }

    public function booksaddpost(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'num' => 'required|numeric',
            'location' => 'required',
        ]);

        $book = Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'num' => $request->num,
            'location' => $request->location,
            'borrow_num' => 0,
        ]);
        // var_dump($book->id);die;
         session()->flash('success', '添加成功');
        return redirect()->route('books',array('name'=>$book->title));
    }

    public function booksedit(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$id = Input::get('id');
    	$book = DB::table('books')->where('id',$id)->first();
    	return view('admin/booksedit',compact('book'));
    }

    public function bookseditPost(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$this->validate($request, [
    		'id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'num' => 'required|numeric',
            'location' => 'required',
        ]);

        $book = Books::find($request->id);  
   		$book->title = $request->title;
        $book->author =  $request->author;
        $book->isbn = $request->isbn;
        $book->num = $request->num;
        $book->location = $request->location;
     	$book -> save();
        
        // var_dump($book->id);die;
         session()->flash('success', '修改成功');
        return redirect()->route('books',array('name'=>$book->title));
    }

    public function booksdelete(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$id = Input::get('id');
    	$book = DB::table('books')->where('id',$id)->delete();
    	 session()->flash('success', '删除成功');
    	return redirect()->route('books');
    }

    public function bookslog(){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

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
    	$books = DB::table('books_log')->where($field,$do,$where)->orderBy('updated_at', 'desc')->get();
    	
        return view('admin/bookslog', compact('books','se_name'));
    }

    public function booksback(){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$id = Input::get('id');
    	$book = DB::table('books_log')->where('id',$id)->first();
    	DB::table('books')->where('id',$book->book_id)->decrement('borrow_num');
    	DB::table('books_log')->where('id',$id)->update(['updated_at'=>date('Y-m-d H:i:s'),'is_back'=>1]);
    	session()->flash('success', '还书成功');
    	return redirect()->route('bookslog');
    }

    public function users(){

    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }


    	$se_name = Input::get('name');
    	if($se_name){
    		$where = '%'.$se_name.'%';
    		$field = 'name';
    		$do = 'like';
    	}else{
    		$where = 0;
    		$field = 'id';
    		$do = '>';
    	}
    	$books = DB::table('users')->where($field,$do,$where)->where('is_admin',0)->orderBy('updated_at', 'desc')->get();
    	
        return view('admin/users', compact('books','se_name'));
    }

    public function usersadd(){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	
    	return view('admin/usersadd');
    }

    public function usersaddpost(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

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
        // var_dump($book->id);die;
         session()->flash('success', '添加成功');
        return redirect()->route('users',array('name'=>$user->name));
    }

    public function usersedit(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$id = Input::get('id');
    	$book = DB::table('users')->where('id',$id)->first();
    	return view('admin/usersedit',compact('book'));
    }

    public function userseditpost(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$this->validate($request, [
    		'id' => 'required',
            'name' => 'required|max:50',
            'age' => 'required|numeric'
        ]);

        $book = User::find($request->id);  
   		$book->name = $request->name;
        $book->age = $request->age;

        if($request->password){
        	 $this->validate($request, [
            	'password' => 'required|confirmed|min:6',
        	]);
        	$book->password = bcrypt($request->password);
        }
        
     	$book -> save();
        
        // var_dump($book->id);die;
         session()->flash('success', '修改成功');
        return redirect()->route('users',array('name'=>$book->name));
    }

    public function usersdelete(Request $request){
    	if(!Auth::user()->is_admin){
       		return redirect()->route('/');
       }

    	$id = Input::get('id');
    	$book = DB::table('users')->where('id',$id)->delete();
    	 session()->flash('success', '删除成功');
    	return redirect()->route('users');
    }
}
