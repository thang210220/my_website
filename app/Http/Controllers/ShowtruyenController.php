<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DanhmucTruyen;
use App\Models\Banner;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\Chapter;
use App\Models\Gallery;
use App\Models\ThuocLoai;
use Storage;


class ShowtruyenController extends Controller
{
    public function showtruyen($slug){
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $banner = Banner::orderBy('id','DESC')->get();
        $truyen = Truyen::with('thuocnhieutheloaitruyen')->where('slug_truyen',$slug)->first();
        $chapter = Chapter::with('truyen')->where('truyen_id',$truyen->id)->get();

        return view('admincp.showtruyen')->with(compact('danhmuc','theloai','banner','truyen','chapter'));
    }
}
