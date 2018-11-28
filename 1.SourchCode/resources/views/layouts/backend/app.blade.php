<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Backend</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/dist/css/adminlte.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/iCheck/all.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/select2/select2.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Notification -->
    <link href="{{ asset('toastr/build/toastr.css') }}" rel="stylesheet"/>
    <!-- app-backend -->
    <link href="{{ asset('css/app-backend.css') }}" rel="stylesheet"/>
    <!-- jQuery -->
    <script src="{{ asset('adminLTE3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- File manager -->
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/datatables/dataTables.bootstrap4.css') }}">
    <!-- DataTables -->
    <script src="{{ asset('adminLTE3/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminLTE3/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
</head>

<!-- setting color -->
<?php 
    $color = DB::table('system_color')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
    if (empty($color)) {
        $menuTop     = 'main-header navbar navbar-expand bg-white navbar-light border-bottom';
        $colorLogo   = 'brand-link';
        $sidebar     = 'hold-transition sidebar-mini';
        $colorActive = 'main-sidebar elevation-4 sidebar-dark-primary';
    } else{
        $menuTop     = $color->color_menu_top;
        $colorLogo   = $color->color_logo;
        $sidebar     = $color->sidebar;
        $colorActive = $color->color_active_dark;
    }
?>

<!-- setting language -->
<?php
    $language = DB::table('system_language')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
    if (empty($language)) {
        \App::setLocale('vi');
    } else {
        \App::setLocale($language->language);
    }
?>

<!-- setting system general -->
<?php
    $systemGeneral = DB::table('system_general')->select('*')->first(); 
