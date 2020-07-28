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


                        <div class="col-12">
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
                                                    <th>USER ID</th>
                                                    <th>Tittle</th>
                                                    <th>Image</th>
                                                    <th>Views</th>
                                                    <th>Publish Status</th>
                                                    <th>Approved Status</th>
                                                    <th>Created At</th>
                                                    <td>Action</td>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($pendingpost as $key=>$row)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $row->user->name }}</td>
                                                        <td>{{ Str::limit($row->tittle,10)}}</td>
                                                        <td><img
                                                                src="{{ asset('/public/storage/post')}}/{{$row->image }}"
                                                                class="rounded mr-75" alt="profile image" height="64"
                                                                width="64"></td>
                                                        <td>{{ $row->view_count }}</td>
                                                        <td>@if ( $row->status === 1)
                                                                <span
                                                                    class="badge badge-pill badge-glow badge-success mr-1 mb-1">Published</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-pill badge-glow badge-danger mr-1 mb-1">Not Published</span>
                                                            @endif
                                                        </td>
                                                        <td>@if ($row->is_approved === 1)
                                                                <span
                                                                    class="badge badge-pill badge-glow badge-success mr-1 mb-1">Approved</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-pill badge-glow badge-danger mr-1 mb-1">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-info">{{ $row->created_at->diffForHumans() }}</td>
                                                        <td>

                                                            <a onclick="approveid({{$row->id}})"><i
                                                                    class="feather icon-trash"></i></a>
                                                            <form id="delete-id"
                                                                  action="{{route('admin.approve',$row->id)}}"
                                                                  method="post" style="display: none">
                                                                @csrf
                                                                @method('PUT')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>USER ID</th>
                                                    <th>Tittle</th>
                                                    <th>Image</th>
                                                    <th>Views</th>
                                                    <th>Publish Status</th>
                                                    <th>Approved Status</th>
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
        function approveid(id) {
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
                    document.getElementById('delete-id').submit();
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
