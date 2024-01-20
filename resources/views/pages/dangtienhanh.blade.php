@extends('../layout')

@section('content')

<br>
<style>
    .bg_left {border-right:15px solid #F8F8FF; background: white;}
    .bg_right {background: white;}
    .detail {border-top:5px solid #32CD32; margin-top: 0px;}   
    .bread-crumb {border-top:5px solid #32CD32; background: white;}
    .breadcrumb {background: white;}
    .breadcrumb a{text-decoration: none; color: #FF9900;}
    .breadcrumb a:hover {color: #007bff}
    .bread-crumb h3 {margin-left: 15px;}
    .trangthai {background: white; border-top:5px solid #32CD32; text-align: center;}
    .trangthai img{width: 170px; height: 250px; margin-left: -15px;}
    .trangthai img:hover {border: 10px solid #DCDCDC;}
    .trangthai a{text-decoration: none;}
    .trangthai a:hover {color: green;}
    .trangthai h3 {margin-left: 15px;}
    .btn {margin-left: 15px;}
</style>

<div class="row">
    <div class="col-9 bg_left">
        <div class="row bread-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/trang-thai')}}">Trạng thái</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Đang tiến hành</a></li>
                </ol>
                <h3>Manga đang tiến hành</h3><br>
                <a href="{{url('/hoanthanh/')}}" class="btn btn-danger">Hoàn thành</a>
                <a href="{{url('/dangtienhanh/')}}" class="btn btn-success">Đang tiến hành</a>
            </nav>
        </div>
        <br>
        <div class="row trangthai">
            @foreach ($dangtienhanh as $key => $value)
                <div class="col-3">
                    <div class="card-body">
                        <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                            <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" >
                            <br><br><h5><b>{{$value->tentruyen}}</b></h5>
                            <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                        </a>
                    </div>
                </div>
            @endforeach
        </div><br>
        <div class="row">
            {{ $dangtienhanh->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <div class="col-3 bg_right">
        <style>
            .fanpage {border-top:5px solid #32CD32; border-bottom: 15px solid #F8F8FF;}
            .fanpage iframe {width: 280px; height: 133px; border:none; overflow:hidden; margin-left: 2px;}
            .newupdated {border-top:5px solid #32CD32; border-bottom: 15px solid #F8F8FF;}
            .newupdated li{list-style: none; text-align: left; margin-left: -30px;}
            .newupdated li:hover{background: #FFCC66;}
            .newupdated a{text-decoration: none; color: blue;}
            .newupdated a:hover{color: green;}
        </style>
        <div class="row fanpage">
            <h3>Fanpage Mangapro</h3>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMangaprocom-101305011774420%2F&tabs=timeline&width=280&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            <p>Like hoặc chia sẻ page mangapro để theo dõi manga mới nhất.</p>
        </div>
        <div class="row newupdated">
            <h3>Chapter mới cập  nhật</h3>
            @foreach ($chapter as $key => $chap)
            <div class="col-12">
                <ul>
                    <a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">
                        <li>{{$chap->truyen->tentruyen}}  {{$chap->chap}}</li>
                    </a>
                </ul>
            </div>
            @endforeach
        </div>
        <div class="row xemnhieu">
            <h3>Truyện xem nhiều</h3>
            <style>
                .xemnhieu {border-top:5px solid #32CD32;}
                .xemnhieu img {width: 60px; height: 90px; padding: 5px 5px;}
                .xemnhieu img:hover {border: 5px solid rgba(0,0,0,0.0);}
                .xemnhieu a {text-decoration: none; font-weight: bold;}
                .xemnhieu a:hover {color: green;}
                .xemnhieu ul li {margin-left: 10px;}
            </style>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
                    <span id="show0"></span>
                </div>
                <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <span id="show1"></span>
                </div>
                <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <span id="show2"></span>
                </div>
            </div>
        </div>                 
    </div>
</div><br>

@endsection