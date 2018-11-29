@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản lý danh mục bài viết</h1>
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
        <a href="{{route('createCategory')}}"><button type="button" class="btn btn-success btn-flat btn-sm">Thêm mới</button></a>
        <a href=""><button type="button" class="btn btn-default btn-flat btn-sm">Thùng rác</button></a>
    </div>
    
</div>

<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <button type="button" class="btn btn-danger btn-flat btn-sm" id="btnDeleteUser">Xóa nhiều</button>
                
                <!-- search -->
               <!--  <div class="card-tools">
                    <form action="" method="GET" accept-charset="utf-8" id="searchUser" enctype="multipart/form-data">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="searchUser" class="form-control float-right" placeholder="Tìm theo tên danh mục" value="@if(isset($searchUser)) {{$searchUser}} @endif">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all"></th>
                            <th>Tên danh mục bài viết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" id="" method="POST" accept-charset="utf-8">
                        <?php
                            menuParent($categorys, 0, 0);
                            function menuParent($data, $parent, $level){
                                foreach($data as $value){
                                    if($value->parrent_id==$parent){ ?>
                                        <tr>
                                            <td width="5%"><input type="checkbox" value="{{ $value->category_article_id }}" name="category_id[]"></td>
                                            <th><a href="{{route('editCategory', ['id'=>$value->category_article_id])}}">{{str_repeat('----', $level).$value->name}}</a></th>
                                        </tr> 
                                    <?php menuParent($data,$value->category_article_id, $level+1);
                                    }
                                }
                            }
                        ?>
                        </form>
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
<script>
</script>
@endsection