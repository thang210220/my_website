@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật Chapter</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('chapter.update',[$chapter->id])}}">
                        @method('PUT')
                        @csrf
                        <table class="table table-striped table-dark">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chapter</label>
                                        <input style="margin-top:10px" type="text" class="form-control" value="{{$chapter->chap}}" name="chap" id="chap" aria-describedby="emailHelp" placeholder="Chapter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên Chapter</label>
                                        <input style="margin-top:10px" type="text" class="form-control" value="{{$chapter->tieude}}" onkeyup="ChangeToSlug();" name="tieude" id="slug" aria-describedby="emailHelp" placeholder="Tiêu đề...">
                                    </div>
                                    <div class="form-group">
                                        <label style="margin-top:10px" for="exampleInputEmail1">Slug Chapter</label>
                                        <input style="margin-top:10px" type="text" class="form-control" value="{{$chapter->slug_chapter}}" name="slug_chapter" id="convert_slug" aria-describedby="emailHelp" placeholder="Tên slug ...">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label style="margin-top:10px" for="exampleInputEmail1">Nội dung</label>
                                        <textarea style="margin-top:10px; resize: none;" name="noidung" id="ckeditor" class="form-control" rows="5">{{$chapter->noidung}}</textarea>
                                    </div> -->
                                    <div class="form-group">
                                        <label style="margin-top:10px" for="exampleInputEmail1">Thuộc truyện</label>
                                        <select style="margin-top:10px; width:100%" name="truyen_id" class="form-select">
                                            @foreach($truyen as $key => $value)
                                            <option {{ $chapter->truyen_id==$value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->tentruyen}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        
                        <center><button style="margin-top:10px" type="submit" name="themdanhmuc" class="btn btn-primary">Cập nhật</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
