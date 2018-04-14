@extends('layouts.admin')
@section('title', '已借出图书列表')
@section('content')
   <div class="jumbotron">
    <h3>已借出图书列表</h3>
    @include('shared._errors')
       @include('shared._messages')
    <div style="width:500px;margin:0 auto"><input id="name" type="text" value="{{$se_name}}" placeholder="请输入书名关键词"><a href="javascript:void(0)" onclick="search_title()">搜索书名</a>&nbsp;<a href="/admin/books">重置搜索</a>&nbsp;<a href="/admin/booksadd">新增图书</a></div>
    <ul>
    	 @foreach ($books as $book)
    	<li><span>书名：{{ $book->title }}</span>&nbsp;<span>借出人：{{$book->user_name}}</span>&nbsp;<span>借出人年龄：{{$book->user_age}}</span>&nbsp;<span>书架位置：{{$book->location}}</span>&nbsp;&nbsp;<span>借书时间：{{$book->created_at}}</span>&nbsp;

       <span> <a href="{{$book->is_back==0?'/admin/booksback?id='.$book->id:'javascript:void(0)'}}">{{$book->is_back==0?'还书':'已还书时间：'.$book->updated_at}}</a>{{time()-strtotime($book->created_at)>14*24*3600?' 已逾期'.ceil((time()-strtotime($book->created_at))/24/3600-14).'天，请扣费':''}}</span>&nbsp;
       
      
    	@endforeach
    </ul>
  </div>
  <script>
  	function search_title(){
  		var name = $('#name').val();
  		if(name.length > 0){
  			window.location = '/admin/books?name='+name;
  		}else{
  			window.location = '/admin/books';
  		}
  	}

  </script>
@stop