@extends('layouts.backend.app')
@section('tittle', 'Category -')

@push('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->
@endpush

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Column selectors with Export Options and print table -->
                <section id="column-selectors">
                    <div class="row">

                        <div class="col-3">
                            <div class="card text-white bg-gradient-primary text-center">
                                <div class="card-header">
                                    Add New Category
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.category.update',$category_single->id)}}" method="post" enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Enter Your Tag" value="{{$category_single->name}}" >
                                        </div>
                                        <img
                                            src="{{ asset('/public/storage/category')}}/{{$category_single->images }}"
                                            class="rounded mr-75"  alt="profile image" height="64"
                                            width="64">

                                        <div class="form-group">
                                            <br>
                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                                            <input type="file" id="account-upload" name="image" hidden>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-block">UPDATE</button>
                                        <button type="submit" class="btn btn-primary">ADD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Category List</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped dataex-html5-selectors">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Category images</th>
                                                    <th>Created At</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($category_all as $key=>$row)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td>                                                        <img
                                                                src="{{ asset('/public/storage/category')}}/{{$row->images }}"
                                                                class="rounded mr-75"  alt="profile image" height="64"
                                                                width="64"></td>
                                                        <td class="text-info">{{ $row->created_at->diffForHumans() }}</td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Category images</th>
                                                    <th>Created At</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Column selectors with Export Options and print table -->

            </div>

        </div>
    </div>

    <!-- END: Content-->

@endsection

@push('js')


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->
@endpush
