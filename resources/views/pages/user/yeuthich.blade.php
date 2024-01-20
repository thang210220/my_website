@extends('../layout')

@section('content')

<br>
<style>
    .bg_left {border-right:15px solid #F8F8FF; background: white;}
    .bg_right {background: white;}
    .bread-crumb {border-top:5px solid #32CD32; background: white;}
    .breadcrumb {background: white;}
    .breadcrumb a{text-decoration: none; color: #FF9900;}
    .breadcrumb a:hover {color: #007bff}
    .bread-crumb h3 {margin-left: 10px;}
    .yeuthich {text-align: center;}
    .yeuthich img{width: 170px; height: 250px; margin-left: -15px;}
    .yeuthich img:hover {border: 10px solid rgba(0,0,0,0.0);}
    .yeuthich a{text-decoration: none;}
    .yeuthich a:hover {color: green;}
    .updating {background: white;}
    .xoayeuthich {border-radius: 10px; margin-top: -620px; margin-left: 90px;}
</style>

<div class="row">
    <div class="col-9 bg_left">
        <div class="row bread-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Yêu thích</a></li>
                </ol>
                <h3>Truyện yêu thích</h3>
            </nav>
        </div>
        <br>
        <div class="row yeuthich">
            @foreach ($favorites as $key => $favo)
            <div class="col-3">
                <div class="card-body">
                    <a href="#">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$favo->image)}}" >
                        <br><br><h5><b>{{$favo->title}}</b></h5>
                    </a>
                    <a href="{{route('xoayeuthich',[$favo->id])}}" class="btn btn-danger btn-small xoayeuthich">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div><br>
        <div class="row">
            {{ $favorites->links('pagination::bootstrap-4') }}
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