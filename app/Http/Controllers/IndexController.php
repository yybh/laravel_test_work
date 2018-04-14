<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    public function index()
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
    	$books = DB::table('books')->where($field,$do,$where)->orderBy('updated_at', 'desc')->get();
    	
        return view('home/index', compact('books','se_name'));
    }
}
