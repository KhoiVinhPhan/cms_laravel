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
                <h1 class="m-0 text-dark">Quản lý tài khoản</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Cấu hình hệ thống</li>
                    <li class="breadcrumb-item active">Quản lý tài khoản</li>
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
        <a href="{{ route('createUser') }}"><button type="button" class="btn btn-success btn-flat btn-sm">Thêm mới</button></a>
        <a href="{{route('restoreUser')}}"><button type="button" class="btn btn-default btn-flat btn-sm">Danh sách tài khoản đã khóa</button></a>
    </div>
    
</div>

<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <button type="button" class="btn btn-danger btn-flat btn-sm" id="btnDeleteUser">Khóa tài khoản</button>
                
                <!-- search -->
                <div class="card-tools">
                    <form action="{{ route('indexUsers') }}" method="GET" accept-charset="utf-8" id="searchUser" enctype="multipart/form-data">
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
                            <th>Ảnh đại diện</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Phân quyền</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('deleteChoiceUser') }}" id="formDeleteUser" method="POST" accept-charset="utf-8">
                        @csrf
                            @php($stt=0)
                            @foreach($users as $item)
                            @php($stt = $stt+1)
                                <tr <?php if($item->email == 'administrator@gmail.com'){ echo "style='background-color: #d4fcfc'"; } ?>>
                                    <td>
                                        @if($item->email == 'administrator@gmail.com')
                                        @else
                                            <input type="checkbox" value="{{ $item->user_id }}" name="user_id[]">
                                        @endif
                                    </td>
                                    <td>{{$stt}}</td>
                                    <td><img id="changeImageUser{{$item->user_id}}" src="{{ asset('image_user') }}/<?php if(!empty($item->filename)){echo $item->filename;}else{echo "no_image_user.png";} ?>" width="70px" height="70px"></td>
                                    <td id="changeNameUser{{$item->user_id}}">{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td id="changePermissionUser{{$item->user_id}}">{{$item->name_permission}}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        @if($item->email == 'administrator@gmail.com')
                                            <p align="center">Không thể chỉnh sửa</p>
                                        @else
                                            <button onclick="getDataUserInModal('{{ $item->user_id }}')" type="button" class="btn btn-block btn-sm btn-outline-primary btn-flat">Chi tiết</button>
                                            <button onclick="changePassword('{{ $item->user_id }}','{{$item->email}}')" type="button" class="btn btn-outline-danger btn-flat btn-sm btn-block">Đổi mật khẩu</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
                
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="pull-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Start Modal edit user -->
<form action="" method="POST" accept-charset="utf-8" id="editUserIsAdmin" enctype="multipart/form-data">
@csrf
<div class="modal fade" id="editModalUser" role="dialog">
    <input type="text" hidden name="user_id" value="" id="user_id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa tài khoản: <span class="nameUser"></span> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2">
                        <img id="image" src="{{ asset('image_user/no_image_user.png') }}" style="width: 100%; height: auto;">
                        <button id="choice_image" type="button" class="btn btn-primary btn-block btn-flat btn-sm">Thay đổi</button>
                        <input name="image_user" type="file" id="image_user" />
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Phân quyền:</label>
                            <select class="form-control permission" name="permission" style="width: 100%;">
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->user_permission_id}}">{{$permission->name_permission}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tên:</label><span style="color:red"> *</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Giới tính: </label>
                            <label class="radio-inline"><input class="flat-red" type="radio" name="gender" value="1" id="gender1"> Nam</label>
                            <label class="radio-inline"><input  class="flat-red"  type="radio" name="gender" value="2" id="gender2"> Nữ</label>
                            <label class="radio-inline"><input  class="flat-red"  type="radio" name="gender" value="3" id="gender3"> Khác</label>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                </div>
                                <input type="text" id="address" name="address" class="form-control" value="">
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
                                
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-5">
                        <label>Ngày sinh:</label>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control select2 dateUser" style="width: 100%;" name="date">
                                        <option value="">Ngày</option>
                                        <?php for ($i=1; $i <= 31; $i++) { ?>
                                            <option value="{{$i}}">{{ $i }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control select2 month" style="width: 100%;" name="month">
                                        <option value="">Tháng</option>
                                        <?php for ($i=1; $i <= 12; $i++) { ?>
                                            <option value="{{$i}}">{{ $i }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control select2 year" style="width: 100%;" name="year">
                                        <option value="">Năm</option>
                                        <?php for ($i=1980; $i <= 2010; $i++) { ?>
                                            <option value="{{$i}}">{{ $i }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label>Thông tin:</label>
                        <div>
                            <textarea name="information" id="information" class="textareaHTML5" placeholder="Nhập thông tin của bạn" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                </div>      
            </div>
            <div class="modal-footer">
                <button id="editProfile" type="submit" class="btn btn-info btn-sm btn-flat" >Thay đổi</button>
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- End Modal edit user -->

<!-- Start Modal edit user -->
<form action="" method="POST" accept-charset="utf-8" id="changePasswordUser" enctype="multipart/form-data">
@csrf
<div class="modal fade" id="changeModalPassword" role="dialog">
    <input type="text" hidden name="user_id_change_password" value="" id="user_id_change_password">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thay đổi mật khẩu: <span class="nameUserPassword"></span> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <label>Mật khẩu:</label>
                            <input type="password" name="password" id="password" class="form-control" value="" placeholder="Mật khẩu">
                        </div>
                        <div>
                            <label>Xác nhận mật khẩu:</label>
                            <input type="password" name="password_re" id="password_re" class="form-control" value="" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                </div>      
            </div>
            <div class="modal-footer">
                <button id="changePassword" type="submit" class="btn btn-success btn-sm btn-flat" >Thay đổi</button>
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- End Modal edit user -->

<script>
    $(document).ready(function(){

        //delete user
        $('#btnDeleteUser').click(function(){
            $('#formDeleteUser').submit();
        });

        //check checkbox all
        $('#check_all').change(function() {
            var checkboxes = $(this).closest('table').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        });
        //Close modal edit profile user
        $('#editModalUser').on('hidden.bs.modal', function () {
            $("#appendPhoneUser").html('');
            $( "#gender1" ).prop( "checked", false );
            $( "#gender2" ).prop( "checked", false );
            $( "#gender3" ).prop( "checked", false );
            $(".dateUser").select2('val','');
            $(".month").select2('val','');
            $(".year").select2('val','');
            $("#image").attr("src", "/image_user/no_image_user.png");
        });

        //Close modal change password user
        $('#changeModalPassword').on('hidden.bs.modal', function () {
            $("#password").val('');
            $("#password_re").val('');
        });

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
        $("#editUserIsAdmin").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "<h6 style='color: red'>Tên không được để trống</h6>",
            }
        });

        //Validate form change password
        $("#changePasswordUser").validate({
            rules: {
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

        //Change user profile
        $('#editUserIsAdmin').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                type:'POST',
                url: '/manager/user/edit-profile-is-admin',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    console.log(data);
                    $('#editModalUser').modal('hide');
                    $('#changeNameUser'+$('#user_id').val()).html($('#name').val());
                    $('#changePermissionUser'+$('#user_id').val()).html($('.permission option:selected').text());
                    $('#changeImageUser'+$('#user_id').val()).attr('src', $('#image').attr('src'));
                    //message
                    if(data == 'success')
                        toastr.success('Chỉnh sửa thành công');
                    else
                        toastr.error('Chỉnh sửa không thành công');
                },
                error: function(data){
                    console.log(data);
                    toastr.error('Lỗi hệ thống khi lưu')
                }
            });
        }));
    });

    //Add phone
    function addPhoneUser(){
        var phone = $("#phoneUser").val();
        var str = phone;
        var addWhere = document.getElementsByClassName('addWhere'+str);
        var html =
                "<div class='input-group phone-group addWhere"+str+"'>"
                +"  <input readonly type='number' name='phoneUser[]' class='form-control input-phone-content' value='"+phone+"'>"
                +"  <div class='input-group-btn'>"
                +"      <button class='btn btn-default btn-flat button-remove' type='button' onclick='deletePhoneUser()'>"
                +"          <i class='fa fa-times'></i>"
                +"      </button>"
                +"  </div>"
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

    // Valid Image
    function validImage(file_id)
    {
        var fileExtension   = ['jpg','jpeg', 'png'];
        var valid           = true;
        var msg             = "";   

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

    //Lay data user cho modal
    function getDataUserInModal(user_id){
        $.ajax({
            type: "POST",
            url: "/manager/user/get-data-user-modal",
            data: {'user_id': user_id, '_token': '{{ csrf_token() }}'},
            success: function(result){
                console.log(result);
                $('#editModalUser').modal('show');
                $('#user_id').val(result[0]['user_id']);
                $('.nameUser').html(result[0]['name']);
                $('#email').val(result[0]['email']);
                $('#name').val(result[0]['name']);

                //xu ly gender
                if(result[0]['gender'] != null){
                    if(result[0]['gender'] == 1) { $('#gender1').iCheck('check'); }
                    if(result[0]['gender'] == 2) { $('#gender2').iCheck('check'); }
                    if(result[0]['gender'] == 3) { $('#gender3').iCheck('check'); }
                }

                $('#address').val(result[0]['address']);

                //xu ly phone user
                if(result[0]['phone'] != null && result[0]['phone']!=""){
                    var array_phone = result[0]['phone'].split(',');
                    $.each(array_phone, function (index, value) {
                        $("#appendPhoneUser").append(
                            "<div class='input-group phone-group addWhere'>"
                            +"  <input readonly type='number' name='phoneUser[]' class='form-control input-phone-content' value='"+value+"'>"
                            +"  <div class='input-group-btn'>"
                            +"      <button class='btn btn-default btn-flat button-remove' type='button' onclick='deletePhoneUser()'>"
                            +"          <i class='fa fa-times'></i>"
                            +"      </button>"
                            +"  </div>"
                            +"</div>"
                        );
                    });
                }

                //xu ly date
                if(result[0]['date'] != null){
                    $(".dateUser").select2('val',result[0]['date']);
                }

                //xu ly month
                if(result[0]['month'] != null){
                    $(".month").select2('val',result[0]['month']);
                }

                //xu ly year
                if(result[0]['year'] != null){
                    $(".year").select2('val',result[0]['year']);
                }

                //xu ly information
                $('#information ~ iframe').contents().find('.wysihtml5-editor').html(result[0]['information']);

                //xu ly image
                if(result[0]['filename'] != null){
                    $("#image").attr("src", "/image_user/"+result[0]['filename']);
                    $("#filenameImage").val("/image_user/"+result[0]['filename']);
                }

                //xu ly permission user
                $('.permission option[value='+result[0]['user_permission_id']+']').attr('selected','selected');
            },
            error: function(result){
                console.log(result);
            }
        });
    }

    //Open modal change password
    function changePassword(user_id, email){
        $('#changeModalPassword').modal('show');
        $('#user_id_change_password').val(user_id);
        $('.nameUserPassword').html(email);
    }

    $('#changePasswordUser').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var $form = $(this);
        if(! $form.valid()) return false;
        $.ajax({
            type:'POST',
            url: '/manager/user/change-password',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data);
                $('#changeModalPassword').modal('hide');
                //message
                if(data == 'success')
                    toastr.success('Chỉnh sửa thành công');
                else
                    toastr.error('Chỉnh sửa không thành công');
            },
            error: function(data){
                console.log(data);
                toastr.error('Lỗi hệ thống khi lưu')
            }
        });
    }));

</script>
@endsection