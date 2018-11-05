@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thêm mới tài khoản</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lý tài khoản</li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<form action="{{ route('storeUser') }}" method="POST" accept-charset="utf-8" id="formUserCreate" enctype="multipart/form-data">
@csrf
<div class="container-fluid">
    <div class="col-sm-12">
    	<div class="card card-success">
    		<div class="card-header">
    			<h3 class="card-title">Thêm mới tài khoản</h3>
    		</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-6">
    					<div class="form-group">
                            <label>Email:</label><span style="color:red"> *</span>
                            <input type="email" name="email" id="email" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Tên:</label><span style="color:red"> *</span>
                            <input type="text" name="name" id="name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                        	<label>Phân quyền:</label>
                            <select class="form-control permission" name="permission" style="width: 100%;">
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->user_permission_id}}">{{$permission->name_permission}}</option>
                                @endforeach
                            </select>
                        </div>
    				</div>
    				<div class="col-sm-6">
    					<div class="form-group">
                            <label>Mật khẩu:</label><span style="color:red"> *</span>
                            <input type="password" name="password" id="password" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu:</label><span style="color:red"> *</span>
                            <input type="password" name="password_re" id="password_re" class="form-control" value="">
                        </div>
    				</div>
    			</div>
    		</div>
    		<div class="card-footer">
    			<button type="button" id="btnCreateUser" class="btn btn-success btn-flat">Thêm mới</button>
    			<a href="{{ route('indexUsers') }}"><button type="button" class="btn btn-default btn-flat">Danh sách user</button></a>
    		</div>
    	</div>
    </div>
</div>
</form>

<script>
	$(document).ready(function(){
		//Validate form create user
	    $("#formUserCreate").validate({
	    	rules: {
	    		email : {
                    required    : true,
                    email: true
                },
                name : {
                    required    : true,
                },
	    		password : {
                    required    : true,
                    minlength   : 6,
                },
                password_re : {
                    required    : true,
                    equalTo     : "#password",
                    minlength   : 6,
                }
	    	},
	    	messages: {
	    		email : {
                    required    : "<h6 style='color: red'>Không được để trống</h6>",
                    email   : "<h6 style='color: red'>Email không đúng định dạng</h6>",
                },
                name : {
                    required    : "<h6 style='color: red'>Không được để trống</h6>",
                },
                password : {
                    required    : "<h6 style='color: red'>Không được để trống</h6>",
                    minlength   : "<h6 style='color: red'>Không được dưới 6 ký tự</h6>",
                },
                password_re : {
                    required    : "<h6 style='color: red'>Không được để trống</h6>",
                    minlength   : "<h6 style='color: red'>Không được dưới 6 ký tự</h6>",
                    equalTo     : "<h6 style='color: red'>Mật khẩu không khớp với nhau</h6>",
                }
	    	}
	    });

	    //save user
	    $('#btnCreateUser').click(function(){
	    	if (! $('#formUserCreate').valid()) return false;
	    	var formData = $('#formUserCreate').serialize();
	    	$.ajax({
	    		type: 'POST',
	    		url: '/manager/user/check-mail',
	    		data: formData,
	    		success: function(result){
	    			console.log(result);
	    			if(result == 'success')
                        $('#formUserCreate').submit();
                    else
                        toastr.error('Email đã tồn tại');
	    		},
	    		error: function(result){
	    			console.log(result);
	    		}
	    	});
	    });
	});


</script>
@endsection