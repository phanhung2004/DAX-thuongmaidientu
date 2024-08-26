{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Bootstrap demo</title>
  </head>
  <body>
    <div class="container">
        <h1>login</h1>
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if(session('errorLogin'))
        <div class="alert alert-danger">
            {{ session('errorLogin') }}
        </div>
    @endif
        <form method="POST" action="{{ route('postLogin') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">UserName</label>
                <input type="username" class="form-control" id="username" name="username" aria-describedby="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">PassWord</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="password">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-info">LOGIN</button>
            </div>
            <div class="mb-3">
                <a href="{{ route('register') }}">Register</a>
            </div>
            <div class="mb-3">
                <a href="">Forgot Password?</a>
            </div>
        </form>
    </div>
  </body>
</html> --}}


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Aldi Duzha" />
    <meta name="description" content="Free Bulma Login Template, part of Awesome Bulma Templates" />
    <meta name="keywords" content="bulma, login, page, website, template, free, awesome" />
    <link rel="canonical" href="https://aldi.github.io/bulma-login-template/" />
    <title>Bulma Login - Free Bulma Template</title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-social@1/bin/bulma-social.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('asset/login/css/style.css') }}" />
  </head>
  <body>
    <section class="hero is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered">
          <div class="column is-4 is-offset-4">
            <div class="box">
              <p class="subtitle is-4">Please login to proceed.</p>
              <br />
              <form action="{{ route('postLogin') }}" method="POST">
                @csrf
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <input type="username" class="input is-medium" id="username" name="username" placeholder="UserName" aria-describedby="username">
                    <span class="icon is-medium is-left">
                      <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-medium is-right">
                      <i class="fas fa-check"></i>
                    </span>
                  </p>
                </div>
                <div class="field">
                  <p class="control has-icons-left">
                    <input type="password" class="input is-medium" id="password" name="password" placeholder="PassWord" aria-describedby="password">
                    <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                  </p>
                </div>
                {{-- <div class="field">
                  <label class="checkbox">
                    <input type="checkbox" />
                    Remember me
                  </label>
                </div> --}}
                <button class="button is-block is-info is-large is-fullwidth" type="submit">Login</button><br />
                @if(session('errorLogin'))
                    <div class="alert alert-danger">
                        {{ session('errorLogin') }}
                    </div>
                @endif
              </form>
              <button class="button is-block is-info is-large is-fullwidth" type="submit"><a href="{{ route('register') }}">Register</a></button><br />
            </div>
            <p class="has-text-grey">
              <a href="#">Sign Up</a> &nbsp;·&nbsp; <a href="#">Forgot Password</a> &nbsp;·&nbsp;
              <a href="#">Need Help?</a>
            </p>
            {{-- <div class="languages select is-small is-rounded">
              <select>
                <option selected>English</option>
                <option>French</option>
                <option>German</option>
                <option>Italian</option>
              </select>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="hero-foot">
        <div class="container has-text-centered">
          <p class="footer-text">
            <a href="https://www.aldiduzha.com?utm_source=Github" style="color: white;">Designed with <i class="fa fa-heart fa-fw" style="font-size: 10px; color: red;"></i> by Aldi Duzha</a>
          </p>
        </div>
      </div>
    </section>
  </body>
</html>
