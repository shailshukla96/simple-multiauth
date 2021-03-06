<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TutorPad</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
  </head>
  <body>
    <div id="app">
      <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container">
          <a class="navbar-brand" href="{{ route('institute.index') }}">
            TutorPad
          </a>
          <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
              @if (Auth::guest())
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Student Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">Student Sign up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.login')}}">Tutor Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.register')}}">Register your Tuition</a>
                </li>
              @else
                <li class="nav-item dropdown">
                  <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  id="navbarDropdownMenuLink"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                    {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    @if ( Auth::guard('web')->check() )
                      <a href="{{ route('stats.boards') }}" class="dropdown-item">Board wise statistics</a>
                      <a href="{{ route('stats.ratings') }}" class="dropdown-item">Ratings wise statistics</a>
                      <a href="{{ route('stats.locations') }}" class="dropdown-item">Location wise statistics</a>
                      <div class="dropdown-divider"></div>
                    @endif
                    <a
                    href="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('user.logout') }}"
                    class="dropdown-item"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      Logout
                    </a>

                    <form
                    id="logout-form"
                    action="{{ (Auth::guard('admin')->check()) ? route('admin.logout') : route('user.logout') }}"
                    method="POST"
                    style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              @endif
            </ul>
          </div>

        </div>
      </nav>

        <div class="container">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">
                        {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                @endif
            @endforeach
        </div>
        @yield('content')
    </div>

    <br><br>
    <hr>
    <br>

    <footer class="text-muted">
      <div class="container">

        <p class="float-right">
          <a href="#">Back to top</a>
        </p>

        <p>TutorPad is a one stop solution for Tuition classes. TutorPad is awesome. Add some nice description.
           TutorPad is awesome. Add some nice description. TutorPad is awesome. Add some nice description.
        </p>
      </div>
    </footer>
    <br>
  </body>

  @yield('scripts')

</html>
