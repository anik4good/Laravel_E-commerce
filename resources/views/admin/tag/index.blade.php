@extends('layouts.backend.app')
@section('tittle', 'Tag ')

@push('css')
    <!------------------------PAGE: Custom CSS START------------------------------->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!------------------------PAGE: Custom CSS END------------------------------->
@endpush

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Thumb View</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Data List</a>
                                    </li>
                                    <li class="breadcrumb-item active">Thumb View
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a
                                    class="dropdown-item" href="#">Email</a><a class="dropdown-item"
                                                                               href="#">Calendar</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-thumb-view" class="data-thumb-view-header">
                    <div class="action-btns d-none">
                        <div class="btn-dropdown mr-1 mb-1">
                            <div class="btn-group dropdown actions-dropodown">
                                <button type="button"
                                        class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another
                                        Action</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- dataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-list-view dataex-html5-selectors">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tag Name</th>
                                <th>Post Count</th>
                                <th>Created At</th>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tag as $key=>$row)
                                <tr>
                                    <td class="product-name">{{ $key + 1 }}</td>
                                    <td class="product-name">{{ $row->name }}</td>
                                    <td class="product-name">{{$row->posts->count()}}
                                    </td>

                                    <td class="product-price">{{ $row->created_at->diffForHumans() }}</td>
                                    <td class="product-action">
                                   <a href="{{route('admin.tag.edit',$row->id)}}"><i
                                                class="feather icon-edit"> </i></a>
                                        <a onclick="deleteid({{$row->id}})"><i
                                                    class="feather icon-trash"></i></a>
                                    <form id="delete-id-{{$row->id}}"
                                          action="{{route('admin.tag.destroy',$row->id)}}"
                                          method="post" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- dataTable ends -->

                    <!-- add new sidebar starts -->
                    <div class="add-new-data-sidebar">
                        <div class="overlay-bg"></div>
                        <form action="{{route('admin.tag.store')}}" method="post">
                            @csrf
                            <div class="add-new-data">
                                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                                    <div>
                                        <h4 class="text-uppercase">Add New Tag</h4>
                                    </div>
                                    <div class="hide-data-sidebar">
                                        <i class="feather icon-x"></i>
                                    </div>
                                </div>
                                <div class="data-items pb-3">
                                    <div class="data-fields px-2 mt-3">
                                        <div class="row">
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-name">Tag Name</label>
                                                <input type="text" class="form-control" id="data-name" name="tag_name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                    <div class="add-data-btn">
                                        <button class="btn btn-primary">Add Data</button>
                                    </div>
                                    <div class="cancel-data-btn">
                                        <button class="btn btn-outline-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- add new sidebar ends -->
                </section>

                <!-- Data list view end -->
                <!-- Column selectors with Export Options and print table -->
            {{--                <section id="column-selectors">--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-12">--}}
            {{--                            <div class="card text-white bg-gradient-primary text-center">--}}
            {{--                                <div class="card-header">--}}
            {{--                                    Add New Tag--}}
            {{--                                </div>--}}
            {{--                                <div class="card-body">--}}
            {{--                                    <form action="{{route('admin.tag.store')}}" method="post">--}}
            {{--                                        @csrf--}}
            {{--                                        <div class="form-group">--}}
            {{--                                            <input type="text" class="form-control" name="tag_name"--}}
            {{--                                                   placeholder="Enter Your Tag">--}}
            {{--                                        </div>--}}
            {{--                                        <button type="submit" class="btn btn-primary btn-block">ADD</button>--}}
            {{--                                    </form>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-12">--}}
            {{--                            <div class="card border-info text-center bg-transparent">--}}
            {{--                                <div class="card-header">--}}
            {{--                                    <h4 class="card-title">Tag List</h4>--}}
            {{--                                </div>--}}
            {{--                                <div class="card-content">--}}
            {{--                                    <div class="card-body card-dashboard">--}}
            {{--                                        <div class="table-responsive">--}}
            {{--                                            <table class="table data-list-view">--}}
            {{--                                                <thead>--}}
            {{--                                                <tr>--}}
            {{--                                                    <th>ID</th>--}}
            {{--                                                    <th>Tag Name</th>--}}
            {{--                                                    <th>Post Count</th>--}}
            {{--                                                    <th>Created At</th>--}}
            {{--                                                    <td>Action</td>--}}

            {{--                                                </tr>--}}
            {{--                                                </thead>--}}
            {{--                                                <tbody>--}}
            {{--                                                @foreach($tag as $key=>$row)--}}
            {{--                                                    <tr>--}}
            {{--                                                        <td>{{ $key + 1 }}</td>--}}
            {{--                                                        <td>{{ $row->name }}</td>--}}
            {{--                                                        <td><span--}}
            {{--                                                                class="badge badge-pill badge-glow badge-success mr-1 mb-1">{{$row->posts->count()}}</span>--}}
            {{--                                                        </td>--}}
            {{--                                                        <td class="text-info">{{ $row->created_at->diffForHumans() }}</td>--}}
            {{--                                                        <td>--}}
            {{--                                                            <a href="{{route('admin.tag.edit',$row->id)}}"><i--}}
            {{--                                                                    class="feather icon-check-circle font-medium-5 info"> </i></a>--}}

            {{--                                                            <a onclick="deleteid({{$row->id}})"><i--}}
            {{--                                                                    class="feather icon-delete font-medium-5 danger"></i></a>--}}
            {{--                                                            <form id="delete-id-{{$row->id}}"--}}
            {{--                                                                  action="{{route('admin.tag.destroy',$row->id)}}"--}}
            {{--                                                                  method="post" style="display: none">--}}
            {{--                                                                @csrf--}}
            {{--                                                                @method('DELETE')--}}
            {{--                                                            </form>--}}
            {{--                                                        </td>--}}
            {{--                                                    </tr>--}}
            {{--                                                @endforeach--}}
            {{--                                                </tbody>--}}
            {{--                                                <tfoot>--}}
            {{--                                                <tr>--}}
            {{--                                                    <th>ID</th>--}}
            {{--                                                    <th>Tag Name</th>--}}
            {{--                                                    <th>Post Count</th>--}}
            {{--                                                    <th>Created At</th>--}}
            {{--                                                    <td>Action</td>--}}
            {{--                                                </tr>--}}
            {{--                                                </tfoot>--}}
            {{--                                            </table>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </section>--}}
            <!-- Column selectors with Export Options and print table -->
            </div>

        </div>
    </div>

    <!-- END: Content-->

@endsection

@push('js')


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <!-- END: Page Vendor JS-->



    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/ui/data-list-view.js"></script>
    <!-- END: Page JS-->

    {{--    sweet alert--}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@3.2.0/wordpress-admin/wordpress-admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function deleteid(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-id-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }


    </script>

    <!------------------------PAGE: Custom JS END------------------------------->
@endpush
