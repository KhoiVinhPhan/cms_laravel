@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thiết lập chung</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Thiết lập chung</li>
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Logo</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Thêm</a>
                            </li>
                        </ul>
                    </div>
                    <form action="{{ route('updateConfigSystem') }}" method="POST" accept-charset="utf-8" id="formUpdateConfigSystem" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{url('')}}<?php if(!empty($data->image_logo)){echo $data->image_logo;}else{echo "/image_default/logo.png";} ?>" id="holder" width="100%" height="auto">
                                            <input hidden id="thumbnail" class="form-control" type="text" name="image_logo" value="<?php if(!empty($data->image_logo)){echo $data->image_logo;} ?>">
                                            <input type="button" id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-flat btn-sm btn-block" value="Chọn hình">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tiêu đề</label>
                                                <input type="text" name="title_logo" class="form-control" value="<?php if(!empty($data->title_logo)){echo $data->title_logo;}else{echo "LOGO IMAGE";} ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    Thêm
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-outline-info btn-flat" value="Cập nhật">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    
</script>
@endsection