<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                                            href="">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">LARAVEL BLOG</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{--            Start Admin menu--}}
            @if(Request::is('admin*'))
                <li class=" nav-item {{Request::is('admin/dashboard') ? 'active': ''}}"><a
                        href="{{ route('admin.dashboard')  }}"><i class="feather icon-home"></i><span
                            class="menu-title" data-i18n="Dashboard">Dashboard</span><span
                            class="badge badge badge-warning badge-pill float-right">2</span></a>
                </li>
                <li class=" nav-item {{Request::is('admin/tag') ? 'active': ''}} "><a
                        href="{{route('admin.tag.index')}}"><i class="feather icon-tag"></i><span class="menu-title"
                                                                                                  data-i18n="Starter kit">Tags</span></a>
                </li>
                <li class=" nav-item {{Request::is('admin/category') ? 'active': ''}} "><a
                        href="{{route('admin.category.index')}}"><i class="feather icon-align-justify"></i><span
                            class="menu-title"
                            data-i18n="Starter kit">Category</span></a>
                </li>
                <li class=" nav-item {{Request::is('admin/post') ? 'active': ''}} "><a
                        href="{{route('admin.post.index')}}"><i class="feather icon-check-square"></i><span
                            class="menu-title"
                            data-i18n="Starter kit">Post</span></a>

                    <ul class="menu-content">
                        <li class=" nav-item {{Request::is('admin/post') ? 'active': ''}} "><a
                                href="{{route('admin.post.index')}}"><i class="feather icon-check-square"></i><span
                                    class="menu-title"
                                    data-i18n="Starter kit">Dashboard</span></a>
                        <li class=" nav-item {{Request::is('admin/post') ? 'active': ''}} "><a
                                href="{{route('admin.pendingpost')}}"><i class="feather icon-check-square"></i><span
                                    class="menu-title"
                                    data-i18n="Starter kit">Pending Post</span></a>
                    </ul>
                </li>

                <li class=" nav-item {{Request::is('admin/subscriber') ? 'active': ''}} "><a
                        href="{{route('admin.subscriber.index')}}"><i class="feather icon-zap"></i><span class="menu-title"
                                                                                                    data-i18n="Starter kit">Phone</span></a>
                </li>
                <li class=" nav-item {{Request::is('admin/phone') ? 'active': ''}} "><a
                        href="{{route('admin.phone.index')}}"><i class="feather icon-zap"></i><span class="menu-title"
                                                                                                    data-i18n="Starter kit">Phone</span></a>
                </li>


                {{--Common menu--}}
                <li class=" nav-item"><a
                        href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation"><i
                            class="feather icon-folder"></i><span class="menu-title"
                                                                  data-i18n="Documentation">Documentation</span></a>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.ticksy.com/"><i
                            class="feather icon-life-buoy"></i><span
                            class="menu-title" data-i18n="Raise Support">Raise Support</span></a>
                </li>
            @endif
            {{--            End Admin menu--}}


            {{--            Start Author menu--}}
            @if(Request::is('author*'))
                <li class=" nav-item {{Request::is('author/dashboard') ? 'active': ''}}"><a
                        href="{{ route('author.dashboard')  }}"><i class="feather icon-home"></i><span
                            class="menu-title" data-i18n="Dashboard">Dashboard</span><span
                            class="badge badge badge-warning badge-pill float-right">2</span></a>
                </li>
                <li class=" nav-item {{Request::is('author/post') ? 'active': ''}} "><a
                        href="{{route('author.post.index')}}"><i class="feather icon-check-square"></i><span
                            class="menu-title"
                            data-i18n="Starter kit">Post</span></a>
                </li>




                {{--Common menu--}}
                <li class=" nav-item"><a
                        href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation"><i
                            class="feather icon-folder"></i><span class="menu-title"
                                                                  data-i18n="Documentation">Documentation</span></a>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.ticksy.com/"><i
                            class="feather icon-life-buoy"></i><span
                            class="menu-title" data-i18n="Raise Support">Raise Support</span></a>
                </li>
            @endif
            {{--            End Author menu--}}

        </ul>
    </div>
</div>
<!-- END: Main Menu-->



