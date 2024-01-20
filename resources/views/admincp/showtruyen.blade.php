@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thông tin truyện</div>
                <div class="row">
                    <style>
                        .card-title {text-align: center; margin-top: 15px;}
                        .image {width: 280px; height: 410px; margin-bottom: 10px; margin-left: 25px; margin-top: 10px;}
                        ul.button li {list-style: none; float: left}
                        ul.button li a{width: 70px; margin-bottom: 10px; margin-left: -32px;}
                        ul.button li button {width: 70px; margin-left: 30px;}
                        .form-control {resize: none;}
                        .vovan {height: 68px}
                    </style>
                    <h2 class="card-title"><b>{{$truyen->tentruyen}}</b></h2>
                    <div class="col-3">
                        <table class="table table-striped table-dark">
                            <tr><td><img class="image" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}"></td></tr>
                            <tr class="vovan"><td></td></tr>
                        </table>
                    </div>
                    <div class="col-9">
                        <table class="table table-striped table-dark">
                            <tr>
                                <td>Tác giả</td>
                                <td>{{ $truyen->tacgia }}</td>
                                <td>Slug truyện</td>
                                <td>{{ $truyen->slug_truyen }}</td>
                            </tr>
                            <tr>
                                <td>Tóm tắt</td>
                                <td><textarea name="tomtat" class="form-control" rows="5">{{$truyen->tomtat}}</textarea></td>
                                <td>Trạng thái</td>
                                <td>
                                    @if($truyen->trangthai==0)
                                        <span class="text text-success">Hoàn thành</span>
                                    @else
                                        <span class="text text-primary">Đang tiến hành</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Danh mục</td>
                                <td>
                                    <select style="background: #0099FF; color: #fff; width: 170px;" class="form-select" name="danhmuc" aria-label="Default select example">
                                        @foreach($danhmuc as $key => $muc)
                                        <option {{ $muc->id==$truyen->danhmuc_id ? 'selected' : ''}} value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>Ngày tạo</td>
                                <td>{{$truyen->created_at}} <p>{{$truyen->created_at->diffForHumans()}}</p></td>
                            </tr>
                            <tr>
                                <td>Thể loại</td>
                                <td>
                                    @foreach($truyen->thuocnhieutheloaitruyen as $key => $value)    
                                        <span class="badge text-bg-primary">{{ $value->tentheloai }}</span>
                                    @endforeach
                                </td>
                                <td>Ngày cập nhật</td>
                                <td>{{$truyen->updated_at}} <p>{{$truyen->updated_at->diffForHumans()}}</p></td>
                            </tr>
                            <tr>
                                <td>Banner</td>
                                <td>
                                    <select style="background: #0099FF; color: #fff; width: 170px;" class="form-select" name="banner" aria-label="Default select example">
                                        @foreach($banner as $key => $ban)
                                        <option {{ $ban->id==$truyen->banner_id ? 'selected' : ''}} value="{{$ban->id}}">{{$ban->tenbanner}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>Loại truyện</td>
                                <td>
                                    @if($truyen->truyen_noibat == 0)
                                        <form>
                                            @csrf
                                            <select style="width: 170px" name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="form-select truyennoibat">
                                                <option selected value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @elseif($truyen->truyen_noibat == 1)
                                        <form>
                                            @csrf
                                            <select style="width: 170px" name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="form-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option selected value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @else($truyen->truyen_noibat == 2)
                                        <form>
                                            @csrf
                                            <select style="width: 170px" name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="form-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option selected value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Lượt xem</td>
                                <td>{{ $truyen->views_truyen }}</td>
                                <td>Top View</td>
                                <td>
                                    @if($truyen->top_view == 0)
                                        <form>
                                            @csrf
                                            <select style="width: 170px" name="topview" data-truyen_id="{{$truyen->id}}" class="form-select topview">
                                                <option selected value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @elseif($truyen->top_view == 1)
                                        <form>
                                            @csrf
                                            <select style="width: 170px" name="topview" data-truyen_id="{{$truyen->id}}" class="form-select topview">
                                                <option value="0">Ngày</option>
                                                <option selected value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @else($truyen->top_view == 2)
                                        <form>
                                            @csrf
                                            <select style="width: 170px" name="topview" data-truyen_id="{{$truyen->id}}" class="form-select topview">
                                                <option value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option selected value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Số chapter</td>
                                <td>
                                    @php
                                        $mucluc = count($chapter);
                                    @endphp
                                    {{$mucluc}}
                                </td>
                                <td>Quản lý</td>
                                <td>
                                    <ul class="button">
                                        <li>
                                            <a href="{{route('truyen.edit',[$truyen->id])}}" class="btn btn-primary">Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{route('truyen.destroy',[$truyen->id])}}" method="post">
                                                @method ('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
