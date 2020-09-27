@extends('layouts.backend.app')
@section('tittle', 'Category -')

@push('css')
    <!------------------------PAGE: Custom CSS START------------------------------->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!------------------------PAGE: Custom CSS END------------------------------->
@endpush

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
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
                        <table class="table data-thumb-view dataex-html5-selectors">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category images</th>
                                <th>Category Name</th>
                                <th>Product Count</th>
                                <th>Category Status</th>
                                <th>Created At</th>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category as $key=>$row)
                                <tr>
                                    <td class="product-name">{{ $key + 1 }}</td>
                                    <td><img src="{{ asset('/public/storage/category')}}/{{$row->images }}"
                                             class="rounded mr-75" alt="profile image" height="64"
                                             width="64">
                                    </td>
                                    <td class="product-name">{{ $row->name }}</td>
                                    <td class="product-name">{{$row->posts->count()}}</td>
                                    <td>@if ( $row->status === 1)
                                            <div class="chip chip-success">
                                                <div class="chip-body">
                                                    <div
                                                        class="chip-text">Active
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chip chip-warning">
                                                <div class="chip-body">
                                                    <div
                                                        class="chip-text">Disable
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-info">{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ( $row->status === 1)
                                            <a onclick="send({{$row->id}})"><i
                                                    class="feather icon-edit">Deactive</i></a>
                                            <form id="delete-id-{{$row->id}}"
                                                  action="{{route('admin.category.status',$row->id)}}"
                                                  method="post" style="display: none">
                                                @csrf
                                                @method('PUT')
                                            </form>

                                        @else
                                            <a onclick="send({{$row->id}})"><i
                                                    class="feather icon-edit">Active</i></a>
                                            <form id="delete-id-{{$row->id}}"
                                                  action="{{route('admin.category.status',$row->id)}}"
                                                  method="post" style="display: none">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @endif
                                        <a href="{{route('admin.category.edit',$row->id)}}"><i
                                                class="feather icon-edit"> </i></a>
                                        <a onclick="deleteid({{$row->id}})"><i
                                                class="feather icon-trash"></i></a>
                                        <form id="delete-id-{{$row->id}}"
                                              action="{{route('admin.category.destroy',$row->id)}}"
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
                    <!-- add new sidebar starts -->
                    <div class="add-new-data-sidebar">
                        <div class="overlay-bg"></div>
                        <form action="{{route('admin.category.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="add-new-data">
                                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                                    <div>
                                        <h4 class="text-uppercase">Add New Category</h4>
                                    </div>
                                    <div class="hide-data-sidebar">
                                        <i class="feather icon-x"></i>
                                    </div>
                                </div>
                                <div class="data-items pb-3">
                                    <div class="data-fields px-2 mt-3">
                                        <div class="row">
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-name">Name</label>
                                                <input type="text" name="name" class="form-control" id="data-name">
                                            </div>
                                            <div class="col-sm-12 data-field-col data-list-upload">
                                                <input class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                       type="file" id="account-upload"
                                                       name="image">
                                            </div>
                                            <div class="col-sm-12 data-field-col data-list-upload">
                                                <input class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                       type="file" id="account-upload"
                                                       name="image1">
                                            </div>
                                            <div class="col-sm-12 data-field-col data-list-upload">
                                                <input class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                       type="file" id="account-upload"
                                                       name="image2">
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
                        <!-- add new sidebar ends -->
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-12">--}}
                    {{--                            <div class="card text-white bg-gradient-primary text-center">--}}
                    {{--                                <div class="card-header">--}}
                    {{--                                    Add New Category--}}
                    {{--                                </div>--}}
                    {{--                                <div class="card-body">--}}
                    {{--                                    <form action="{{route('admin.category.store')}}" method="post"--}}
                    {{--                                          enctype="multipart/form-data">--}}
                    {{--                                        @csrf--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <input type="text" class="form-control" name="name"--}}
                    {{--                                                   placeholder="Enter Your Tag">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"--}}
                    {{--                                                   for="account-upload">Upload new photo</label>--}}
                    {{--                                            <input type="file" id="account-upload" name="image" hidden>--}}
                    {{--                                        </div>--}}
                    {{--                                        <button type="submit" class="btn btn-primary btn-block">ADD</button>--}}
                    {{--                                    </form>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </section>
                <!-- Column selectors with Export Options and print table -->
            </div>
        </div>
    </div>

    <!-- END: Content-->

@endsection

@push('js')

    <!------------------------PAGE: Custom JS START------------------------------->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

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


    <script type="text/javascript">
        function send(id) {

            event.preventDefault();
            document.getElementById('delete-id-' + id).submit();
        }
    </script>
    <!------------------------PAGE: Custom JS END------------------------------->
@endpush
