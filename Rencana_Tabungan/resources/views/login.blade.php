<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="{{asset('css/login_style.css')}}" />
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form action="{{ route('login') }}" method="POST" autocomplete="off" class="sign-in-form">
              @csrf
              <div class="logo">
                <img src="./img/logo.png" alt="easyclass" />
                <h4 style="margin-top: 3px; margin-left: 5px;">PocketPlan</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <h6>Not registred yet?</h6>
                <a href="#" class="toggle">Sign up</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="email"
                    minlength="5"
                    class="input-field"
                    autocomplete="off"
                    name="email"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="6"
                    class="input-field"
                    autocomplete="off"
                    name="password"
                    required
                  />
                  <label>Password</label>
                </div>

                <input type="submit" value="Sign In" class="sign-btn" />

                @if ($errors->any())
                    <div class="alert alert-danger" style="text-align: center; font-size: 13px; color: #721c24; text-decoration: none;">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success" style="text-align: center; font-size: 13px; color: #155724;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" style="text-align: center; font-size: 13px; color: #721c24;">
                        {{ session('error') }}
                    </div>
                @endif

              </div>
            </form>

            <form action="{{ route('register') }}" method="POST" autocomplete="off" class="sign-up-form">
              @csrf
              <div class="logo">
                <img src="./img/logo.png" alt="easyclass" />
                <h4 style="margin-top: 3px; margin-left: 5px;">PocketPlan</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="5"
                    class="input-field"
                    autocomplete="off"
                    name="name"
                    required
                  />
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    class="input-field"
                    autocomplete="off"
                    name="email"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="6"
                    class="input-field"
                    autocomplete="off"
                    name="password"
                    required
                  />
                  <label>Password</label>
                </div>

                <input type="submit" value="Sign Up" class="sign-btn" />

                @if (session('success'))
                    <div class="alert alert-success" style="text-align: center; font-size: 13px; color: #155724;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" style="text-align: center; font-size: 13px; color: #721c24;">
                        {{ session('error') }}
                    </div>
                @endif

              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="./img/plan.png" class="image img-1 show" alt="" />
              <img src="./img/manage.png" class="image img-2" alt="" />
              <img src="./img/dream.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Plan your finances</h2>
                  <h2>Manage your savings</h2>
                  <h2>Achieve your dream list</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="{{asset('js/login_js.js')}}"></script>
  </body>
</html>