@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm truyện</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('truyen.store')}}" enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <style>
                             .image {width: 280px; height: 410px; margin-bottom: 10px; margin-left: 25px; margin-top: 10px;}
                            .form-control {width: 500px;margin-top: 10px;}
                            .form-select {width: 500px; }
                            .form-group label{margin-top: 10px;}
                            .form-group textarea{margin-top: 10px; resize: none;}
                            .vovan1 {height: 160px}
                            .vovan2 {height: 95px}
                            .btn {width: 100px;}
                            .form-control-file {margin-left: 25px;}
                            .lb-image {margin-left: 25px;}
                        </style>
                        <div class="col-3">
                            <table class="table table-striped table-dark">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lb-image" for="exampleInputEmail1">Ảnh</label><br>
                                            <input type="file" class="form-control-file image" name="hinhanh">
                                        </div> 
                                    </td>
                                </tr>
                                <tr class="vovan1"><td></td></tr><tr><tr class="vovan2"><td></td></tr><tr>
                            </table>
                        </div>
                        <div class="col-9">
                            <table class="table table-striped table-dark">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên truyện</label>
                                            <input type="text" class="form-control" value="{{old('tentruyen')}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug" aria-describedby="emailHelp" placeholder="Tên truyện ...">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Slug truyện</label>
                                            <input type="text" class="form-control" value="{{old('slug_truyen')}}" name="slug_truyen" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug truyện ...">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tóm tắt truyện</label>
                                            <textarea name="tomtat" class="form-control" rows="5"></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tác giả</label>
                                            <input type="text" class="form-control" value="{{old('tacgia')}}" name="tacgia" aria-describedby="emailHelp" placeholder="Tác giả ...">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Danh mục truyện</label>
                                            <select class="form-select" name="danhmuc" aria-label="Default select example">
                                                @foreach($danhmuc as $key => $muc)
                                                <option value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Banner truyện</label><br>
                                            <select class="form-select" name="banner">
                                                @foreach($banner as $key => $ban)
                                                <option value="{{$ban->id}}">{{$ban->tenbanner}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Thể loại truyện</label><br>
                                            @foreach($theloai as $key => $the)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="theloai[]" id="theloai_{{$the->id}}" value="{{$the->id}}">
                                                <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Trạng thái</label><br>
                                            <select class="form-select" name="trangthai">
                                                <option value="0">Hoàn thành</option>
                                                <option value="1">Đang tiến hành</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Loại truyện</label><br>
                                            <select class="form-select" name="truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Top view</label><br>
                                            <select class="form-select" name="topview">
                                                <option value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <center><button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Danh mục truyện</label><br>
                            @foreach($danhmuc as $key => $muc)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="danhmuc[]" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                                <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{$muc->tendanhmuc}}</label>
                            </div>
                            @endforeach
                        </div> -->
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thể loại truyện</label>
                            <select class="form-select" name="theloai" aria-label="Default select example">
                                @foreach($theloai as $key => $the)
                                <option value="{{$the->id}}">{{$the->tentheloai}}</option>
                                @endforeach
                            </select>
                        </div> -->