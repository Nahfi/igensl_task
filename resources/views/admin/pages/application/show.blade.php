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
                        {{--  <img style="width:100px;height:100px;" class="rounded-circle" src="{{ asset('photo/user_profile') }}/{{ $application->user->photo }}" alt="profile">  --}}
                        <hr>
                        <hr>
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    @foreach ((json_decode($application->json_data)) as $key=>$value )
                                        <tr>
                                                @if ($key != 'file')

                                                    @if($key != 'countryCode')
                                                        @if($key == 'phone')
                                                        <th>{{ $key }}:</th>
                                                        <td>({{ json_decode($application->json_data)->countryCode }}) {{ $value }}</td>
                                                        @else
                                                            <th>{{ $key }}:</th>
                                                            <td>{{ $value }}</td>
                                                    @endif

                                                @endif
                                            @endif

                                        </tr>
                                    @endforeach

                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $application->status }}</td>
                                </tr>

                            </tbody>

                        </table>



                        <h2> Files/Images</h2>



                        @if(json_decode(json_decode($application->json_data)->file))
                            @foreach (json_decode(json_decode($application->json_data)->file) as $file )

                                @if(substr($file, -4) =='.pdf')
                                        <a class="btn my-2  btn-primary me-3" href="{{ route('admin.application.download',$file) }}">
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

                                        <a class="btn my-2  btn-primary me-3" href="{{ route('admin.application.feedback.download',$file) }}">
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
@section('admin_js')

@endsection
@endsection
