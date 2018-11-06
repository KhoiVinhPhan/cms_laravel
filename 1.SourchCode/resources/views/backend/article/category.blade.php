@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản lý danh mục bài viết</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bài viết</li>
                    <li class="breadcrumb-item active">Danh mục bài viết</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="form-group container-fluid">
    <div class="col-sm-12">
        <a href=""><button type="button" class="btn btn-success btn-flat btn-sm">Thêm mới</button></a>
        <a href=""><button type="button" class="btn btn-default btn-flat btn-sm">Thùng rác</button></a>
    </div>
    
</div>

<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <button type="button" class="btn btn-danger btn-flat btn-sm" id="btnDeleteUser">Xóa nhiều</button>
                
                <!-- search -->
                <div class="card-tools">
                    <form action="" method="GET" accept-charset="utf-8" id="searchUser" enctype="multipart/form-data">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="searchUser" class="form-control float-right" placeholder="Tìm kiếm theo email" value="@if(isset($searchUser)) {{$searchUser}} @endif">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all"></th>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" id="" method="POST" accept-charset="utf-8">
                        @csrf
                            @php($stt=0)
                            @foreach($categorys as $item)
                            @php($stt = $stt+1)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="" name="user_id[]">
                                    </td>
                                    <th>1</th>
                                    <th>{{$item['name']}}</th>
                                    <td>
                                        ghfdgh
                                    </td>
                                </tr>
                               
                                @foreach($item['parrent_id'] as $value)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="" name="user_id[]">
                                        </td>
                                        <th>1</th>
                                        <th>{{$value['name']}}</th>
                                        <td>
                                            ghfdgh
                                        </td>
                                    </tr>
                                @endforeach
                                
                            @endforeach
                        </form>
                    </tbody>
                </table>
                
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="pull-right">
                    
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
</script>
@endsection