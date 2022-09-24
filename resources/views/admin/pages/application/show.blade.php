@extends('layouts.admin.admin_app')
@section('admin_page_title')
    show application | Task
@endsection
@section('application_active')
    mm-active
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Application</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.application.index') }}">All Application</a></li>
                            <li class="breadcrumb-item active">Show Application</li>
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
                        <img style="width:100px;height:100px;" class="rounded-circle" src="{{ asset('photo/user_profile') }}/{{ $application->user->photo }}" alt="profile">
                        <hr>
                        <hr>
                        <h4 class="text-start mt-3 mb-2"> Application Information </h4>
                        <table class="table table-bordered text-center mt-2">
                            <tbody>
                                <tr>
                                    @foreach ((json_decode($application->json_data)) as $key=>$value )
                                        <tr>
                                                @if ($key != 'file')
                                                    @if($key != 'countryCode')
                                                        @if($key == 'phone')
                                                        <th>{{ ucfirst(str_replace('_', ' ', $key)) }}:
                                                        </th>
                                                        <td>({{ json_decode($application->json_data)->countryCode }}) {{ $value }}</td>
                                                        @else
                                                        <th>{{ ucfirst(str_replace('_', ' ', $key)) }}:
                                                        </th>
                                                            <td>{{ $value }}</td>
                                                    @endif

                                                @endif
                                            @endif

                                        </tr>
                                    @endforeach



                                <tr>
                                    <th>Files/Images</th>
                                    <td>

                                        @if(array_key_exists("file",json_decode($application->json_data,true)))
                                            @foreach (json_decode(json_decode($application->json_data)->file) as $file )
                                                @if(substr($file, -4) =='.pdf')
                                                        <a class="btn my-2  btn-sm me-3" href="{{ route('admin.application.download',$file) }}">
                                                            {{ substr($file,3) }}
                                                        <i  class="ms-1 fas fa-download"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('photo/applications/'.$file) }}" alt="{{ $file }}" alt="{{ $file }}">
                                                            <img class="mt-2 me-2" style="width: 50px; height:50px" src="{{ asset('photo/applications/'.$file) }}" alt="{{ $file }}">
                                                        <a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $application->status }}</td>
                                </tr>

                                <tr>
                                    <th>Actions</th>
                                    <td>
                                    @if (Auth::guard('admin')->user()->can('user.index'))
                                        <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $application->id }}">
                                           Application Status  <i class="fas fa-edit"></i>
                                        </button>

                                    <!-- Static Backdrop Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $application->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="{{ route('admin.application.update',$application->id) }}" method="POST">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Update Application Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>status <span class="text-danger">*</span> </label>
                                                                    <select name="status" class="form-select  @error('status') is-invalid @enderror">
                                                                        <option value="">select status</option>

                                                                        <option disabled value="pending" @if ($application->status == 'pending')
                                                                            {{ 'selected' }}
                                                                        @endif>Pending</option>
                                                                        <option value="received" @if ($application->status == 'received')
                                                                            {{ 'selected' }}
                                                                        @endif>Received</option>

                                                                        @if($application->status == "received"|| $application->status == "accept" || $application->status == "declined"  )
                                                                        <option value="accept" @if ($application->status == 'accept')
                                                                            {{ 'selected' }}
                                                                        @endif>Accept</option>
                                                                        <option value="declined" @if ($application->status == 'declined')
                                                                            {{ 'selected' }}
                                                                        @endif>Declined</option>
                                                                        @endif

                                                                    </select>
                                                                    @error('status')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-danger " data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>

                                    @endif
                                    @if (Auth::guard('admin')->user()->can('user.edit'))
                                        <a href="{{ route('admin.application.feedback',$application->id) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-user-edit" >give feedback</i></a>
                                    @endif

                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    @if($application->feedback)
                    <h4 class="text-start mt-3 mb-2"> Application Feedback</h4>
                        @foreach ($application->feedback as $feedback )
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px">Message:
                                        </th>
                                        <td>{{  $feedback->comment }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 200px">Files/Images</th>
                                        <td>
                                            @if(json_decode($feedback->file))
                                                @foreach (json_decode($feedback->file) as $file )
                                                    @if(substr($file, -4) =='.pdf')
                                                        <a class=" me-2  btn-primary btn-sm" href="{{ route('admin.application.feedback.download',$file) }}">
                                                            {{ substr($file,3) }}
                                                        <i  class="ms-1 fas fa-download"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('photo/applications/feedback/'.$file) }}" alt="{{ $file }}">
                                                            <img class="mt-2 me-2" style="width: 50px; height:50px" src="{{ asset('photo/applications/feedback/'.$file) }}" alt="{{ $file }}">
                                                        </a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">FeedBack By</th>
                                        <td>{{ $feedback->feedbackedBy->name }}</td>
                                    </tr>

                                </tbody>

                            </table>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>
@section('admin_js')
        @if (Session::has('application_update_success'))
        <script>
                Toast.fire({
                    icon: 'success',
                    title: "{{ Session::get('application_update_success') }}"
                })
        </script>
        @endif
@endsection
@endsection
