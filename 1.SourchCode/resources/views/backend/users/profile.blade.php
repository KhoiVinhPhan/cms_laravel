@extends('layouts.backend.app')
@section('content')
<style type="text/css" media="screen">
	#image_user {
	 	width: 0px;
	 	height: 0px;
	 	overflow: hidden;
	}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thông tin tài khoản</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Thông tin tài khoản</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<form action="" method="POST" accept-charset="utf-8" id="formUserUpdate" enctype="multipart/form-data">
	@csrf
	<div class="container-fluid">
		<div class="col-md-12">
		    <div class="card card-info">
		        <div class="card-header">
		            <h3 class="card-title">Chi tiết</h3>
		        </div>
		        <div class="card-body">
		        	<div class="row">
		        		<div class="col-md-2">
							<img id="image" src="{{ asset('image_user') }}/<?php if(!empty($profile->filename)){echo $profile->filename;}else{echo "no_image_user.png";} ?>" style="width: 100%; height: auto;">
							<button id="choice_image" type="button" class="btn btn-primary btn-block btn-flat btn-sm">Thay đổi</button>
							<input name="image_user" type="file" id="image_user" />
							<button data-toggle="modal" data-target="#modalChangePassword" type="button" class="btn btn-outline-primary btn-block btn-flat btn-sm">Thay đổi mật khẩu</button>
						</div>
						<div class="col-md-5">
							<div class="form-group">
			                  	<label>Email:</label>
			                  	<div class="input-group">
				                    <div class="input-group-prepend">
				                      	<span class="input-group-text"><i class="fa fa-envelope"></i></span>
				                    </div>
			                    	<input type="email" name="email" class="form-control" value="{{$profile->email}}" disabled>
			                  	</div>
			                </div>
			                <div class="form-group">
			                  	<label>Tên:</label><span style="color:red"> *</span>
			                  	<div class="input-group">
				                    <div class="input-group-prepend">
				                      	<span class="input-group-text"><i class="fa fa-user-o"></i></span>
				                    </div>
			                    	<input type="text" name="name" id="name" class="form-control" value="{{$profile->name}}">
			                  	</div>
			                </div>
			                <div class="form-group">
								<label>Giới tính: </label>
								<label class="radio-inline"><input <?php if(!empty($profile->gender) && $profile->gender == 1) echo "checked"; ?> class="flat-red" type="radio" name="gender" value="1"> Nam</label>
								<label class="radio-inline"><input <?php if(!empty($profile->gender) && $profile->gender == 2) echo "checked"; ?> class="flat-red"  type="radio" name="gender" value="2"> Nữ</label>
								<label class="radio-inline"><input <?php if(!empty($profile->gender) && $profile->gender == 3) echo "checked"; ?> class="flat-red"  type="radio" name="gender" value="3"> Khác</label>
							</div>
							<div class="form-group">
			                  	<label>Địa chỉ:</label>
			                  	<div class="input-group">
				                    <div class="input-group-prepend">
				                      	<span class="input-group-text"><i class="fa fa-address-card"></i></span>
				                    </div>
			                    	<input type="text" name="address" class="form-control" value="{{$profile->address}}">
			                  	</div>
			                </div>
			                <div class="form-group">
								<div class="input-group">
								    <input type="number" id="phoneUser" class="form-control" placeholder="Điện thoại">
								    <div class="input-group-btn">
								      	<button class="btn btn-info btn-flat" type="button" onclick="addPhoneUser()">
								        	<i class="fa fa-plus"></i>
								      	</button>
								    </div>
								</div>
								<div id="appendPhoneUser">
									@if(!empty($profile->phone))
										@php( $array_phone = explode(',', $profile->phone) )
										@foreach($array_phone as $item)
											<div class="input-group phone-group addWhere">
							    				<input readonly type="number" name="phoneUser[]content" class="form-control input-phone-content" value="{{$item}}">
							    				<div class="input-group-btn">
							    					<button class="btn btn-default button-remove" type="button" onclick="deletePhoneUser()">
							    						<i class="fa fa-times"></i>
							    					</button>
							    				</div>
							    			</div>
										@endforeach
									@endif
								</div>
							</div>
							
							
						</div>
						<div class="col-md-5">
							<label>Ngày sinh:</label>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
									    <select class="form-control select2" style="width: 100%;" name="date">
									    	<option value="">Ngày</option>
									    	<?php for ($i=1; $i <= 31; $i++) { ?>
									    		<option <?php if($i== $profile->date){echo 'selected';} ?> value="{{$i}}">{{ $i }}</option>
									    	<?php } ?>
									    </select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
									    <select class="form-control select2" style="width: 100%;" name="month">
									    	<option value="">Tháng</option>
									        <?php for ($i=1; $i <= 12; $i++) { ?>
									    		<option <?php if($i== $profile->month){echo 'selected';} ?> value="{{$i}}">{{ $i }}</option>
									    	<?php } ?>
									    </select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
									    <select class="form-control select2" style="width: 100%;" name="year">
									    	<option value="">Năm</option>
									    	<?php for ($i=1980; $i <= 2010; $i++) { ?>
									    		<option <?php if($i==$profile->year){echo 'selected';} ?> value="{{$i}}">{{ $i }}</option>
									    	<?php } ?>
									    </select>
									</div>
								</div>
							</div>
							<label>Thông tin:</label>
						    <div>
						        <textarea name="information" class="textareaHTML5" placeholder="Nhập thông tin của bạn" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if(!empty($profile->information)) {{$profile->information}} @endif</textarea>
						    </div>
						</div>
		        	</div>
		        </div>
		        <div class="card-footer">
		        	<button type="submit" class="btn btn-info btn-flat">Cập nhật</button>
		        	<a href="{{ route('profile') }}"><button type="button" class="btn btn-default btn-flat">Làm lại</button></a>
		        </div>
		        <!-- /.card-body -->
		    </div>
		    <!-- /.card -->
		</div>
	</div>
