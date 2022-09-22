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
                    @if($application == 'none')
                      'Sorry You Dont Have Permission To View The Applications, Please Wait'

                      @else   <div class="card-body">
                        <img style="width:100px;height:100px;" class="rounded-circle" src="{{ asset('photo/user_profile') }}/{{ $application->user->photo }}" alt="profile">
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
                                                        <th>{{Str::ucfirst($key)}}:</th>
                                                        <td>({{ json_decode($application->json_data)->countryCode }}) {{ $value }}</td>
                                                        @else
                                                            <th>{{ ucfirst(str_replace('_', ' ', $key)) }}:</th>
                                                            <td>{{ $value }}</td>
                                                    @endif

                                                @endif
                                            @endif

                                        </tr>
                                    @endforeach

                                <tr>
                                    <th>Status:</th>
                                    <td> <span class="badge {{ ($application->status == 'accept' ? "bg-success":"bg-danger")  }}">{{ $application->status }}</span></td>
                                </tr>
                            </tbody>

                        </table>

                        <h2> Files/Images</h2>
                        @if(array_key_exists("file",json_decode($application->json_data)))
                            @foreach (json_decode(json_decode($application->json_data)->file) as $file )

                                @if(substr($file, -4) =='.pdf')
                                        <a class="btn my-2  btn-primary me-3" href="{{ route('user.application.download',$file) }}">
                                            {{ substr($file,3) }}
                                            <i class="ms-1 fas fa-download"></i>
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
                    @endif

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>

@endsection
