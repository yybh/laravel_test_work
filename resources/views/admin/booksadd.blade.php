@extends('layouts.admin')
@section('title', '添加图书')

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
      <h5>添加图书</h5>
    </div>
    <div class="panel-body">

       @include('shared._errors')

       
      <form method="POST" action="{{ route('booksaddpost') }}">

        {{ csrf_field() }}


          <div class="form-group">
            <label for="title">书名：</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
          </div>

          <div class="form-group">
            <label for="author">作者：</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
          </div>

           <div class="form-group">
            <label for="isbn">ISBN：</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
          </div>

          <div class="form-group">
            <label for="num">数量：</label>
            <input type="text" name="num" class="form-control" value="{{ old('num') }}">
          </div>

          <div class="form-group">
            <label for="location">书架位置：</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
          </div>

          <button type="submit" class="btn btn-primary">添加</button>
      </form>
    </div>
  </div>
</div>
@stop