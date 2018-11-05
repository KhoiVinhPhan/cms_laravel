@extends('layouts.backend.app')
@section('content')
<style type="text/css" media="screen">
    .menu-top{
        width: 40px;
        height: 20px;
        border-radius: 25px;
        margin-right: 10px;
        margin-bottom: 10px;
        opacity: 0.8;
        cursor: pointer;
        float: left;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tổng quát</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Cài đặt</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <!-- start pagination -->
                <form action="" method="POST" id="formPagination" accept-charset="utf-8">
                    @csrf
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Cấu hình phân trang</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-remove"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label>Phân trang backend</label>
                                    <select name="pagination_backend" class="form-control select2">
                                        <?php for ($i=5; $i <= 200; $i = $i+5) { ?>
                                            <option <?php if($systemPagination['pagination_backend'] == $i){ echo "selected";} ?> value="{{$i}}">{{$i}} dữ liệu</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phân trang frontend</label>
                                    <select name="pagination_frontend" class="form-control select2">
                                        <?php for ($i=5; $i <= 200; $i = $i+5) { ?>
                                            <option <?php if($systemPagination['pagination_frontend'] == $i){ echo "selected";} ?> value="{{$i}}">{{$i}} dữ liệu</option>
                                        <?php } ?>
                                    </select>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-outline-info btn-flat pull-right" id="btnPagination">Thay đổi</button>
                        </div>
                    </div>
                </form>
                <!-- end pagination -->
            </div>
            <div class="col-sm-6">
                <!-- start color -->
                <form action="" method="POST" id="formColor" accept-charset="utf-8">
                    @csrf
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa giao diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-remove"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div>
                                    <label>Menu top <a onclick="changeColorMenuTop(0)" href="javascript:;">Ban đầu</a></label>
                                </div>
                                <div onclick="changeColorMenuTop(1)" class="bg-primary elevation-2 menu-top"></div>
                                <div onclick="changeColorMenuTop(2)" class="bg-info elevation-2 menu-top"></div>
                                <div onclick="changeColorMenuTop(3)" class="bg-success elevation-2 menu-top"></div>
                                <div onclick="changeColorMenuTop(4)" class="bg-danger elevation-2 menu-top"></div>
                                <div onclick="changeColorMenuTop(5)" class="bg-warning elevation-2 menu-top"></div>
                                <div onclick="changeColorMenuTop(6)" class="bg-white elevation-2 menu-top"></div>
                                <div onclick="changeColorMenuTop(7)" class="bg-gray-light elevation-2 menu-top"></div>
                            </div>
                                
                            <div class="form-group" style="clear: left;">
                                <div>
                                    <label>Logo <a onclick="changeColorLogo(0)" href="javascript:;">Ban đầu</a></label>
                                </div>
                                <div onclick="changeColorLogo(1)" class="bg-primary elevation-2 menu-top"></div>
                                <div onclick="changeColorLogo(2)" class="bg-info elevation-2 menu-top"></div>
                                <div onclick="changeColorLogo(3)" class="bg-success elevation-2 menu-top"></div>
                                <div onclick="changeColorLogo(4)" class="bg-danger elevation-2 menu-top"></div>
                                <div onclick="changeColorLogo(5)" class="bg-warning elevation-2 menu-top"></div>
                                <div onclick="changeColorLogo(6)" class="bg-white elevation-2 menu-top"></div>
                                <div onclick="changeColorLogo(7)" class="bg-gray-light elevation-2 menu-top"></div>
                            </div>

                            <div class="form-group" style="clear: left;">
                                <div>
                                    <label>Active <a onclick="changeColorActive(0)" href="javascript:;">Ban đầu</a></label>
                                </div>
                                <div onclick="changeColorActive(1)" class="bg-primary elevation-2 menu-top"></div>
                                <div onclick="changeColorActive(2)" class="bg-info elevation-2 menu-top"></div>
                                <div onclick="changeColorActive(3)" class="bg-success elevation-2 menu-top"></div>
                                <div onclick="changeColorActive(4)" class="bg-danger elevation-2 menu-top"></div>
                                <div onclick="changeColorActive(5)" class="bg-warning elevation-2 menu-top"></div>
                            </div>

                            <div class="form-group" style="clear: left;">
                                <label><input <?php if(!empty($systemColor) && $systemColor['sidebar']=='sidebar-mini sidebar-collapse'){ echo "checked"; } ?> type="checkbox" name="sidebar" id="sidebar">
                                Sidebar (open/close)</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-flat pull-right" id="btnColor">Thay đổi</button>
                        </div>
                    </div>
                </form>
                <!-- end color -->
            </div>
        </div>  
    </div>
    <!-- /.container-fluid -->
</section>
<script>
    $(document).ready(function(){
        //save pagination
        $('#btnPagination').click(function(){
            var formData = $('#formPagination').serialize();
            $.ajax({
                type: 'POST',
                url: '/manager/systems/pagination',
                data: formData,
                success: function(result){
                    console.log(result);
                    //message
                    if(result == 'success')
                        toastr.success('Thay đổi phân trang thành công');
                    else
                        toastr.error('Thay đổi phân trang không thành công');
                    },
                error: function(result){
                    console.log(result);
                    toastr.error('Lỗi hệ thống');
                }
            });
        });

        //save color
        $('#btnColor').click(function(){
            var menuTop = $('#menuTop').attr('class');
            var logo = $('#logo').attr('class');
            var colorActive = $('#colorActive').attr('class');
            var sidebar = $('#toggleSidebar').attr('class');
            var data = {
                menuTop: menuTop,
                colorActive: colorActive,
                logo: logo,
                sidebar: sidebar,
            }
            $.ajax({
                type: 'POST',
                url: '/manager/systems/colors',
                data: {'data': data, '_token': '{{ csrf_token() }}'},
                success: function(result){
                    console.log(result);
                    //message
                    if(result == 'success')
                        toastr.success('Thay đổi giao diện thành công');
                    else
                        toastr.error('Thay đổi giao diện không thành công');
                },
                error: function(result){
                    console.log(result);
                    toastr.error('Lỗi hệ thống');
                }
            });
        });

        //checkbox toggle sidebar
        $('#sidebar').change(function () {
            if ($('#sidebar').prop( "checked" ) == false) {
                $('#toggleSidebar').attr('class','sidebar-mini'); 
            } else {
                $('#toggleSidebar').attr('class', 'sidebar-mini sidebar-collapse'); 
            }
        });

    });

    function changeColorMenuTop(color){
        switch(color) {
            case 1:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-dark bg-primary');
                break;
            case 2:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-dark bg-info');
                break;
            case 3:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-dark bg-success');
                break;
            case 4:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-dark bg-danger');
                break;
            case 5:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-light bg-warning');
                break;
            case 6:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-light bg-white');
                break;
            case 7:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand border-bottom navbar-light bg-gray-light');
                break;
            default:
                $('#menuTop').attr('class', 'main-header navbar navbar-expand bg-white navbar-light border-bottom');
        }
    }

    function changeColorLogo(color){
        switch(color) {
            case 1:
                $('#logo').attr('class', 'brand-link bg-primary');
                break;
            case 2:
                $('#logo').attr('class', 'brand-link bg-info');
                break;
            case 3:
                $('#logo').attr('class', 'brand-link bg-success');
                break;
            case 4:
                $('#logo').attr('class', 'brand-link bg-danger');
                break;
            case 5:
                $('#logo').attr('class', 'brand-link bg-warning');
                break;
            case 6:
                $('#logo').attr('class', 'brand-link bg-white');
                break;
            case 7:
                $('#logo').attr('class', 'brand-link bg-gray-light');
                break;
            default:
                $('#logo').attr('class', 'brand-link');
        }
    }

    function changeColorActive(color){
        switch(color) {
            case 1:
                $('#colorActive').attr('class', 'main-sidebar sidebar-dark-primary elevation-4');
                break;
            case 2:
                $('#colorActive').attr('class', 'main-sidebar elevation-4 sidebar-dark-info');
                break;
            case 3:
                $('#colorActive').attr('class', 'main-sidebar elevation-4 sidebar-dark-success');
                break;
            case 4:
                $('#colorActive').attr('class', 'main-sidebar elevation-4 sidebar-dark-danger');
                break;
            case 5:
                $('#colorActive').attr('class', 'main-sidebar elevation-4 sidebar-dark-warning');
                break;
            default:
                $('#colorActive').attr('class', 'main-sidebar elevation-4 sidebar-dark-primary');
        }
    }
</script>
@endsection