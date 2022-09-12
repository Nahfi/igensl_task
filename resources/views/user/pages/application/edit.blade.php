
@extends('layouts.user.user_app')
@section('user_page_title')
    edit application | Task
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

                            <li class="breadcrumb-item active">Edit Application</li>
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
                        <div class="row">
                            <div class="col-lg-6 col-md-10 col-sm-10 col-10 m-auto mt-5"
                                <div class="row mt-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-11"><H2>Update APPLICATION SUBMISSION FORM</H2></div>



                                                <form action="{{ route('user.application.update',$application->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                            <div class="form-group">
                                                                <label for="fname">First Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" value="{{ $application->first_name }}">
                                                                @error('fname')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                            <div class="form-group">
                                                                <label for="lname">last Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" id="lname" value="{{$application->last_name  }}">
                                                                @error('lname')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                            <div class="form-group">
                                                                <label for="previousDegree">Previous Degree <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('previousDegree') is-invalid @enderror" name="previousDegree"  value="{{ $application->previous_degree }}">
                                                                @error('previousDegree')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                            <div class="form-group">
                                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ $application->email }}">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                            <div style="border:1px ,solid,#000" class="form-group">
                                                                <label  for="file" >Image/PDF  </label>

                                                                <input style="" id="file" multiple name="file[]" type="file" class="form-control @error('file') is-invalid @enderror"  >
                                                                @if (count($errors) > 0)

                                                                        @foreach ($errors->all() as $error)
                                                                            @if ($error == 'Only images and pdf format are allowed')
                                                                            <span class="text-danger">{{ $error }}</span>
                                                                            @endif

                                                                        @endforeach

                                                                @endif

                                                                <div id="image-preview" class="my-2"></div>
                                                                <div id="file-preview"></div>
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
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                            <div class="form-group">
                                                                <label for="country">Message </label>
                                                                  <textarea class="form-control" name="message" id="" cols="30" rows="10">{{ $application->message }}</textarea>
                                                                  <img  src="" alt="">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>
@section( 'user_js')
@if (Session::has('application_update'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('application_update') }}"
            })
        </script>
@endif
<script>
    //ajax start
    $(function(){
        'use_strict'

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //get country name in onChange
        $(document).on('change','#countryName',function(e){
            let  countryName = $(this).val()

            //ajax call for country information
            $.ajax({
                method:'get',
                url:`/application/country/${countryName}`,
                dataType:'json'
            }).then(reponse =>{
                if(reponse.success){
                    $('#countryCode').val(`${reponse.countryInfo.iso},${reponse.countryInfo.phonecode}`)
                    $('#countryCode').html(`+${reponse.countryInfo.phonecode}`)
                }
            })
            e.preventDefault();


        })

        //file upload preview
        $(document).on('change', '#file', function(e) {
            $('#file-preview').html('');
            $('#image-preview').html('');
            let files = e.target.files;
            files = Array.from(files);
            files.forEach(file => {
                if(file.type == 'application/pdf'){
                    let src = URL.createObjectURL(file);
                    $('#file-preview').append(`<embed src='${src}' class=" me-2" width="150" height="150">`);
                } else {
                    $('#image-preview').append(
                        `<img alt='${file.type}'style='width: 150px; height:150px' class='img-thumbnail me-2 f-left' src='${URL.createObjectURL(file)}'>`
                        );
                }
            })
        })

    })
</script>
@endsection
@endsection
