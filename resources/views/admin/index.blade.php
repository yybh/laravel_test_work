@extends('layouts.admin')
@section('title', '图书馆管理系统-管理')
@section('content')
   <div class="jumbotron">
    <h3>图书概述</h3>
    @include('shared._errors')
       @include('shared._messages')
   <span>当前图书种类:{{$b}}<a href="/admin/books">查看</a></span><br/><span>当前图书总量:{{$bn}}</span><br/><span>当前已借出图书:{{$bb}}<a href="/admin/bookslog">查看</a></span><br/><span>当前会员数量:{{$un}}<a href="/admin/users">查看</a></span>
   
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