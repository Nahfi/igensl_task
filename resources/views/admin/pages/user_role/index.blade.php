@extends('layouts.admin.admin_app')
@section('admin_page_title')
     User Role| Task
@endsection
@section('user_role_active')
    mm-active
@endsection
@section('admin_css_link')
    <!-- choices css -->
<link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
     <!-- choices js -->
  <script src="{{ asset('admin_assets') }}/libs/choices.js/public/assets/scripts/choices.min.js"></script>
  <!-- init js -->
  <script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add User</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">All User</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                          <form action="{{ route('admin.user.role.update',$role->id) }}" method="POST">
                              @csrf
                              <div class="row">

                                  <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                    <div class="form-group">
                                        <label for="status">Role Name <span class="text-danger">*</span></label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $role->name }}">
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                    <div class="form-group">
                                        <label for="name">Permission <span class="text-danger">*</span></label>

                                        @foreach ($permissions as $permission )

                                          <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                          <input @if (in_array($permission->id, $role->userPermissions->pluck('id')->toArray()))
                                          checked
                                          @endif type="checkbox" multiple value="{{ $permission->id }}" name="permissionIds[]" id="{{ $permission->id }}">

                                        @endforeach
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>


                              </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                          </form>
                         </div>
                         <!-- end row -->
                         <!-- end table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')




    @if (Session::has('user_role_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('user_role_update_success') }}"
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
