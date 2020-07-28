@extends('layouts.backend.app')
@section('tittle', 'Posts ')

@push('css')
    <!------------------------PAGE: Custom CSS START------------------------------->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/forms/select/select2.min.css">
    <!-- include summernote css/js -->


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">



    <!------------------------PAGE: Custom CSS END------------------------------->
@endpush

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content" >
        <div class="content-wrapper">
            <div class="content-body">
                <form action="{{route('author.post.store')}}" method="post"
                      enctype="multipart/form-data">
                @csrf

                <!-- Content types section start -->
                    <div class="row">
                        <div class="col-xl-8 col-md-8 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Add New Post</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="form-label-group">
                                                <input type="text" id="first-name-floating"
                                                       class="form-control {{$errors->has('tittle')?'is-invalid': ''}}"
                                                       placeholder="Tittle" name="tittle">
                                                <label for="first-name-floating">Tittle</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="card border-info text-center bg-transparent">
                                                    <div class="card-content">
                                                        <img
                                                            src="{{asset('public/assets/backend')}}/app-assets/images/elements/macbook-pro.png"
                                                            alt="element 04" class="float-left mt-3 pl-2 img-fluid"
                                                            width="150">
                                                        <div class="card-body">
                                                            <h4 class="card-title mt-3">Featured Images</h4>
                                                            <label
                                                                class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                                for="account-upload">Upload</label>
                                                            <input type="file" id="account-upload" name="image" hidden
                                                                   class="form-control {{$errors->has('image') ? 'is-invalid' :''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <li class="d-inline-block mr-2">
                                                    <fieldset>
                                                        <div class="vs-checkbox-con vs-checkbox-success">
                                                            <input type="checkbox" name="status" value="1" required>
                                                            <span class="vs-checkbox vs-checkbox-lg">
                                                                      <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                      </span>
                                                                    </span>
                                                            <span class="">publish</span>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <!-- Multiple Select2 start -->
                            <section class="multiple-select2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Category and Tags</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="text-bold-600 font-medium-2">
                                                        Select Category
                                                    </div>
                                                    <div class="form-group">
                                                        <select
                                                            class="select2 form-control {{$errors->has('categories') ? 'is-invalid' :''}}"
                                                            multiple="multiple"
                                                            name="categories[]">
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category->id}}">{{$category->name}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="text-bold-600 font-medium-2">
                                                        Select Tags
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="tags[]"
                                                                class="select2 form-control {{$errors->has('tags') ? 'is-valid' : 'is-invalid'}}"
                                                                multiple="multiple">
                                                            @foreach($tags as $tag)
                                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-actions divider-success">
                                                        <button type="submit"
                                                                class="btn btn-primary mr-1 waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                        <button type="reset"
                                                                class="btn btn-outline-warning waves-effect waves-light">
                                                            Cancel
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Body</h4>
                                </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <fieldset class="form-group">
                                            <textarea class="form-control" id="summernote" rows="9" name="body">

                                            </textarea>
                                        </fieldset>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
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
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/forms/select/form-select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>





    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
               height:800,
        });

        });
    </script>



    <!------------------------PAGE: Custom JS END------------------------------->
@endpush
