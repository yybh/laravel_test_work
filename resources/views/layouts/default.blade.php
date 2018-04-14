
<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '图书馆管理系统')</title>
    <link rel="stylesheet" href="/css/app.css">
    <script language="JavaScript" src="/js/app.js"></script>
  </head>
  <body>
    <header class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="col-md-offset-1 col-md-10">
           <a href="/" id="logo">图书馆</a>
          <nav>
            <ul class="nav navbar-nav navbar-right">
              @if (Auth::check())
                
                <li><a href="{{ route('users.show', Auth::user()->id) }}">你好，{{Auth::user()->name}}</a></li>
                <li><a href="{{ route('users.show', Auth::user()->id) }}">我的借书</a></li>
               
                <li>
                  <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button  type="submit" name="button">退出</button>
                    </form>
                  </a>
                </li>
                  
              @else
                <li><a href="/login">登录</a></li>
                <li><a href="{{ route('signup') }}">注册</a></li>
              @endif
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <div class="container">
     
      @yield('content')
    </div>    
  </body>
</html>