</form>

<!-- Modal - change password - start -->
<form action="{{ route('changePasswordLogin') }}" method="POST" id="formChangePassword" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="_method" value="POST">
	<div id="modalChangePassword" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title"><span class="icon-key"></span>Thay đổi mật khẩu</h5>
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		      	</div>
		      	<div class="modal-body">
		        	<div class="form-group">
					  	<label>Mật khẩu cũ <span style="color:red">*</span></label>
					  	<input onkeyup="removeErrorPassword()" type="password" class="form-control" name="password_old" id="password_old">
					  	<span class="error_password"></span>
					</div>
					<div class="form-group">
					  	<label>Mật khẩu mới <span style="color:red">*</span></label>
					  	<input type="password" class="form-control" name="password_new" id="password_new">
					</div>
					<div class="form-group">
					  	<label>Nhập lại mật khẩu mới <span style="color:red">*</span></label>
					  	<input type="password" class="form-control" name="password_new_re" id="password_new_re">
					</div>
		      	</div>
		      	<div class="modal-footer">
		      		<button id="btnChanePassword" type="button" class="btn btn-success btn-sm btn-flat">Thay đổi</button>
		        	<button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Hủy</button>
		      	</div>
	    	</div>
	  	</div>
	</div>
</form>
<!-- Modal - change password - end-->

