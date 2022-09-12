@extends('layouts.admin.admin_app')
@section('admin_page_title')
    Feedback | Task
@endsection
@section('application_active')
    mm-active
@endsection
@section('admin_css_link')
    <!-- choices css -->
<link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
     <!-- choices js -->
  <script src="{{ asset('admin_assets') }}/libs/choices.js/public/assets/scripts/choices.min.js"></script>
  <!-- init js -->
  <script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Create Feedback</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.application.index') }}">All Applications</a></li>
                            <li class="breadcrumb-item active">Create Feedback</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                          <form action="{{ route('admin.application.feedback.store',$id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">


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
                                        <label for="comment">Comment<span class="text-danger">*</span></label>
                                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" cols="30" rows="10">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
    </div> <!-- container-fluid -->
</div>
@section('admin_js')

     <script>
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

     </script>


    @if (Session::has('feedback_store_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('feedback_store_success') }}"
            })
    </script>
    @endif
    @if ($errors->any())
    <script>
        Toast.fire({
            icon: 'error',
            title: 'Something wrong, Please try again!!'
        })

     </script>
    @endif

@endsection
@endsection
