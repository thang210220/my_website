@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($list_truyen);
                @endphp
                <style>
                    .form-control {width: 405px; margin-left: 324px}
                    .scroll-search2 {width: 492px; height: 400px; overflow-y: scroll;; margin-left: 324px}
                    ul.dropdown-menu li{padding: 5px 15px;}
                    ul.dropdown-menu li:hover { background: #FFCC66;}
                    ul.dropdown-menu li a:hover { color: green;}
                    ul.dropdown-menu li a{color: black; text-decoration: none}
                </style>
                <div class="card-header">
                    <form autocomplete="off" action="{{url('tim-kiem2')}}" class="form-inline my-2 my-lg-0" method="POST">
                        @csrf
                        <table>
                            <tr>
                                <td>Danh sách truyện: {{$count}}</td>
                                <td>
                                    <input class="form-control mr-sm-2" type="search" id="keywords2" name="tukhoa2" placeholder="Tìm kiếm" aria-label="Search">
                                </td>
                                <td>
                                    <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                                </td>
                            <tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div id="search_ajax2"></div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="row">
                    <style>
                        .title_truyen {margin-left: 10px}
                        .kytu {margin-left: 10px}
                        .kytu a {color: black; padding: 5px 13px; background: #FFCC66; cursor: pointer; font-weight: bold;}
                        .kytu a:hover {color: blue; margin-left: 10px}
                    </style>
                    <h3 class="title_truyen">Lọc A - Z</h3>
                    <table class="kytu">
                        <tr>
                        @foreach(range('A', 'Z') as $char)
                            <th><a href="{{url('/kytu/'.$char)}}">{{$char}}</a></th>
                        @endforeach
                        </tr>
                    </table>
                </div><br>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($list_truyen as $key => $truyen)
                    <div class="col-2">
                        <style>
                            .image_name {text-align: center;}
                            .image_name img:hover {border: 10px solid rgba(0,0,0,0.0);}
                            .card-body a{text-decoration: none; color: #fff}
                            .image_name a:hover {color: #3399FF;}
                            .card-body {width: 200px; height: 320px; margin-left: 10px; margin-bottom: 10px; background-color: #212529}
                            .image_name img{width: 180px; height: 220px; margin-left: -6px; margin-top: -5px;}
                            .image_name h5{margin-top: 20px;}
                            .button{text-align: center}
                        </style>
                        <div class="card-body">
                            <div class="row image_name">
                                <a href="{{url('show-truyen/'.$truyen->slug_truyen)}}">
                                    <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}">
                                    <h5>{{ $truyen->tentruyen }}</h5>
                                </a>
                            </div>
                        </div>
                        <div class="row button">
                            <div class="col-6">
                                <a href="{{route('truyen.edit',[$truyen->id])}}" class="btn btn-primary" style="width: 70px; margin-bottom: 10px;">Edit</a>
                            </div>
                            <div class="col-6">
                                <form action="{{route('truyen.destroy',[$truyen->id])}}" method="post">
                                    @method ('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 70px; margin-bottom: 10px;">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div><br>
<div class="row" style="margin-left: 1325px">
    {{ $list_truyen->links('pagination::bootstrap-4') }}
</div>

@endsection
