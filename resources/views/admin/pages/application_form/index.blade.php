@extends('layouts.admin.admin_app')
@section('admin_page_title')
    Application form  | Task
@endsection
@section('application_form_create_active')
    mm-active
@endsection
@section('admin_css_link')
     <!-- DataTables -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
    <!-- Required datatable js -->
 <script src="{{ asset('admin_assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
 <!-- Buttons examples -->
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/jszip/jszip.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
 <!-- Responsive examples -->
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
 <!-- Datatable init js -->
 <script src="{{ asset('admin_assets') }}/js/pages/datatables.init.js"></script>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Applications</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Applications</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Applications Form Element <span class="text-muted fw-normal ms-2">()</span></h5>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">

                                        <div>
                                            @if(Auth::guard('admin')->User()->can('user.create'))

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="bx bx-plus me-1"></i>  Add New
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.application.form.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12 mb-4">
                                                                  <div class="form-group">
                                                                      <label for="input_label">Input Name <span class="text-danger">*</span></label>
                                                                      <input id="input-name" placeholder="input name" type="text" class="form-control @error('input_label') is-invalid @enderror" name="input_label" id="input_label" value="{{ old('input_label') }}">
                                                                      @error('input_label')
                                                                          <span class="text-danger">{{ $message }}</span>
                                                                      @enderror
                                                                  </div>

                                                                </div>
                                                                <div class="col-12 mb-2">
                                                                  <div class="form-group">
                                                                      <label for="is_required" for="input_label">Required<span class="text-danger">*</span></label>
                                                                      <input  type="checkbox" name="is_required" id="is_required" value="1">
                                                                      @error('is_required')
                                                                          <span class="text-danger">{{ $message }}</span>
                                                                      @enderror
                                                                  </div>

                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                  <div class="form-group">
                                                                      <label for="input_name">Input Label <span class="text-danger">*</span></label>
                                                                      <input placeholder="input label" type="text" class="form-control @error('input_name') is-invalid @enderror" name="input_name" id="input_name" value="{{ old('input_name') }}">
                                                                      @error('input_name')
                                                                          <span class="text-danger">{{ $message }}</span>
                                                                      @enderror
                                                                  </div>
                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="status">Select Type <span class="text-danger">*</span> </label>
                                                                        <label for="is_country">country</label>
                                                                       <input type="checkbox" name="is_country" id="is_country" value="1" >
                                                                        <select id="input-type" name="input_type" id="status" class="form-select  @error('input_type') is-invalid @enderror">
                                                                            <option value="">Select input type
                                                                            </option>
                                                                            <option  value="text" {{ (old("input_type") == 'text' ? "selected":"") }}>Text</option>
                                                                            <option  value="email" {{ (old("input_type") == 'email' ? "selected":"") }}>Email</option>
                                                                            <option  value="file" {{ (old("input_type") == 'file' ? "selected":"") }}>File</option>
                                                                            <option  value="number" {{ (old("input_type") == 'number' ? "selected":"") }}>Number</option>
                                                                            <option  value="select" {{ (old("input_type") == 'select' ? "selected":"") }}>Select</option
                                                                            <option  value="date" {{ (old("input_type") == 'date' ? "selected":"") }}>Date</option>
                                                                            <option  value="textarea" {{ (old("input_type") == 'textarea' ? "selected":"") }}>TextArea</option>
                                                                        </select>
                                                                        @error('input_type')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-lg-12">
                                                                    <div id="select-value">
                                                                    </div>
                                                                    <div id="add-button">

                                                                    </div>
                                                                  </div>

                                                                <div class="col-12 mb-4">
                                                                  <div class="form-group">
                                                                      <label for="status">Status <span class="text-danger">*</span></label>
                                                                      <select input_name="status" id="status" class="form-select  @error('input_name') is-invalid @enderror">
                                                                          <option value="">select status</option>
                                                                          <option  value="Active" {{ (old("status") == 'Active' ? "selected":"") }}>Active</option>
                                                                          <option  value="Deactive" {{ (old("status") == 'Deactive' ? "selected":"") }}>Deactive</option>
                                                                      </select>
                                                                      @error('status')
                                                                          <span class="text-danger">{{ $message }}</span>
                                                                      @enderror
                                                                  </div>
                                                                </div>

                                                            </div>


                                                          <button type="submit" class="btn btn-sm btn-primary">Submit</button>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div style="height: calc(100vh - 270px);overflow-y:scroll;overflow-x:hidden;">


                                <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">
                                    <thead>
                                    <tr>

                                        <th>S\N</th>
                                        <th>Input Type</th>
                                        <th>Input input_name</th>
                                        <th>Input Value</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        {{--  @foreach($applications as $application)
                                            <tr>

                                                <th>{{ $loop->iteration }}</th>
                                                <th>
                                                    {{ $application->first_input_name }}
                                                </th>
                                                <th>
                                                    {{ $application->last_input_name }}
                                                </th>
                                                <th>
                                                    {{ $application->country }}
                                                </th>
                                                <th>
                                                    {{ $application->phone }}
                                                </th>
                                                <th>
                                                    {{ $application->program }}
                                                </th>
                                                <td>
                                                  {{ $application->status }}
                                                </td>

                                                <td>
                                                    @if (Auth::guard('admin')->user()->can('user.index'))
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $application->id }}">
                                                            <i class="fas fa-edit"></i>
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
                                                                                    <select input_name="status" class="form-select  @error('status') is-invalid @enderror">
                                                                                        <option value="">select status</option>

                                                                                        <option disabled value="pending" @if ($application->status == 'pending')
                                                                                            {{ 'selected' }}
                                                                                        @endif>Pending</option>
                                                                                        <option value="received" @if ($application->status == 'received')
                                                                                            {{ 'selected' }}
                                                                                        @endif>Received</option>

                                                                                        @if($application->status == "received"|| $application->status == "accept" || $application->status == "accept"  )
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
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>

                                                        <a href="{{ route('admin.application.show',$application->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye" ></i></a>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('user.edit'))
                                                        <a href="{{ route('admin.application.feedback',$application->id) }}" class="btn btn-sm btn-primary"><i
                                                            class="fas fa-user-edit" >give feedback</i></a>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('user.destroy'))
                                                        <a href="{{ route('admin.application.destroy',$application->id) }}"  class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach  --}}
                                    </tbody>
                                </table>
                            </div>
                                <!-- end table -->
                            <!-- end table responsive -->
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
    @if (Session::has('application_delete_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('application_delete_success') }}"
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
    <script>
        //jquery start
        $(function(){
            'use_strict'
            //select box on change event
            $(document).on('change','#input-type',function(e){
                $('#select-value').html('')
                $('#add-button').html('')
                $('#input-name').val(``)
                $('#input-name').attr('readonly', false);
                if($(this).val()=='file'){
                    $('#input-name').val('file[]')
                    $('#input-name').attr('readonly', true);
                }
                if($(this).val()=='select'){
                    let randSelector = genarateRandomId()
                    if( !$('#is_country').is(':checked') ){

                        $('#select-value').html(
                        `
                        <div id='${randSelector}' >
                            <div id="add-input" class="form-group mb-2">
                                <label for="input_value">Option Value <span class="text-danger">*</span></label>
                                <input required placeholder="option value" multiple name='input_value[]' type="text" class="delete form-control @error('input_value') is-invalid @enderror"  id="input_value" value="{{ old('input_value') }}">
                                <a value="${randSelector}"  id="delete-option-item" class="text-center btn btn-sm btn-danger mt-2"><i class="fas fa-trash-alt"></i> Delete All</a>
                                <button id='add-more-option' type="button" class="btn btn-primary btn-sm" >
                                    <i class="bx bx-plus me-1"></i>  Add More
                                </button
                            </div>

                        </div>
                        `
                        )
                    }


                }
                e.preventDefault()
            })
            //add more row opti
            $(document).on('click','#add-more-option',function(e){

                let randSelector = genarateRandomId()
                $('#add-input').append(
                            `
                            <div id='${randSelector}'>
                                <div class="form-group mt-2 mb-2">
                                    <input required placeholder="option value" type="text" class="form-control @error('input_value') is-invalid @enderror" name="input_value[]" multiple id="input_value" value="{{ old('input_value') }}">
                                </div>
                                <a value="${randSelector}" id="delete-option-item" class="text-center btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </div>
                            `
                        )
                e.preventDefault()

            })

            //delete option item

            $(document).on('click','#delete-option-item',function(e){
                const divId = $(this).attr('value')
                $(`#${divId}`).remove()
                e.preventDefault()
            })


            //genarate random it
            function genarateRandomId(){
                return Math.round(new Date().getTime() + (Math.random() * 100));
            }
        })
    </script>
@endsection
@endsection
