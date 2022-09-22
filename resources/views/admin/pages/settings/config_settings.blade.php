@extends('layouts.admin.admin_app')
@section('settings_active')
    mm-active
@endsection
@section('admin_page_title')
 Confing Settings | Task
@endsection
@section('settings_config_active')
    active
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Config Settings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Config Settings</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
      <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <h3>Terminal</h3>

                        <hr>
                        <div class="col-12">

                            @if (Auth::guard('admin')->user()->can('configSettings.optimizeClear'))

                            <a href="{{ route('admin.settings.config.optimize.clear') }}" class="btn btn-md btn-primary">optimize:clear</a>
                            @endif

                        </div>


                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('admin.settings.config.mail') }}" method="POST">
                                @csrf

                                <div class="row">

                                    <h3>Email Configuration Section</h3>
                                    <hr>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL Trasnport<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_transport') is-invalid @enderror" name="mail_transport" value="{{ $mailSetting['mail_transport'] }}">
                                            @error('mail_transport')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_HOST<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_host') is-invalid @enderror" name="mail_host" value="{{ $mailSetting['mail_host'] }}" placeholder="ex:smtp.gmail.com">
                                            @error('mail_host')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_PORT<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_port') is-invalid @enderror" name="mail_port" value="{{ $mailSetting['mail_port'] }}" placeholder="ex:587 or 2525">
                                            @error('mail_port')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_USERNAME<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_username') is-invalid @enderror" name="mail_username" value="{{ $mailSetting['mail_username'] }}">
                                            @error('mail_username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_PASSWORD<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_password') is-invalid @enderror" name="mail_password" value="{{ $mailSetting['mail_password'] }}">
                                            @error('mail_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_ENCRYPTION<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_encryption') is-invalid @enderror" name="mail_encryption" value="{{ $mailSetting['mail_encryption'] }}" placeholder="ex:tls">
                                            @error('mail_encryption')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_FROM_ADDRESS<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('mail_from_address') is-invalid @enderror" name="mail_from_address" value="{{ $mailSetting['mail_from_address'] }}" placeholder="ex:no-replay@example.com">
                                            @error('mail_from_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>MAIL_FROM_NAME<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('mail_from_name') is-invalid @enderror" name="mail_from_name" value="{{ $mailSetting['mail_from_name'] }}" placeholder="ex:no-replay@example.com">
                                            @error('mail_from_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-md btn-primary" type="submit">Update</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
          </div>
      </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('optimize_clear'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'Optimize Clear Successfully Done'
            })
        </script>
    @endif

    @if (Session::has('mail_config'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'Mail Configaration  Successfully Done'
            })
        </script>
    @endif
    @if ($errors->any())
        <script>
            Toast.fire({
                icon: 'error',
                title: 'Something wrong, Please try again!!'
            })
        </script>
    @endif
@endsection
@endsection
