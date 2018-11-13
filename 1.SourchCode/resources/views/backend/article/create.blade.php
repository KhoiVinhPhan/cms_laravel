@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thêm mới bài viết</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bài viết</li>
                    <li class="breadcrumb-item active">Thêm mới bài viết</li>
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
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Chi tiết</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Thông tin thêm</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label>Tiêu đề:</label><span style="color:red"> *</span>
                                    <input type="text" name="title" id="title" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả:</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết:</label>
                                    <textarea name="details" class="form-control timymce" id="ckeditor"></textarea>
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                abc1
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Xử lý</h3>
                    </div>
                    <div class="card-body">
                        <input type="button" class="btn btn-outline-success btn-flat btn-block btn-sm" value="Thêm mới">
                    </div>
                </div>

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Trạng thái</h3>
                    </div>
                    <div class="card-body">
                        <select class="form-control" name="status" style="width: 100%;">
                            <option value="1">Công khai</option>
                            <option value="2">Bản nháp</option>
                        </select>
                    </div>
                </div>

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục</h3>
                    </div>
                    <div class="card-body">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn danh mục" style="width: 100%;">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection