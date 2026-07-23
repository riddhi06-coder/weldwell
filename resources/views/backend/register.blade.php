<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>


<body>
    <!-- login page start-->
    <div class="container-fluid p-0"> 
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              <div style="text-align: center; margin-bottom: 0;"><a class="logo" href="{{ route('admin.login') }}" style="display: inline-block; background-color: #e5011c; padding: 10px 18px; border-radius: 10px; line-height: 0; box-shadow: 0 6px 16px rgba(229, 1, 28, 0.22);"><img class="img-fluid for-dark" src="{{ asset('admin/assets/images/logo/logo.webp') }}" alt="looginpage" style="width: 185px; max-width: 100% !important;"><img class="img-fluid for-light" src="{{ asset('admin/assets/images/logo/logo.webp') }}" alt="looginpage" style="width: 185px; max-width: 100% !important;"></a></div>
              <div class="login-main">
              <form class="theme-form" action="{{ route('admin.register.authenticate') }}" method="POST">
                    @csrf
                    <h4>Create your account</h4>
                    <p>Enter your personal details to create account</p>

                    <div class="form-group">
                        <label class="col-form-label pt-0">Your Name</label>
                        <div class="row g-2">
                            <div class="col-12">
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required="" placeholder="First name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <div class="form-input position-relative">
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required="" placeholder="Enter Password">
                            <div class="show-hide"><span class="show"></span></div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                    </div>

                    <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('admin.login') }}">Sign in</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>


@include('components.backend.main-js')


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.querySelector('input[name="password"]');
        const showHideSpan = document.querySelector('.show-hide .show');

        showHideSpan.addEventListener('click', function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    });
</script>

</body>
</html>