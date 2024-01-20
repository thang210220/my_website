@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($chapter);
                @endphp
                <div class="card-header">Danh sách chapter: {{$count}}</div>
                <div class="row">
                    <style>
                        .title_truyen3 {margin-left: 10px}
                        .kytu3 {margin-left: 10px}
                        .kytu3 a {color: black; padding: 5px 13px; background: #FFCC66; cursor: pointer; font-weight: bold;}
                        .kytu3 a:hover {color: blue; margin-left: 10px}
                    </style>
                    <h3 class="title_truyen3">Lọc A - Z</h3>
                    <table class="kytu3">
                        <tr>
                        @foreach(range('A', 'Z') as $char)
                            <th><a href="{{url('/kytu3/'.$char)}}">{{$char}}</a></th>
                        @endforeach
                        </tr>
                    </table>
                </div><br>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-dark" id="myTable">
                        <thead>
                            <tr>
                                <th width="30px">#</th>
                                <th width="100px">Chapter</th>
                                <th width="300px">Tên Chapter</th>
                                <th width="300px">Thuộc truyện</th>
                                <th>Lượt xem</th>
                                <th width="100px">Slug Chapter</th>
                                <th width="200px">Ngày tạo</th>
                                <th width="200px">Ngày cập nhật</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapter as $key => $chap)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $chap->chap }}</td>
                                <td>{{ $chap->tieude }}</td>
                                <td>{{ $chap->truyen->tentruyen}}</td>
                                <td>{{ $chap->views_chapter }}</td>
                                <td>{{ $chap->slug_chapter }}</td>
                                <td>{{$chap->created_at}} <br><p>{{$chap->created_at->diffForHumans()}}</p></td>
                                <td>
                                    @if($chap->created_at!='')
                                    {{$chap->updated_at}} <br><p>{{$chap->updated_at->diffForHumans()}}</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('chapter.edit',[$chap->id])}}" class="btn btn-primary" style="width: 110px; margin-bottom: 10px;">Edit</a>
                                    <a href="{{url('/add-gallery/'.$chap->id)}}" class="btn btn-success" style="width: 110px; margin-bottom: 10px;">Chi tiết</a>
                                    <form action="{{route('chapter.destroy',[$chap->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 110px; margin-bottom: 10px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- <form autocomplete="off" action="{{url('tim-kiem3')}}" class="form-inline my-2 my-lg-0" style="margin-left: 180px" method="POST">
                        @csrf
                        <table>
                            <tr>
                                <td>
                                    <input class="form-control mr-sm-2" type="search" id="keywords3" name="tukhoa3" placeholder="Tìm kiếm" aria-label="Search" style="background: white">
                                    
                                </td>
                                <td>
                                    <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                                </td>
                            </tr>
                            <tr>
                                <style>
                                    .scroll-search3 {width: 405px; height: 400px; overflow-y: scroll;}
                                    ul.dropdown-menu li:hover { background: #FFCC66;}
                                    ul.dropdown-menu li a:hover { color: blue;}
                                </style>
                                <div id="search_ajax3"></div>
                            </tr>
                        </table>
                    </form> -->