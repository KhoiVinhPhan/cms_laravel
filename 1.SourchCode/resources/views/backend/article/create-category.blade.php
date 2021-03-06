@extends('layouts.backend.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thêm mới danh mục bài viết</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('indexBackend')}}">Trang chủ</a></li>
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

<form action="{{ route('storeCategory') }}" method="POST" accept-charset="utf-8" id="formCategoryCreate" enctype="multipart/form-data">
@csrf
<div class="container-fluid">
    <div class="col-sm-12">
    	<div class="card card-success">
    		<div class="card-header">
    			<h3 class="card-title">Thêm mới</h3>
    		</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-6">
    					<div class="form-group">
                            <label>Danh mục cha:</label>
                            <select class="form-control" name="category_parrent" style="width: 100%;">
                                <option value="0">Không có danh mục</option>
                                <?php
                                    menuParent($categorys,0,0);
                                    function menuParent($data,$parent, $level){
                                        $stt = 0;
                                        foreach($data as $value){
                                            $stt++;
                                            if($value->parrent_id==$parent){ ?>
                                                <option value="{{ $value->category_article_id }}">{{str_repeat('----', $level).$value->name}}</option>
                                            <?php menuParent($data,$value->category_article_id, $level+1);
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên danh mục:</label><span style="color:red"> *</span>
                            <input type="text" name="category" id="category" class="form-control" value="">
                        </div>
                        
    				</div>
    				<div class="col-sm-6">
    					<div class="form-group">
                            <label>Chi tiết:</label>
                            <textarea name="description" class="form-control timymce" id="ckeditor"></textarea>
                        </div>
                        
    				</div>
    			</div>
    		</div>
    		<div class="card-footer">
    			<button type="submit" class="btn btn-success btn-flat">Thêm mới</button>
    			<a href="{{ route('categoryArticle') }}"><button type="button" class="btn btn-default btn-flat">Danh sách danh mục</button></a>
    		</div>
    	</div>
    </div>
</div>
</form>

@endsection