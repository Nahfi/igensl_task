@extends('layouts.user.user_app')
@section('user_page_title')
    show application | Task
@endsection

@section('user_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->

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
                        @if(array_key_exists("file",json_decode($application->json_data,true)))
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
                                                            <a class=" me-2  btn-primary btn-sm" href="{{ route('user.application.feedback.download',$file) }}">
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
                    @endif


                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary mb-3"> <i class="mdi mdi-logout font-size-16 align-middle me-1"></i>  logout</button>

                    </form>

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>

@endsection
