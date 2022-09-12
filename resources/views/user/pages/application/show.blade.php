@extends('layouts.user.user_app')
@section('user_page_title')
    show application | Task
@endsection

@section('user_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Application</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Application</a></li>

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
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    <th>First Name:</th>
                                    <td>{{ $application->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name:</th>
                                    <td>{{ $application->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $application->email }}</td>
                                </tr>
                                <tr>
                                    <th>Country:</th>
                                    <td>{{ $application->country }}</td>
                                </tr>
                                <tr>
                                    <th>phone:</th>
                                    <td>{{ $application->phone }}</td>
                                </tr>
                                <tr>
                                    <th>previous degree:</th>
                                    <td>{{ $application->previous_degree }}</td>
                                </tr>
                                <tr>
                                    <th>Program:</th>
                                    <td>{{ $application->program }}</td>
                                </tr>
                                <tr>
                                    <th>date of Birth:</th>
                                    <td>{{ date("F j, Y,",strtotime($application->date_of_birth))  }}</td>
                                </tr>


                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $application->status }}</td>
                                </tr>

                            </tbody>

                        </table>

                        <h2> Message</h2>
                        <p>{{ $application->message ? $application->message :"NO MESSAGE"  }}</p>

                        <h2> Files/Images</h2>
                        @if(json_decode($application->file))

                                @foreach (json_decode($application->file) as $file )

                                    @if(substr($file, -4) =='.pdf')

                                        <a class="btn my-2  btn-primary me-3" href="{{ route('user.application.download',$file) }}">
                                            {{ substr($file,3) }}
                                        <i  class="ms-1 fas fa-download"></i>
                                        </a>


                                    @else

                                            <img class="mt-2 me-2" style="width: 50px; height:50px" src="{{ asset('photo/applications/'.$file) }}" alt="{{ $file }}">

                                    @endif

                                @endforeach

                        @endif
                        <h1 class="mt-3"> FEEDBACK</h1>
                        @if($application->feedback)
                          @foreach ($application->feedback as $feedback )
                          <h1> feebacked By : :{{ $feedback->feedbackedBy->name }}</h1>
                          <h3>Comment :{{ $feedback->comment }}</h3>
                          <h2>files/image</h2>

                          @if(json_decode($feedback->file))

                                @foreach (json_decode($feedback->file) as $file )

                                    @if(substr($file, -4) =='.pdf')

                                        <a class="btn my-2  btn-primary me-3" href="{{ route('user.application.feedback.download',$file) }}">
                                            {{ substr($file,3) }}
                                        <i  class="ms-1 fas fa-download"></i>
                                        </a>


                                    @else

                                            <img class="mt-2 me-2" style="width: 50px; height:50px" src="{{ asset('photo/applications/feedback/'.$file) }}" alt="{{ $file }}">

                                    @endif

                                @endforeach

                          @endif
                          @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>

@endsection
