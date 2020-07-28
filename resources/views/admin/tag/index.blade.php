@extends('layouts.backend.app')
@section('tittle', 'Tag ')

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
                                    Add New Tag
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.tag.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="tag_name"
                                                   placeholder="Enter Your Tag">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">ADD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card border-info text-center bg-transparent">
                                <div class="card-header">
                                    <h4 class="card-title">Tag List</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped dataex-html5-selectors">
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
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td> <span class="badge badge-pill badge-glow badge-success mr-1 mb-1">{{$row->posts->count()}}</span></td>
                                                        <td class="text-info">{{ $row->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <a href="{{route('admin.tag.edit',$row->id)}}"><i
                                                                    class="feather icon-check-circle font-medium-5 info"> </i></a>

                                                            <a onclick="deleteid({{$row->id}})"><i
                                                                    class="feather icon-delete font-medium-5 danger"></i></a>
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
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tag Name</th>
                                                    <th>Post Count</th>
                                                    <th>Created At</th>
                                                    <td>Action</td>
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
