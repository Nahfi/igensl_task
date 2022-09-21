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

                                        {{--  @if(count($errors)>0)

                                            @foreach ($errors->all() as $error)

                                                <span class="text-danger">{{ $error }}</span>

                                            @endforeach
                                        @endif  --}}
                                    <form action="{{ route('user.application.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-3">
                                         @forelse ($formElememts as $element )
                                        @if($element->input_type == 'select' && $element->is_country != '1' )
                                                <div class="form-group">
                                                    <label for="{{  $element->input_name }}">{{  $element->input_label }}@if($element->is_required == 1)
                                                        <span class="text-danger">*</span>
                                                    @endif</label>
                                                        <select id="{{ $element->input_name }}" name="{{ $element->input_name }}" class="form-select @error( $element->input_name) is-invalid @enderror">
                                                            <option value="">Select A {{  $element->input_label }}</option>

                                                            @foreach (json_decode($element->input_value ) as $optionValue )
                                                            <option  value="{{ $optionValue }}">
                                                                {{ $optionValue }}
                                                            </option>
                                                            @endforeach

                                                        </select>
                                                    @error($element->input_name)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @else
                                                @if($element->input_type == 'select' && $element->is_country == '1')
                                                    <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                        <div class="form-group">
                                                            <label for="country">{{  $element->input_label }} @if($element->is_required == 1)
                                                                <span class="text-danger">*</span>
                                                            @endif</label>
                                                            <select id="countryName" name="{{ $element->input_name }}" class="form-select @error($element->input_name) is-invalid @enderror">
                                                                <option value="">Select A Country</option>
                                                                @foreach (getCountry() as $country )
                                                                    <option value="{{ $country->name }}">
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error($element->input_name)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @else
                                                  @if($element->input_type == 'file')
                                                  <div class="col-lg-12 col-md-6 col-sm-12 col-12 mt-3 mb-4">
                                                    <div style="border:1px ,solid,#000" class="form-group">
                                                        <label  for="file" > {{ $element->input_label}} (Image/PDF)  @if($element->is_required == 1)
                                                            <span class="text-danger">*</span>
                                                        @endif </label>

                                                        <input style="" id="file" multiple name="{{ $element->input_name }}" type="{{ $element->input_type }}" class="form-control @error($element->input_name) is-invalid @enderror"  >
                                                        @if(count($errors)>0)

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
                                                  @else

                                                    @if($element->input_type == 'textarea')
                                                    <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                        <div class="form-group">
                                                            <label for="country">{{ $element->input_label }}  @if($element->is_required == 1)
                                                                <span class="text-danger">*</span>
                                                            @endif  </label>
                                                              <textarea class="form-control" name="{{  $element->input_name }}" id="" cols="30" rows="10"></textarea>
                                                              <img  src="" alt="">
                                                        </div>
                                                    </div>
                                                    @else

                                                     @if($element->input_type == 'number')
                                                        @if($element->is_mobile == 1)
                                                                @if($isCountryAvailable)
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                                    <label for="email">{{ $element->input_label }} <span class="text-danger">*</span></label>
                                                                    <div class="input-group">

                                                                        <div  class="input-group-text">
                                                                            <select  name="countryCode">
                                                                                <option  id='countryCode'  value=""></option>
                                                                            </select>
                                                                        </div>
                                                                        <input id="phoneNumber" type="{{ $element->input_type }}" class="form-control @error( $element->input_name) is-invalid @enderror" name="{{  $element->input_name }}"  value="">

                                                                    </div>
                                                                    @if (count($errors) > 0)

                                                                        @foreach ($errors->all() as $error)
                                                                            @if ($error == 'validation.phone')
                                                                            <span class="text-danger">'Enter A valid Phone Number'</span>
                                                                            @endif

                                                                        @endforeach

                                                                    @endif
                                                                    <div class="mt-3 div">
                                                                        @error('phone')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                                    <label for="email">{{ $element->input_label }} <span class="text-danger">*</span></label>
                                                                        <div class="input-group">

                                                                            <div  class="input-group-text">
                                                                                <select  name="countryCode">
                                                                                    <option  id='countryCode'  value="BD,8">+880</option>
                                                                                </select>
                                                                            </div>
                                                                            <input id="phoneNumber" type="{{ $element->input_type }}" class="form-control @error( $element->input_name) is-invalid @enderror" name="{{  $element->input_name }}"  value="">

                                                                        </div>
                                                                        @if (count($errors) > 0)

                                                                            @foreach ($errors->all() as $error)
                                                                                @if ($error == 'validation.phone')
                                                                                <span class="text-danger">'Enter A valid Phone Number'</span>
                                                                                @endif

                                                                            @endforeach

                                                                        @endif
                                                                        <div class="mt-3 div">
                                                                            @error('phone')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                        @else
                                                            <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                                <div class="form-group">
                                                                    <label for="{{ $element->input_name }}">{{ $element->input_label }}  @if($element->is_required == 1)
                                                                        <span class="text-danger">*</span>
                                                                    @endif  </label>
                                                                    <input type="{{ $element->input_type  }}" class="form-control @error($element->input_name ) is-invalid @enderror" name="{{ $element->input_name }}" id="{{ $element->input_name  }}" value="{{ old($element->input_name ) }}">
                                                                    @error($element->input_name )
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        @endif
                                                     @else
                                                      <div class="col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                                        <div class="form-group">
                                                            <label for="{{ $element->input_name }}">{{ $element->input_label }}  @if($element->is_required == 1)
                                                                <span class="text-danger">*</span>
                                                            @endif  </label>
                                                            <input type="{{ $element->input_type  }}" class="form-control @error($element->input_name ) is-invalid @enderror" name="{{ $element->input_name }}" id="{{ $element->input_name  }}" value="{{ old($element->input_name ) }}">
                                                            @error($element->input_name )
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                      </div>
                                                     @endif

                                                    @endif


                                                  @endif

                                                @endif

                                        @endif

                                         @empty
                                           'No Element Found'
                                         @endforelse



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
