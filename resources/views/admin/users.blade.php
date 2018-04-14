@extends('layouts.admin')
@section('title', '会员列表')
@section('content')
   <div class="jumbotron">
    <h3>会员列表</h3>
    @include('shared._errors')
       @include('shared._messages')
    <div style="width:500px;margin:0 auto"><input id="name" type="text" value="{{$se_name}}" placeholder="请输入书名关键词"><a href="javascript:void(0)" onclick="search_title()">搜索用户名</a>&nbsp;<a href="/admin/users">重置搜索</a>&nbsp;<a href="/admin/usersadd">新增用户</a></div>
    <ul>
    	 @foreach ($books as $book)
    	<li><span>用户名：{{ $book->name }}</span>&nbsp;<span>年龄：{{$book->age}}</span>&nbsp;<span>邮箱/账号：{{$book->email}}</span>
       <span><a href="/admin/usersedit?id={{ $book->id }}">编辑</a></span>&nbsp;
       <span><a href="/admin/usersdelete?id={{ $book->id }}">删除</a></span></li>
    	@endforeach
    </ul>
  </div>
  <script>
  	function search_title(){
  		var name = $('#name').val();
  		if(name.length > 0){
  			window.location = '/admin/users?name='+name;
  		}else{
  			window.location = '/admin/users';
  		}
  	}

  </script>
@stop