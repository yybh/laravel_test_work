<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class BorrowController extends Controller
{	
	public function __construct(){
    	$this->middleware('auth');
	}

    public function borrow(Request $Request){
    	
    	$bid = $Request->id;
    	$uid = Auth::id();
    	if(Auth::user()->is_admin){
    		session()->flash('danger', '管理员请勿借书');
            return redirect()->back();
    	}
    	$uage = Auth::user()->age;
    	$book = DB::table('books')->where('id',$bid)->first();

    	if(!$book){
    		session()->flash('danger', '很抱歉，本书不存在');
            return redirect()->back();
    	}
    	$book_log = DB::table('books_log')->where('user_id',$uid)->where('is_back',0)->get();
    	if((count($this->obj2arr($book_log))>=3 && $uage<12) || (count($this->obj2arr($book_log))>=6)){
    		session()->flash('danger', '很抱歉，您的可借数量已达到上限');
            return redirect()->back();
    	}elseif($book->borrow_num == $book->num){
    		session()->flash('danger', '很抱歉，这本书已经全部借出');
            return redirect()->back();
    	}
    	foreach ($this->obj2arr($book_log) as $k => $v) {
    		if($bid == $v['book_id']){
    			session()->flash('danger', '很抱歉，您已经借过这本书');
            	return redirect()->back();
    		}
    	}
    	

    	DB::table('books')->where('id',$book->id)->increment('borrow_num'); 
    	DB::table('books_log')->insert([
            'book_id' => $bid,
            'user_name' => Auth::user()->name,
            'user_age' => Auth::user()->age,
            'title' => $book->title,
            'author' => $book->author,
            'isbn' => $book->isbn,
            'location' => $book->location,
            'is_back' => 0,
            'user_id' => $uid,
            'created_at' => date('Y-m-d H:i:s'),
            
        ]);
    	session()->flash('success', '借书成功，前往我的借书查看');
        return redirect()->route('users.show', [Auth::user()]);
    }

	public function obj2arr ($obj){
		return json_decode(json_encode($obj),true);
	}
}
