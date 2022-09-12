<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">
        <title>Task </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Styles -->


    </head>
    <body style="width:100%;height:100vh;">
        <div class="home-page" >
            <div class="row">
                <div class="col-lg-6 col-md-10 col-sm-10 col-10 m-auto mt-5"
                    <div class="row mt-5">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-11"><H2>APPLICATION SUBMISSION FORM</H2></div>
                                        <div class="col-lg-1">
                                            <a class="btn btn-sm btn-primary" href="{{ route('login') }}">Login

                                            </a>
                                        </div>


                                    <form action="{{ route('user.application.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="fname">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" value="{{ old('fname') }}">
                                                    @error('fname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="lname">last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" id="lname" value="{{ old('lname') }}">
                                                    @error('lname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="previousDegree">Previous Degree <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('previousDegree') is-invalid @enderror" name="previousDegree"  value="{{ old('previousDegree') }}">
                                                    @error('previousDegree')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="dob">Date Of Birth <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"  value="{{ old('dob') }}">
                                                    @error('dob')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="country">Country <span class="text-danger">*</span></label>
                                                    <select id="countryName" name="country" class="form-select @error('country') is-invalid @enderror">
                                                        <option value="">Select A Country</option>
                                                        @foreach (getCountry() as $country )
                                                            <option value="{{ $country->name }}">
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('country')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <label for="email">Phone <span class="text-danger">*</span></label>
                                                <div class="input-group">

                                                    <div  class="input-group-text">
                                                        <select  name="countryCode">
                                                          <option  id='countryCode'  value=""></option>
                                                        </select>
                                                    </div>
                                                    <input id="phoneNumber" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="">

                                                </div>
                                                @if (count($errors) > 0)

                                                    @foreach ($errors->all() as $error)
                                                        @if ($error == 'validation.phone')
                                                        <span class="text-danger">'Enter A valid Phone Number'</span>
                                                        @endif

                                                    @endforeach

                                                @endif
                                                {{--  <div class="mt-3 div">
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>  --}}
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="country">Program <span class="text-danger">*</span></label>
                                                    <select id="program" name="program" class="form-select @error('program') is-invalid @enderror">
                                                        <option value="">Select A Program</option>

                                                        <option {{ (old("program") == 'CSE' ? "selected":"") }}  value="CSE">
                                                            CSE
                                                        </option>
                                                        <option {{ (old("program") == 'EEE' ? "selected":"") }} value="EEE">
                                                            EEE
                                                        </option>
                                                        <option {{ (old("program") == 'BBA' ? "selected":"") }} value="BBA">
                                                            BBA
                                                        </option>
                                                        <option {{ (old("program") == 'MBA' ? "selected":"") }} value="MBA">
                                                            MBA
                                                        </option>
                                                    </select>
                                                    @error('program')
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

                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="country">Message </label>
                                                      <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
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
        <script src="{{ asset('admin_assets') }}/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
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
    </body>
</html>
