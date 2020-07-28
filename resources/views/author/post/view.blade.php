@extends('layouts.backend.app')
@section('tittle', 'Posts ')

@push('css')
    <!------------------------PAGE: Custom CSS START------------------------------->


    <!------------------------PAGE: Custom CSS END------------------------------->
@endpush

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Content types section start -->
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <a href="{{route('admin.post.index')}}"
                           class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light">Back</a>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        @if($post->is_approved ==1)
                            <button
                                class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">Approved
                            </button>

                        @else
                            <button
                                class="btn bg-gradient-danger mr-1 mb-1 waves-effect waves-light">Not Approved
                            </button>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9 col-md-9 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">{{$post->tittle}}</h4>
                                    <h6 class="card-subtitle text-muted">Posted By
                                        <span
                                            class="text-success">{{$post->user->name}}</span> <span
                                            class="text-light">{{$post->created_at->diffForHumans()}}</span></h6>
                                </div>

                                <div class="card-body">
                                    <p class="card-text">
                                        {!! $post->body !!}}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-3 col-sm-12">
                        <div class="card text-white bg-gradient-info text-center">
                            <div class="card-content">

                                <div class="card-body">
                                    <h4 class="card-title">Categories</h4>
                                    @foreach($post->categories as $category)
                                        <span class="badge badge-pill badge-info badge-md">{{$category->name}}</span>
                                    @endforeach

                                </div>


                            </div>
                        </div>
                        <div class="card text-white bg-gradient-success text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Tags</h4>
                                    @foreach($post->tags as $tag)
                                        <span class="badge badge-pill badge-success badge-md">{{$tag->name}}</span>
                                    @endforeach

                                </div>


                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header mb-1">
                                <h4 class="card-title">Featured Images</h4>
                            </div>
                            <div class="card-content">
                                <img class="card-img-top img-fluid"
                                     src="{{ asset('/public/storage/post')}}/{{$post->image }}"
                                     alt="Card image cap">
                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- END: Content-->

@endsection

@push('js')
    <!------------------------PAGE: Custom JS START------------------------------->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- END: Page JS-->
    {{--    sweet alert--}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@3.2.0/wordpress-admin/wordpress-admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>


    <!------------------------PAGE: Custom JS END------------------------------->
@endpush
