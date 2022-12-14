@extends('layouts.admin.admin_app')
@section('admin_page_title')
     All Application | Task
@endsection
@section('status_active')
'status_active'
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
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Applications <span class="text-muted fw-normal ms-2">({{ $applications->count() }})</span></h5>
                                    </div>
                                </div>
                                <form id="status-change" action="{{ route('admin.application.findByStatus') }}" method="get">
                                    {{--  @csrf  --}}
                                        <div class="col-1 mb-4">
                                            <div class="form-group">
                                                <select name="status" id="status" class="form-select  @error('name') is-invalid @enderror">
                                                    <option value="">select status</option>
                                                    <option  value="all"
                                                      @if(Route::currentRouteName() == 'admin.application.index' || request()->get('status') == 'all')
                                                        selected
                                                      @endif
                                                    >All</option>
                                                    <option  value="pending" {{  request()->get('status') == 'pending' ? "selected":"" }}>Pending</option>
                                                    <option  value="received" {{  request()->get('status') == 'received' ? "selected":"" }}>Received</option>
                                                    <option  value="accept" {{  request()->get('status') == 'accept' ? "selected":"" }}>Accept</option>
                                                    <option  value="declined" {{  request()->get('status') == 'declined' ? "selected":"" }}>Declined</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                </form>
                            </div>
                            <div style="height: calc(100vh - 270px);overflow-y:scroll;overflow-x:hidden;">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">

                                    <thead>
                                    <tr>
                                        <th>S\N</th>
                                        @foreach($applications as $application)
                                            @if($loop->iteration == 2)
                                                @break;
                                            @endif
                                                @foreach (json_decode($application->json_data) as $key=>$value )
                                                    @if($loop->iteration == 4)
                                                        @break;
                                                    @else
                                                        @if($key != 'file')
                                                                @if($key != 'countryCode')
                                                                <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                                                                @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                        @endforeach
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($applications as $application)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                @foreach (json_decode($application->json_data) as $key=>$value )
                                                    @if($loop->iteration == 4)
                                                      @break;
                                                    @else
                                                        @if($key != 'file')
                                                            @if($key != 'countryCode')
                                                                @if($key == 'phone')
                                                                   <th>({{ json_decode($application->json_data)->countryCode }}) {{ $value }}</th>
                                                                @else
                                                                  <th>{{ $value }}</th>
                                                                @endif

                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                                <td> <span class="badge {{ ($application->status == 'accept' ? "bg-success":"bg-danger")  }}
                                                 
                                                    ">{{ $application->status }}</span></td>
                                                <td>
                                                    @if (Auth::guard('admin')->user()->can('user.index'))
                                                      <a href="{{ route('admin.application.show',$application->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye" ></i></a>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('user.destroy'))

                                                        <a href="#" value='{{ $application->id }}'  class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></a>
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

    <script>
        $(function(){
            'use_strict'

            //ajax setup
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             //status on change event
             $(document).on('change','#status',function(e){
                $('#status-change').submit()
                e.preventDefault()
             })

             //sweat delete
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
                          url:`/admin/application/destroy/${delete_id}`,
                          data: data,
                          success: function (response){
                          Swal.fire(
                                'Deleted!',
                                'Applications deleted.',
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
         });

     </script>
@endsection
@endsection
