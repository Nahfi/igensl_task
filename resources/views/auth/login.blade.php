
 @extends('layouts.user.auth.user_auth_app')
 @section('user_auth_page_title')
     User Login | Task
 @endsection
 @section('user_auth_content')
     <div class="">
         <div class="text-center">
         </div>
         @if (Session::has('something_wrong'))
             <div class="alert alert-danger">
                 {{ Session::get('something_wrong') }}
             </div>
         @endif
         @if (Session::has('message'))
             <div class="alert alert-success">
                 {{ Session::get('message') }}
             </div>
         @endif
         @if (Session::has('password_reset_time_out'))
             <div class="alert alert-danger">
                 {{ Session::get('password_reset_time_out') }}
             </div>
         @endif
         @if (Session::has('password_updated_success'))
             <div class="alert alert-success">
                 {{ Session::get('password_updated_success') }}
             </div>
         @endif
         @if (Session::has('email_password_does_not_match'))
             <div class="alert alert-danger">
                 {{ Session::get('email_password_does_not_match') }}
             </div>
            @endif
            @if (Session::has('login_failed'))
            <div class="alert alert-danger">
                {{ Session::get('login_failed') }}
            </div>
        @endif


         <form class="mt-2 pt-2" action="{{ route('login') }}" method="POST">
             @csrf
             <div class="form-group mb-3">
                 <input type="text" class="form-control" id="input-username" name="name" placeholder="Enter User Name" {{ old('name') ? 'checked' : '' }}>
                 @error('name')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror


             </div>

             <div class="form-group mb-3 auth-pass-inputgroup">
                 <input type="password" class="form-control pe-5" id="password-input" name="password" placeholder="Enter Password">
                 @error('password')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror

             </div>

             <div class="mb-3">
                 <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
             </div>
         </form>

         <div class="mt-2 text-center">
             <p class="text-muted mb-0">Don't remember your account ? <a href="{{ route('password.request') }}"
                     class="text-primary fw-semibold"> Forgot Password </a> </p>
         </div>


     </div>
 @endsection
