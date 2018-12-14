@extends('layouts.backend.app')
@section('content')
<!-- Start content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thêm mới bài viết</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bài viết</li>
                    <li class="breadcrumb-item active">Thêm mới bài viết</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End content-header -->
<form action="{{ route('storeArticle') }}" method="POST" accept-charset="utf-8" id="formArticleCreate" enctype="multipart/form-data">
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
                                        <input type="text" name="title" id="title" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả:</label>
                                        <textarea name="description" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết:</label>
                                        <textarea name="details" class="form-control timymce" id="ckeditor"></textarea>
                                    </div>

                                </div>

                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <select id="categorys" ondblclick="choiceCategory()" multiple class="form-control" style="width: 100%;">
                                               <?php
                                                    menuParent($categorys, 0, 0);
                                                    function menuParent($data, $parent, $level){
                                                        foreach($data as $value){
                                                            if($value->parrent_id==$parent){ ?>
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
                                            <input type="button" class="btn btn-outline-info btn-sm btn-block" value=">>">
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
                                    Thông tin thêm
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
                            <input type="submit" class="btn btn-success btn-flat btn-block btn-sm" value="Thêm mới">
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Trạng thái</h3>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" checked data-toggle="toggle" data-on="Công khai" data-off="Lưu nháp" data-onstyle="success" data-offstyle="default" data-size="small" name="status">
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục</h3>
                        </div>
                        <div class="card-body">
                            <select class="form-control select2" multiple="multiple" data-placeholder="Chọn danh mục" style="width: 100%;">
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện</h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ url('image_default/logo.png') }}" id="holder" style="width: 100%;height: auto">
                            <input hidden id="thumbnail" class="form-control" type="text" name="avatar">
                            <input type="button" id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-flat btn-sm btn-block" value="Chọn hình">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>
<script>
    //choice filemanger image
    $(document).ready(function(){
        $('#lfm').filemanager('image');
    });
</script>
<script src="{{ asset('js/category-article.js') }}"></script>
@endsection