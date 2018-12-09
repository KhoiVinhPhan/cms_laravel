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
<?php 
    use App\Models\SystemPagination; 
    $pagination = SystemPagination::where('user_id', Auth::user()->user_id)->first();
    if (empty($pagination)) {
        $pageLength = 5;
    } else {
        $pageLength = $pagination['pagination_backend'];
    }
?>
<script>
    $(document).ready(function() {
        //datatable server side: articles
        $('#articles').DataTable({
            "searching"     : true,
            "lengthChange"  : true,
            "bInfo"         : true,
            "pageLength"    : '<?php echo $pageLength; ?>',
            "bPaginate"     : true,
            "language": {
                    "oPaginate": {
                        "sPrevious" : "&laquo;",
                        "sNext"     : "&raquo;",
                    },
                    "lengthMenu"    : "Thể hiện _MENU_ bản ghi cho mỗi trang",
                    "zeroRecords"   : "Không tìm thấy dữ liệu",
                    "info"          : "Danh sách: _START_ ~ _END_ của _MAX_ dữ liệu",
                    "infoEmpty"     : "Không có dữ liệu",
                    "infoFiltered"  : "(được lọc từ _MAX_ bản ghi)",
                    "search"        : "Tìm kiếm:"
                },
            "order": [[ 0, "desc" ]],
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
            },
            error: function(result){
                console.log(result);
            }
        });
    }
</script>
@endsection