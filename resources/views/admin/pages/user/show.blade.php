@extends('layouts.admin.admin_app')
@section('admin_page_title')
    Show User | Task
@endsection
@section('user_active')
    mm-active
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">All User</a></li>
                            <li class="breadcrumb-item active">Show User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <img style="width:100px;height:100px;" class="rounded-circle" src="{{ asset('photo/user_profile') }}/{{ $user->photo }}" alt="profile">
                        <hr>
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $user->address }}</td>
                                </tr>

                                <tr>
                                    <th>Created By:</th>
                                    <td>{{ $user->createdBy?$user->createdBy->name:"none"}}</td>
                                </tr>
                                <tr>
                                    <th>Edited By:</th>
                                    <td>{{ $user->edited_by != '' ? $user->editedBy->name: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $user->status }}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>
@endsection
