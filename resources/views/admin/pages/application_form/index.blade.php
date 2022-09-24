@extends('layouts.admin.admin_app')
@section('admin_page_title')
    Application Form Builder | Task
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
                    <h4 class="mb-sm-0 font-size-18">Form Elements</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Form Elements</li>
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
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Form Elements  <span class="text-muted fw-normal ms-2">({{ $formElements->count() }})</span></h5>

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
                                                        <h5 class="modal-title" id="exampleModalLabel">Form Builder</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.application.form.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                  <div class="form-group">
                                                                      <label for="is_required" for="input_label">Required</label>
                                                                      <input  type="checkbox" name="is_required" id="is_required" value="1">
                                                                      @error('is_required')
                                                                          <span class="text-danger">{{ $message }}</span>
                                                                      @enderror
                                                                  </div>

                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                  <div class="form-group">
                                                                      <label for="input_label">Input Label <span class="text-danger">*</span></label>
                                                                      <input placeholder="input label" type="text" class="form-control @error('input_label') is-invalid @enderror" name="input_label" id="input_label" value="{{ old('input_label') }}">
                                                                      @error('input_label')
                                                                          <span class="text-danger">{{ $message }}</span>
                                                                      @enderror
                                                                  </div>
                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="status">Select Type <span class="text-danger">*</span> </label>

                                                                        <div id='is-country' class="is_country">
                                                                            <label for="is_country">country</label>
                                                                            <input type="checkbox" name="is_country" id="is_country" value="1" >
                                                                        </div>
                                                                        <div id='is-mobile' class="is_mobile">
                                                                            <label for="is_mobile">Mobile</label>
                                                                            <input type="checkbox" name="is_mobile" id="is_mobile" value="1" >
                                                                        </div>
                                                                        <select id="input-type" name="input_type" id="status" class="form-select  @error('input_type') is-invalid @enderror">
                                                                            <option value="">Select input type
                                                                            </option>
                                                                            <option  value="text" >Text</option>
                                                                            <option  value="email" >Email</option>
                                                                            <option  value="file">File</option>
                                                                            <option  value="number" >Number</option>
                                                                            <option  value="select" >Select</option
                                                                            <option  value="date">Date</option>
                                                                            <option  value="textarea">TextArea</option>
                                                                        </select>
                                                                        @error('input_type')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                  </div>
                                                                <div class="col-lg-12">
                                                                    <div id="add-input">
                                                                    </div>
                                                                    <button id='add-more-option' type="button" class="btn btn-primary btn-sm" >
                                                                        <i class="bx bx-plus me-1"></i>  Add More
                                                                    </button
                                                                </div>

                                                                <div class="col-12 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="priority-id">Priority <span class="text-danger">*</span></label>
                                                                        <input  type="number" name="priority_id" id="priority-id" class="form-control"  >
                                                                            <span id="priority-error" class="text-danger"></span>
                                                                    </div>
                                                                  </div>

                                                                <div class="col-12 mb-4">
                                                                  <div class="form-group">
                                                                      <label for="status">Status <span class="text-danger">*</span></label>
                                                                      <select name="status" id="status" class="form-select  @error('status') is-invalid @enderror">
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

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
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
                                        <th>Input Type </th>
                                        <th>Input Label</th>
                                        <th>Input Name</th>
                                        <th>Input Value</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($formElements as $formElement)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $formElement->input_type }}
                                                </td>
                                                <td>
                                                    {{ $formElement->input_label }}
                                                    @if ($formElement->is_required == 1)
                                                     <span class="text-danger">*</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ $formElement->input_name }}
                                                </td>
                                                <td>
                                                    {{ $formElement->input_value?$formElement->input_value :'no value'}}
                                                </td>

                                                <td>
                                                   <span class="badge {{ ($formElement->status == 'Active' ? "bg-success":"bg-danger")  }}">{{ $formElement->status }}</span>
                                                </td>

                                                <td>
                                                    @if (Auth::guard('admin')->user()->can('user.index'))
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $formElement->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>


                                                    <!-- Static Backdrop Modal -->
                                                        <div class="modal fade" id="staticBackdrop{{ $formElement->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <form action="{{ route('admin.application.form.update',$formElement->id) }}" method="POST">
                                                                    @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Update Form Element Status</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>status <span class="text-danger">*</span> </label>
                                                                                    <select name="status" class="form-select  @error('status') is-invalid @enderror">
                                                                                        <option value="">select status</option>

                                                                                        <option  value="Active" @if ($formElement->status == 'Active')
                                                                                            {{ 'selected' }}
                                                                                        @endif>Active</option>
                                                                                        <option  value="Deactive" @if ($formElement->status == 'Deactive')
                                                                                            {{ 'selected' }}
                                                                                        @endif>Deactive</option>

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


                                                    @endif

                                                    @if (Auth::guard('admin')->user()->can('user.destroy'))
                                                         <a href="#" value='{{ $formElement->id }}'  class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></a>

                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
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
    @if (Session::has('form_element_create_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('form_element_create_success') }}"
            })
    </script>
    @endif
    @if (Session::has('form_element_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('form_element_update_success') }}"
            })
    </script>
    @endif
    @if (Session::has('form_element_delete_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('form_element_delete_success') }}"
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
            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //select box on change event
            $('#is-country').hide()
            $('#is-mobile').hide()
            $('#add-more-option').hide()
            $(document).on('change','#input-type',function(e){

                $('#add-input').html(``)
                if($(this).val()=='select'){

                    $('#is-country').show()
                    let randSelector = genarateRandomId()
                    if(!$('#is_country').is(':checked') ){
                        $('#add-more-option').show()
                    }
                    else{
                        $('#is-mobile').hide()
                        $('#add-input').html(``)
                        $('#add-more-option').hide()
                    }
                }
                else if($(this).val()=='number'){
                    $('#is-mobile').show()
                    $('#add-input').html(``)
                    $('#add-more-option').hide()
                    $('#is-country').hide()
                }

                else{
                    $('#is-mobile').hide()
                    $('#is-country').hide()
                }
                e.preventDefault()
            })
            //add more row option
            $(document).on('click','#add-more-option',function(e){

                let randSelector = genarateRandomId()
                $('#add-input').append(
                            `
                            <div id='${randSelector}'>
                                <div class="form-group mt-2 mb-2">
                                    <input required placeholder="option value" type="text" class="form-control @error('input_value') is-invalid @enderror" name="input_value[]" multiple id="input_value" value="{{ old('input_value') }}">
                                </div>
                                <a value="${randSelector}" id="delete-option-item" class="text-center btn btn-sm btn-danger mb-2"><i class="fas fa-trash-alt"></i></a>
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

            //check box click event
            $(document).on('change','#is_country',function(e){
                toggleAddMoreButton()
            })

            //hide and show button
            function toggleAddMoreButton(){

                if ($('#is_country').is(':checked')) {
                    $('#add-more-option').hide()
                    $('#add-input').html(``)
                }
                else{
                    $('#add-more-option').show()

                }
            }
            //genarate random it
            function genarateRandomId(){
                return Math.round(new Date().getTime() + (Math.random() * 100));
            }

            // priority check
            $(document).on('keyup','#priority-id',function(e){
                const priorityNumber = ($(this).val())
                //csrf token setup
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                //ajax call for check priority
                    $.ajax({
                            method:'get',
                            url:`/admin/application/form/priority-check/${priorityNumber}`,
                            dataType:'json'
                        }).then(reponse =>{
                            if(reponse.totalElement != 0)
                            {
                                $('#priority-id').val('')
                                Toast.fire({
                                    icon: 'error',
                                    title: 'This Priority Number Is Already Taken, Try Another'
                                })
                            }

                        })

                e.preventDefault()
            })
            //sweat delete start
            $(document).on('click','.sweet_delete',function(){
                const delete_id = $(this).attr('value');
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                      const data = {
                          "_token": $('input[name=_token]').val(),
                          "id": delete_id,
                      };
                      $.ajax({
                         type:"GET",
                         url:`/admin/application/form/destroy/${delete_id}`,
                         data: data,
                         success: function (response){
                         Swal.fire(
                               'Deleted!',
                               'Form Element deleted.',
                               'success'
                             )
                             .then((result) =>{
                                location.reload();
                             });
                         }
                      });
                  }
                })
            });
        })
    </script>
@endsection
@endsection
