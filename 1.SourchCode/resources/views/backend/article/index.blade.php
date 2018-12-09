@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách bài viết</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bài viết</li>
                    <li class="breadcrumb-item active">Danh sách bài viết</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
                        <th width="45%%">Tiêu đề</th>
                        <th width="15%">Trạng thái</th>
                        <th width="15%">Hành động</th>
                    </thead>    
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //datatable server side: articles
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

    //change status articles
    function changeStatus(article_id){
        var checked = $("#status" + article_id).is(":checked");
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        var data = {
                status: status,
                article_id : article_id
            }
        $.ajax({
            type: 'POST',
            url: '{{route("changeStatus")}}',
            data: {'data': data, '_token': '{{ csrf_token() }}'},
            success: function(result){
                console.log(result);
                //message
                // if(result == 'success')
                //     toastr.success('Thay đổi giao diện thành công');
                // else
                //     toastr.error('Thay đổi giao diện không thành công');
            },
            error: function(result){
                console.log(result);
                // toastr.error('Lỗi hệ thống');
            }
        });
    }
</script>
@endsection