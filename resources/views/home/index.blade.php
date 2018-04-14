@extends('layouts.default')
@section('title', '图书馆管理系统-首页')
@section('content')
   <div class="jumbotron">
    <h3>图书列表</h3>
    @include('shared._errors')
       @include('shared._messages')
    <div style="width:300px;margin:0 auto"><input id="name" type="text" value="{{$se_name}}" placeholder="请输入书名关键词"><a href="javascript:void(0)" onclick="search_title()">搜索书名</a>&nbsp;<a href="/">重置搜索</a></div>
    <ul>
    	 @foreach ($books as $book)
    	<li><span>书名：{{ $book->title }}</span>&nbsp;<span>作者：{{$book->author}}</span>&nbsp;<span>书架位置：{{$book->location}}</span>&nbsp;<span>共有：{{$book->num}}本</span>&nbsp;<span>剩余：{{$book->num - $book->borrow_num}}本</span>&nbsp;
       <span><a href="/borrow/{{ $book->id }}">借书</a></span></li>
    	@endforeach
    </ul>
  </div>
  <script>
  	function search_title(){
  		var name = $('#name').val();
  		if(name.length > 0){
  			window.location = '?name='+name;
  		}else{
  			window.location = '/';
  		}
  	}

  </script>
@stop