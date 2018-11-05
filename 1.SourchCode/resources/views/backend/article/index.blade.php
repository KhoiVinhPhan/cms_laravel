@extends('layouts.backend.app')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh mục bài viết</h1>
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
        <a href=""><button type="button" class="btn btn-default btn-flat btn-sm">Danh sách đã xóa</button></a>
    </div>
    
</div>

<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <button type="button" class="btn btn-danger btn-flat btn-sm" id="">Xóa chọn</button>
                
                <!-- search -->
                <div class="card-tools">
                    <form action="{{ route('indexUsers') }}" method="GET" accept-charset="utf-8" id="searchUser" enctype="multipart/form-data">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="searchUser" class="form-control float-right" placeholder="Tìm kiếm theo tên" value="@if(isset($searchUser)) {{$searchUser}} @endif">

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
                            <th>name</th>
                            <th>category_article_id</th>
                            <th>parrent_id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category_articles as $item)
                        <tr>
                            <td><input type="checkbox" id="check_all"></td>
                            <td></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->category_article_id}}</td>
                            <td>{{$item->parrent_id}}</td>
                        </tr>
                        @endforeach
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
@endsection