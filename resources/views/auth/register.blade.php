<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Money Tracker | Registration Page</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
   <body class="hold-transition register-page">
      <div class="register-box">
         <div class="register-logo">
            <a href="../../index2.html"><b>Money</b>Tracker</a>
         </div>
         <div class="card">
            <div class="card-body register-card-body">
               <p class="login-box-msg">Register a new membership</p>
               <form action="{{ route('auth.register.store') }}" method="post">
                @csrf
                <div class="form-floating mb-1">
                    <label for="name">Fullname</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                </div>
                <div class="form-floating mb-1">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                </div>
                <div class="form-floating mb-1">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                  <div class="row mt-3">
                     <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                     </div>
                  </div>
               </form>
               <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  
                  <a href="{{ route('auth.login.google') }}" class="btn btn-block btn-danger">
                  <i class="fab fa-google mr-2"></i>
                  Sign up using Google
                  </a>
               </div>
               <a href="{{ route('auth.login') }}" class="text-center">I already have a membership</a>
            </div>
         </div>
      </div>
      <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
   </body>
</html>