@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách bài viết</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bài viết</li>
                    <li class="breadcrumb-item active">Danh sách bài viết</li>
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
        <a href="{{ route('createArticle') }}"><button type="button" class="btn btn-success btn-flat btn-sm">Thêm mới</button></a>
        <a href=""><button type="button" class="btn btn-default btn-flat btn-sm">Danh sách bài viết đang khóa</button></a>
    </div>
    
</div>
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table id="articles" class="table table-bordered table-hover">
                    <thead>
                        <th width="5%">#</th>
                        <th width="15%">Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </thead>    
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#articles').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                        "url": "{{ route('allArticle') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "stt" },
                { "data": "avatar" },
                { "data": "title" },
                { "data": "status" },
                { "data": "options" },
            ]    

        });
    });
</script>
@endsection