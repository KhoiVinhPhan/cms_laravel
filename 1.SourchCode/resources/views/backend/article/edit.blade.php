@extends('layouts.backend.app')
@section('content')
<!-- Start content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chỉnh sửa bài viết</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('indexBackend')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('indexArticle')}}">Bài viết</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa bài viết</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End content-header -->
<form action="" method="POST" accept-charset="utf-8" id="formArticleEdit" enctype="multipart/form-data">
    @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Chi tiết</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Danh mục</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Thông tin thêm</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group">
                                        <label>Tiêu đề:</label><span style="color:red"> *</span>
                                        <input type="text" name="title" id="title" class="form-control" value="{{$article->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả:</label>
                                        <textarea name="description" class="form-control" rows="3">{{$article->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết:</label>
                                        <textarea name="details" class="form-control timymce" id="ckeditor">{{$article->details}}</textarea>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <select id="categorys" ondblclick="insertCategoryArr()" multiple class="form-control" style="width: 100%;">
                                               <?php
                                                    menuParent($categorys, 0, 0);
                                                    function menuParent($data, $parent, $level){
                                                        foreach ($data as $value) {
                                                            if ($value->parrent_id==$parent) { ?>
                                                                <option value="{{$value->category_article_id}}">{{str_repeat('--', $level).$value->name}}</option>
                                                                <?php menuParent($data,$value->category_article_id, $level+1);
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <input onclick="insertCategoryArr()" type="button" class="btn btn-outline-info btn-sm btn-block" value=">">
                                            <input onclick="insertAllCategoryArr()" type="button" class="btn btn-outline-info btn-sm btn-block" value=">>">
                                        </div>
                                        <div class="col-sm-6">
                                            <table class="table" id="indexCategoryChoie">
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_3">
                                    <a href="{{route('editArticle', ['article_id'=>5])}}" title="">fsdsdfg</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Xử lý</h3>
                        </div>
                        <div class="card-body">
                            <input type="submit" class="btn btn-info btn-flat btn-block btn-sm" value="Chỉnh sửa">
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Trạng thái</h3>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" <?php if($article->status == 1){echo "checked";} ?> data-toggle="toggle" data-on="Công khai" data-off="Lưu nháp" data-onstyle="success" data-offstyle="default" data-size="small" name="status">
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện</h3>
                        </div>
                        <div class="card-body">
                            <img src="<?php if(!empty($article->avatar)){ echo $article->avatar; }else{ echo "/image_default/logo.png"; } ?>" id="holder" style="width: 100%;height: auto">
                            <input value="<?php if(!empty($article->avatar)){ echo $article->avatar; } ?>" hidden id="thumbnail" class="form-control" type="text" name="avatar">
                            <input type="button" id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-flat btn-sm btn-block" value="Chọn hình">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @if( !empty($article->categoryIdArr) )
        <div id="categoryIdArr">
            @foreach( $article->categoryIdArr as $key => $item )
                <input hidden type="text" value="{{$article->categoryIdArr[$key]}}">
            @endforeach
        </div>
    @endif
</form>
<script>
    //choice filemanger image
    $(document).ready(function(){
        $('#lfm').filemanager('image');
    });
</script>
<script src="{{ asset('js/category-article.js') }}"></script>
@endsection