?>
<body class="{{$sidebar}}" id="toggleSidebar">
    <div class="wrapper">

        <!-- Navbar -->
        <nav id="menuTop" class="{{$menuTop}}">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Giao diện</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-comments-o"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('adminLTE3/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <!-- <i class="fa fa-user-circle-o"></i> -->
                        <img id="imageUserLeft" src="{{ asset('image_user') }}/<?php if(!empty(Auth::user()->image)){echo Auth::user()->image;}else{echo "no_image_user.png";} ?>" alt="" width="30px" height="30px" style="border: 2px solid #fff; border-radius: 50%;">
                        <!-- <span class="badge badge-warning navbar-badge">3</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <h5 class="dropdown-item dropdown-header">Xin chào: <span id="nameUserMenuRight">{{Auth::user()->name}}</span></h5>
                        <h7>
                            <button type="button" class="btn btn-sm btn-flat btn-warning btn-block">
                                @if(Auth::user()->user_permission_id == 1)
                                    {{ 'Quản trị hệ thống' }}
                                @endif
                                @if(Auth::user()->user_permission_id == 2)
                                    {{ 'Nhân viên' }}
                                @endif
                                @if(Auth::user()->user_permission_id == 3)
                                    {{ 'Khách hàng' }}
                                @endif
                            </button>
                        </h7>
                        <div class="dropdown-divider"></div>
                        <a style="color: black !important;" href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fa fa-address-book mr-2"></i> Thông tin tài khoản
                        </a>
                        <div class="dropdown-divider"></div>
                        <a style="color: black !important;" href="#" class="dropdown-item">
                            <i class="fa fa-folder-open mr-2"></i> Nội dung cá nhân
                        </a>
                        <div class="dropdown-divider"></div>
                        @guest @else
                        <a style="color: black !important;" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-unlock mr-2"></i>Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        @endguest
                    </div>
                </li>
                <select onchange="changeLanguage()" id="language" class="choice-language">
                    <option <?php if( !empty($language) && $language->language == 'vi'){echo 'selected';} ?> value="vi">Vietnames</option>
                    <option <?php if(!empty($language) && $language->language == 'en'){echo 'selected';} ?> value="en">Englishs</option>
                </select>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside id="colorActive" class="{{$colorActive}}">
            <!-- Brand Logo -->
            <a href="{{ route('profile') }}" class="{{$colorLogo}}" id="logo">
                <img src="{{url('')}}<?php if(!empty($systemGeneral->image_logo)){echo $systemGeneral->image_logo;}else{echo "/image_default/logo.png";} ?>" alt="Logo" class="brand-image elevation-3" style="opacity: .8; width: 40px; height: 40px;">
                <span class="brand-text font-weight-light"><?php if(!empty($systemGeneral->title_logo)){echo $systemGeneral->title_logo;}else{echo "LOGO IMAGE";} ?></span>
               
            </a>
            
            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!--  Permission: customer -->
                        @if(Auth::user()->user_permission_id == 1 || Auth::user()->user_permission_id == 2 || Auth::user()->user_permission_id == 3)
                            <li class="nav-item has-treeview">
                                <a href="{{ route('indexBackend') }}" class="nav-link {{ request()->is('manager') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    <p>{{ trans('language.menu-left-control') }}</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ request()->is('manager/article') || request()->is('manager/article/category') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('manager/article') || request()->is('manager/article/category') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-pencil-square-o"></i>
                                    <p>
                                        {{ trans('language.menu-left-blog') }}
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('indexArticle')}}" class="nav-link {{ request()->is('manager/article') ? 'active' : '' }}">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>{{ trans('language.menu-left-blog-list') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('categoryArticle')}}" class="nav-link {{ request()->is('manager/article/category') ? 'active' : '' }}">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>{{ trans('language.menu-left-blog-category') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile') }}" class="nav-link {{ request()->is('manager/user/profile') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-address-book"></i>
                                    <p>{{ trans('language.menu-left-user') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('indexSystem') }}" class="nav-link {{ request()->is('manager/systems') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-wrench"></i>
                                    <p>{{ trans('language.menu-left-config') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('imageManager')}}" class="nav-link {{ request()->is('manager/image') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-picture-o"></i>
                                    <p>{{ trans('language.menu-left-filemanager') }}</p>
                                </a>
                            </li>
                        @endif
                        <!--  Permission: users -->
                        @if(Auth::user()->user_permission_id == 1 || Auth::user()->user_permission_id == 2)

                        @endif
                        <!--  Permission: administrator -->
                        @if(Auth::user()->user_permission_id == 1)
                            <li class="nav-item has-treeview">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-envelope-o"></i>
                                    <p>{{ trans('language.menu-left-contact') }}</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-book"></i>
                                    <p>{{ trans('language.menu-left-page') }}</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ request()->is('manager/users') || request()->is('manager/users/create') || request()->is('manager/config') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('manager/users') || request()->is('manager/users/create') || request()->is('manager/config') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-pie-chart"></i>
                                    <p>
                                        {{ trans('language.menu-left-manager') }}
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('indexUsers') }}" class="nav-link {{ request()->is('manager/users') || request()->is('manager/users/create') ? 'active' : '' }}">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>{{ trans('language.menu-left-manager-user') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('configSystem') }}" class="nav-link {{ request()->is('manager/config') ? 'active' : '' }}">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>{{ trans('language.menu-left-manager-config') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link">
                                            <i class="fa fa-angle-right nav-icon"></i>
                                            <p>{{ trans('language.menu-left-manager-detail-permission') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        
                        <!-- Sidebar Menu -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="col-sm-12 ">
                    <!-- message success -->
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible message">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-check"></i> Thành công!</h5>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    
                    <!-- message error -->
                    @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible message">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-ban"></i> Lỗi!</h5>
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    <!-- message info -->
                    @if (Session::has('info'))
                    <div class="alert alert-info alert-dismissible message">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-info"></i> Thông tin!</h5>
                        {{ Session::get('info') }}
                    </div>
                    @endif

                    <!-- message warning -->
                    @if (Session::has('warning'))
                    <div class="alert alert-warning alert-dismissible message">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-warning"></i> Lo lắng!</h5>
                        {{ Session::get('warning') }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Start Content -->
            @yield('content')
            <!-- End Content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2018 <a target="_blank" href="http://khoivinhphan.vn">khoivinhphan.vn</a>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Author</b> Phan Khôi Vinh
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="form-group">
                <p>Thông tin hệ thống</p>
            </div>
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('adminLTE3/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminLTE3/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('adminLTE3/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('adminLTE3/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('adminLTE3/plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('adminLTE3/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('adminLTE3/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('adminLTE3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('adminLTE3/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminLTE3/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE3/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{ asset('adminLTE3/dist/js/pages/dashboard.js') }}"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{ asset('adminLTE3/dist/js/demo.js') }}"></script> -->
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('adminLTE3/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminLTE3/plugins/select2/select2.full.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('adminLTE3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- jquery-validate -->
    <script src="{{ asset('jquery-validation/dist/jquery.validate.js') }}"></script>
    <!-- Notification -->
    <script src="{{ asset('toastr/toastr.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    
    <!-- start setting editor -->
    <?php
        $editor = DB::table('system_editor')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
        if (empty($editor) || $editor->name == 'ckeditor') { ?>
            <?php 
                if (empty($editor) || $editor->version_ckeditor == 'full') { ?>
                    <!-- ckeditor full -->
                    <script src="{{ asset('ckeditor_4.11_full/ckeditor/ckeditor.js') }}"></script>
                <?php } else { ?>
                    <!-- ckeditor standard -->
                    <script src="{{ asset('ckeditor_4.11_standard/ckeditor/ckeditor.js') }}"></script>
                <?php }
            ?>
            <script>
                try{
                    CKEDITOR.replace('ckeditor', {
                        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                        filebrowserBrowseUrl: '/laravel-filemanager?type=Files'
                    });
                    CKEDITOR.add
                }catch{

                }
            </script>
        <?php } else { ?>
            <!-- tinymce -->
            <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
            <script>
                var editor_config = {
                    path_absolute : "/",
                    selector: ".timymce",
                    plugins: [
                        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                        'save table contextmenu directionality emoticons template paste textcolor'
                    ],
                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
                    relative_urls: false,
                    file_browser_callback : function(field_name, url, type, win) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                        if (type == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.open({
                            file : cmsURL,
                            title : 'Filemanager',
                            width : x * 0.8,
                            height : y * 0.8,
                            resizable : "yes",
                            close_previous : "no"
                        });
                    }
                };
                tinymce.init(editor_config);
            </script>
        <?php }
    ?>
    <!-- end setting editor -->

    <script>
        $(document).ready(function(){
            //select2
            $('.select2').select2();
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })
            // bootstrap WYSIHTML5 - text editor
            $('.textareaHTML5').wysihtml5({
                toolbar: { fa: true }
            })

            //message
            $(".message").delay(3000).slideUp();

        });

        //change language
        function changeLanguage(){
            var pathname = window.location.pathname;
            var value = $( "#language option:selected" ).val();
            var data = {
                value: value,
            }
            $.ajax({
                type: 'POST',
                url: '/manager/systems/change-language',
                data: {'data': data, '_token': '{{ csrf_token() }}'},
                success: function(result){
                    console.log(result);
                    window.location.replace(pathname);
                },
                error: function(result){
                    console.log(result);
                    toastr.error('Không thể thay đổi ngôn ngữ');
                }
            });
        }
    </script>
    
</body>

</html>