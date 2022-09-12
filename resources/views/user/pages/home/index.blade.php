@extends('layouts.user.user_app')
@section('user_page_title')
Home
@endsection
@section('home_active')
    mm-active
@endsection

@section('user_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18"> Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <span class="bg-danger">
            <h3 class="bg-success">
                for edit and view opition if admin give permission you can see show and edit icon
            </h3>
         </span>
        @if (Auth::guard('web')->user()->application->first()->status !='accept')
         <span class="bg-danger">
            <h3 class="bg-danger">
                You Have an Application After Admin Accept Your Application And give Permission to view or edit the Application then You Can Access
            </h3>
         </span>
        @else


            <div class="col-lg-8">
                <div style="height: calc(100vh - 270px);overflow-y:scroll;overflow-x:hidden;">

                    {{--  {{ Auth::guard('web')->user()->userRole->userPermissions->pluck('name') }}
                      --}}

                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">
                        <thead>
                        <tr>
                            <th>Firtst Name</th>
                            <th>Last Name</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Program</th>

                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <th>
                                        {{ Auth::guard('web')->user()->application->first()->first_name }}
                                    </th>
                                    <th>
                                        {{ Auth::guard('web')->user()->application->first()->last_name }}
                                    </th>
                                    <th>
                                        {{ Auth::guard('web')->user()->application->first()->country }}
                                    </th>
                                    <th>
                                        {{ Auth::guard('web')->user()->application->first()->phone }}
                                    </th>
                                    <th>
                                        {{ Auth::guard('web')->user()->application->first()->program }}
                                    </th>


                                    <td>
                                        @if (in_array('application.view',Auth::guard('web')->user()->userRole->userPermissions->pluck('name')->toArray()))

                                        <a href="{{route('user.application.show',Auth::guard('web')->user()->application->first()->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-eye" ></i>show Details</a>


                                        @endif
                                        @if (in_array('application.edit',Auth::guard('web')->user()->userRole->userPermissions->pluck('name')->toArray()))
                                        <a href="{{route('user.application.edit',Auth::guard('web')->user()->application->first()->id)}}" class="btn btn-sm btn-primary"><i
                                            class="fas fa-user-edit" >edit</i></a>
                                        @endif







                                    </td>
                                </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        @endif


    </div> <!-- container-fluid -->
</div>
@endsection