<script>
	$(document).ready(function(){
		// Choice image
        $("#choice_image").click(function(){
            $('#image_user').trigger('click'); 
            
        });

        // Change image
        $("#image_user").change(function(){
        	if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if(validImage("#image_user"))
                    {
                        $('#image').attr('src', e.target.result);
                    }else{
                    	toastr.error('Tệp không đúng định dạng');
                        $('#image').attr('src', "{{ url('image_user/image_error.png')}}");
                    }
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        //Validate form change user profile
	    $("#formUserUpdate").validate({
	    	rules: {
	    		name: "required",
	    	},
	    	messages: {
	    		name: "<h6 style='color: red'>Tên không được để trống</h6>",
	    	}
	    });

	    //Change user profile
        $('#formUserUpdate').on('submit',(function(e) {
	        e.preventDefault();
	        var formData = new FormData(this);
	        var $form = $(this);
	        if(! $form.valid()) return false;
	        $.ajax({
	            type:'POST',
	           	url: '/manager/user/update',
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	            	console.log(data);
	            	//Chèn name và image vào menu right
	            	$("#nameUserMenuRight").html($("#name").val());
	            	$("#imageUserLeft").attr({
	            		src: $('#image').attr('src'),
	            	});

	            	if(data == 'success')
	                	toastr.success('Lưu thành công');
	                else
	                	toastr.error('Lưu không thành công');
	            },
	            error: function(data){
	            	console.log(data);
	                toastr.error('Lỗi hệ thống khi lưu')
	            }
	        });
	    }));

        //Validate form change password
	    $("#formChangePassword").validate({
	    	rules: {
	    		password_old : {
	    			required 	: true,
	    			minlength	: 6,
	    		},
	    		password_new : {
	    			required 	: true,
	    			minlength	: 6,
	    		},
	    		password_new_re : {
	    			required 	: true,
	    			equalTo		: "#password_new",
	    			minlength	: 6,
	    		},
	    	},
	    	messages: {
	    		password_old : {
	    			required	: "<h6 style='color: red'>Không được để trống</h6>",
	    			minlength	: "<h6 style='color: red'>Không được dưới 6 ký tự</h6>",
	    		},
	    		password_new : {
	    			required	: "<h6 style='color: red'>Không được để trống</h6>",
	    			minlength	: "<h6 style='color: red'>Không được dưới 6 ký tự</h6>",
	    		},
	    		password_new_re : {
	    			required	: "<h6 style='color: red'>Không được để trống</h6>",
	    			minlength	: "<h6 style='color: red'>Không được dưới 6 ký tự</h6>",
	    			equalTo		: "<h6 style='color: red'>Mật khẩu mới không khớp với nhau</h6>",
	    		},
	    	}
	    });

        //Change password
	    $("#btnChanePassword").click(function(){
	    	var data = $("#formChangePassword").serialize();
	    	var $form = $("#formChangePassword");
	    	if(!$form.valid()) return false;
	    	$.ajax({
	    		type: "POST",
	    		url: "/manager/user/change-password-login",
	    		data: data,
	    		success: function(result){
	    			console.log(result);
	    			if(result == 'success'){
	                	toastr.success('Thay đổi mật khẩu thành công');
	                	$(".error_password").html('');
	                	$("#password_old").val('');
	                	$("#password_new").val('');
	                	$("#password_new_re").val('');
	                	$("#modalChangePassword").modal('hide');
	    			}
	                else{
	                	$(".error_password").html('');
	                	$(".error_password").append('<h6 style="color: red">Mật khẩu cũ không chính xác</h6>');
	                }
	    		},
	    		error: function(result){
	    			console.log(result);
	    			toastr.error('Lỗi hệ thống khi lưu');
	    		}
	    	});

	    });

	});

	// Valid Image
	function validImage(file_id)
    {
        var fileExtension	= ['jpg','jpeg', 'png'];
        var valid 			= true;
        var msg 			= "";	

        if($(file_id).val() == ''){
            valid = false;
        }else{
            var fileName = $(file_id).val();
            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
            if ($.inArray(fileNameExt, fileExtension) == -1) {
                valid = false;
            }
        }

        return valid //true or false
    }

    //Add phone
	function addPhoneUser(){
		var phone = $("#phoneUser").val();
		var str = phone;
		var addWhere = document.getElementsByClassName('addWhere'+str);
    	var html =
    			"<div class='input-group phone-group addWhere"+str+"'>"
    			+"	<input readonly type='number' name='phoneUser[]' class='form-control input-phone-content' value='"+phone+"'>"
    			+"	<div class='input-group-btn'>"
    			+"		<button class='btn btn-default btn-flat button-remove' type='button' onclick='deletePhoneUser()'>"
    			+"			<i class='fa fa-times'></i>"
    			+"		</button>"
    			+"	</div>"
    			+"</div>";
    	if(phone.length > 0 && addWhere.length == 0){
    		$("#appendPhoneUser").append(html);
    		$("#phoneUser").val('');
    	}
    	
    	$(".phone-group").each(function(index){
    		$(this).find("input.input-phone-content").attr("name", "phoneUser["+index+"]");
    	});
	}

	//Delete phone
	function deletePhoneUser(){
		$("#appendPhoneUser").on("click", ".button-remove", function(){
			var index = $(this).closest("div.phone-group").index();
			$(this).closest("div.phone-group").remove();
		});
	}

	function removeErrorPassword()
    {
    	$(".error_password").html('');
    }
</script>

@endsection