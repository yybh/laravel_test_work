@extends('layouts.default')
@section('title', '注册')

@section('content')
<style>
  input, textarea, select, .uneditable-input {
  border: 1px solid #bbb;
  margin-bottom: 15px;
}

input {
  height: auto !important;
}

.panel {
  margin-top: 50px;
}
</style>
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>注册</h5>
    </div>
    <div class="panel-body">

       @include('shared._errors')

       
      <form method="POST" action="{{ route('users.store') }}">

        {{ csrf_field() }}


          <div class="form-group">
            <label for="name">名称：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
          </div>

          <div class="form-group">
            <label for="email">邮箱：</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>

           <div class="form-group">
            <label for="age">年龄：</label>
            <input type="text" name="age" class="form-control" value="{{ old('age') }}">
          </div>

          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">注册</button>
      </form>
    </div>
  </div>
</div>
@stop