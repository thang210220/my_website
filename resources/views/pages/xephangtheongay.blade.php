@extends('../layout')

@section('content')

<br>
<style>
    .bg_left {border-right:15px solid #F8F8FF; background: white;}
    .bg_right {background: white;}
    .detail {border-top:5px solid #32CD32; margin-top: 0px;}   
    .bread-crumb {border-top:5px solid #32CD32; background: white;}
    .button a{margin-bottom: 20px; margin-left: 2px; margin-top: 20px}  
    .item img:hover {border: 10px solid rgba(0,0,0,0.0);}
    .item a{text-decoration: none;}
    .item a:hover {color: green;}
    .card-img-truyen {width: 120px; height: 180px; margin-left: -13px;}
    .key{text-align: center; margin-top: 70px;}
    .text-muted h6{text-align: center; margin-top: 70px;}
</style>

<div class="row">
    <div class="col-9 bg_left">
        <div class="row bread-crumb">
            <div class="col-12 button">
                <a href="{{url('xep-hang/')}}" class="btn btn-danger">Bảng xếp hạng</a>
                <a href="{{url('/day/')}}" class="btn btn-success">Ngày</a>
                <a href="{{url('/week/')}}" class="btn btn-success">Tuần</a>
                <a href="{{url('/month/')}}" class="btn btn-success">Tháng</a>
            </div>
        </div>
        <h3>Bảng xếp hạng ngày</h3><br>
        <div class="row xephang">
            @foreach ($day as $key => $value)
                <div class="row item">
                    <div class="col-1 key">
                        <h5><b>{{$key}}</b></h5>
                    </div>
                    <div class="col-2">
                        <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                            <img class="card-img-truyen" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}">
                        </a>
                    </div>
                    <div class="col-7">
                        <h5>
                            <i class="fa fa-plus"></i> Tên truyện:
                            <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">{{$value->tentruyen}}</a>
                        </h5>
                        <h5>
                            <i class="fa fa-rss"></i> Trạng thái: 
                            @if($value->trangthai==0)
                                <span class="text text-primary">Hoàn thành</span>
                            @else
                                <span class="text text-primary">Đang tiến hành</span>
                            @endif
                        </h5>
                        <h5>
                            <i class="fa fa-tags"></i> Thể loại:
                            @foreach($value->thuocnhieutheloaitruyen as $the)
                                <a href="{{url('the-loai/'.$the->slug_theloai)}}">  
                                    <button type="button" class="btn btn-outline-success"><b>{{$the->tentheloai}}</b></button>
                                </a>
                            @endforeach
                        </h5>
                    </div>
                    <div class="col-2">
                        <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                    </div>
                </div><br>
            @endforeach
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