@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tài khoản đang khóa</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Người dùng</li>
                    <li class="breadcrumb-item active">Tài khoản đang khóa</li>
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
        <a href="{{route('indexUsers')}}"><button type="button" class="btn btn-default btn-flat btn-sm">Danh sách tài khoản</button></a>
    </div>
    
</div>

<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <button type="button" class="btn btn-info btn-flat btn-sm" id="btnRestoreUser">Khôi phục tài khoản</button>
                
                <!-- search -->
                <div class="card-tools">
                    <form action="{{ route('restoreUser') }}" method="GET" accept-charset="utf-8" id="searchUser" enctype="multipart/form-data">
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
                            <th>Ngày khóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{route('restoreUsers')}}" id="formRestoreUser" method="POST" accept-charset="utf-8">
                        @csrf
                            @php($stt=0)
                            @foreach($users as $item)
                            @php($stt = $stt+1)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{ $item->user_id }}" name="user_id[]">
                                    </td>
                                    <td>{{$stt}}</td>
                                    <td><img src="{{ asset('image_user') }}/<?php if(!empty($item->filename)){echo $item->filename;}else{echo "no_image_user.png";} ?>" width="70px" height="70px"></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->name_permission}}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->deleted_at)) }}</td>
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
<script>
    $(document).ready(function(){
        //check checkbox all
        $('#check_all').change(function() {
            var checkboxes = $(this).closest('table').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        });

        //restore user
        $('#btnRestoreUser').click(function(){
            $('#formRestoreUser').submit();
        });
    });
</script>               
@endsection