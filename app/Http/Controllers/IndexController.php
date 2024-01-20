<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Banner;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\ThuocLoai;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Publisher;
use App\Models\Favorite;
use Carbon\Carbon;
use Session;
use Storage;

class IndexController extends Controller
{
    public function kytu(Request $request,$kytu){
        $list_truyen = Truyen::with('thuocnhieutheloaitruyen')->where('tentruyen','LIKE',$kytu.'%')->orderBy('updated_at','desc')->paginate(24);
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $kytu = $kytu;
        return view('pages.kytu')->with(compact('list_truyen','danhmuc','kytu')); 
    }
    public function kytu2(Request $request,$kytu2){
        $chapter = Chapter::where('tieude','LIKE',$kytu2.'%')->orderBy('id','DESC')->get();
        $kytu2 = $kytu2;
        return view('pages.kytu2')->with(compact('chapter','kytu2')); 
    }
    public function home(){
        //lấy thông tin danh mục, thể loai, truyện, banner, chapter
        $banner = Banner::orderBy('updated_at','DESC')->take(5)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('updated_at','DESC')->take(24)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        //lấy truyện cho slide
        $truyennoibat = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',1)->take(15)->get();
        
        return view('pages.home')->with(compact('banner','danhmuc','theloai','truyen','chapter','truyennoibat')); 
    }
    public function xemtatca(){
        //lấy thông tin danh mục, thể loai
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //lấy tất cả truyện
        $xemtatca = Truyen::orderBy('updated_at','DESC')->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        
        return view('pages.all')->with(compact('danhmuc','theloai','xemtatca','chapter'));
    }
    public function danhmuc($slug){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //1 danh mục
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        $tendanhmuc = $danhmuc_id->tendanhmuc;
        $truyen = Truyen::orderBy('updated_at','DESC')->where('danhmuc_id',$danhmuc_id->id)->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        return view('pages.danhmuc')->with(compact('theloai','danhmuc','danhmuc_id','tendanhmuc','truyen','chapter'));
    }
    public function theloai($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //Nhieu the loai
        $theloai_id = Theloai::where('slug_theloai',$slug)->first();
        $theloaitruyen = ThuocLoai::where('theloai_id',$theloai_id->id)->get();
        $nhieutheloai = [];
        foreach($theloaitruyen as $key => $the){
            $nhieutheloai[] = $the->truyen_id;
        }
        // dd($nhieutheloai);
        $tentheloai = $theloai_id->tentheloai;
        //phân trang
        $truyen = Truyen::whereIn('id',$nhieutheloai)->orderBy('id','DESC')->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
       
        return view('pages.theloai')->with(compact('theloai','danhmuc','theloai_id','tentheloai','truyen','chapter'));
    }
    public function xephang(){
        //lấy thông tin danh mục, thể loai
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //xếp hạng theo lượt view
        $truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('views_truyen','DESC')->take(10)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.xephang')->with(compact('danhmuc','theloai','truyen','chapter'));
    }
    public function day(){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $day = Truyen::orderBy('views_truyen','DESC')->where('top_view',0)->take(10)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.xephangtheongay')->with(compact('danhmuc','theloai','day','chapter'));
    }
    public function week(){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $week = Truyen::orderBy('views_truyen','DESC')->where('top_view',1)->take(10)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.xephangtheotuan')->with(compact('danhmuc','theloai','week','chapter'));
    }
    public function month(){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $month = Truyen::orderBy('views_truyen','DESC')->where('top_view',2)->take(10)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.xephangtheothang')->with(compact('danhmuc','theloai','month','chapter'));
    }
    public function trangthai(){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('updated_at','DESC')->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.trangthai')->with(compact('danhmuc','theloai','truyen','chapter'));
    }
    public function hoanthanh(){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $hoanthanh = Truyen::orderBy('updated_at','DESC')->where('trangthai',0)->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.hoanthanh')->with(compact('danhmuc','theloai','hoanthanh','chapter'));
    }
    public function dangtienhanh(){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $dangtienhanh = Truyen::orderBy('updated_at','DESC')->where('trangthai',1)->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        
        return view('pages.dangtienhanh')->with(compact('danhmuc','theloai','dangtienhanh','chapter'));
    }
    public function xemtruyen($slug){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::with('danhmuctruyen','theloai','thuocnhieutheloaitruyen')->where('slug_truyen',$slug)->first();
        //lượt xem
        $truyen = Truyen::where('id', $truyen->id)->first();
        $truyen->views_truyen = $truyen->views_truyen + 1;
        $truyen->save();
        //lấy sidebar truyện nổi bật và xem nhiều
        $truyennoibat = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',1)->take(5)->get();
        $truyenxemnhieu = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',2)->take(5)->get();
        //lấy nút đọc ngay và chương mới nhất
        $chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_moinhat = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();
        //cùng danh mục
        $cungdanhmuc = Truyen::with('danhmuctruyen','theloai')->orderBy('updated_at','DESC')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->take(4)->get();

        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','chapter_dau','theloai','truyennoibat','truyenxemnhieu','chapter_moinhat','cungdanhmuc'));
    }
    public function xemchapter($slug){
        //lấy thông tin danh mục, thể loai, truyện
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Chapter::where('slug_chapter',$slug)->first();
        //breadcrumb
        $truyen_breadcrumb = Truyen::with('danhmuctruyen','theloai')->where('id',$truyen->truyen_id)->first();
        //đựa trên truyện lấy ra chapter tương ứng
        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        //lượt xem
        $chapter = Chapter::where('id', $chapter->id)->first();
        $chapter->views_chapter = $chapter->views_chapter + 1;
        $chapter->save();
        //lấy ra tất cả chapter
        $all_chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->truyen_id)->get();
        //nút chuyển chap
        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');
        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        //lấy ra nội dung chapter
        $gallery = Gallery::where('chapter_id',$chapter->id)->get();

        return view('pages.chapter')->with(compact('danhmuc','chapter','all_chapter','theloai','truyen_breadcrumb','next_chapter','previous_chapter','max_id','min_id','gallery'));
    }
    public function timkiem(Request $request){
        $data = $request->all();
      
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $tukhoa = $data['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen','thuocnhieutheloaitruyen')->where('tentruyen','LIKE','%'.$tukhoa.'%')->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->paginate(24);
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.timkiem')->with(compact('danhmuc','truyen','theloai','tukhoa','chapter')); 
    }
    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['keywords']){
            $truyen = Truyen::where('tentruyen','LIKE','%'.$data['keywords'].'%')->get();
            $output = '
                <ul class="dropdown-menu scroll-search" style="display:block;">'
            ;
            foreach($truyen as $key => $tr){
                $output.= '
                    <li class="li_timkiem_ajax"><a href="'.url('xem-truyen/'.$tr->slug_truyen).'">
                        <table>
                            <tr>
                                <th>
                                    <img src="'.asset('public/uploads/truyen/'.$tr->hinhanh).'" alt="'.$tr->tentruyen.'">
                                </th>
                                <th class="text-color">
                                    <h5>'.$tr->tentruyen.'</h5>
                                </th>
                            </tr>
                        </table>
                    </a></li><hr>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function timkiem2(Request $request){
        $data = $request->all();
      
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $tukhoa2 = $data['tukhoa2'];
        $truyen = Truyen::with('danhmuctruyen','thuocnhieutheloaitruyen')->where('tentruyen','LIKE','%'.$tukhoa2.'%')->orWhere('tacgia','LIKE','%'.$tukhoa2.'%')->paginate(24);
        return view('admincp.timkiem')->with(compact('danhmuc','truyen','theloai','tukhoa2')); 
    }
    public function timkiem_ajax2(Request $request){
        $data = $request->all();
        if($data['keywords2']){
            $truyen = Truyen::where('tentruyen','LIKE','%'.$data['keywords2'].'%')->get();
            $output = '
                <ul class="scroll-search2 dropdown-menu" style="display:block;">'
            ;
            foreach($truyen as $key => $tr){
             $output.= '
                <li class="li_timkiem_ajax2"><a href="#">'.$tr->tentruyen.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    // login của admin
    public function login_admin(){
        return view('auth.login');
    }
    public function register_admin(){
        return view('auth.register');
    }
    //login của user
    public function dangnhap(){
        //lấy thông tin danh mục, thể loai
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.user.dangnhap')->with(compact('danhmuc','theloai','chapter'));
    }
    public function dangky(){
        //lấy thông tin danh mục, thể loai
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();

        return view('pages.user.dangky')->with(compact('danhmuc','theloai','chapter'));
    }
    public function login_publisher(Request $request){
        $data = $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Chưa nhập tên đăng nhập!',
                'password.required' => 'Chưa nhập mật khẩu!',
            ]
        );
        $publisher = Publisher::where('username',$data['username'])->where('password',md5($data['password']))->first();
        if($publisher){
            Session::put('login_publisher',true);
            Session::put('publisher_id',$publisher->id);
            Session::put('username',$publisher->username);
            Session::put('email_publisher',$publisher->email);
            
            //lấy thông tin danh mục, thể loai, truyện, banner, chapter
            $banner = Banner::orderBy('updated_at','DESC')->take(5)->get();
            $theloai = Theloai::orderBy('id','DESC')->get();
            $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
            $truyen = Truyen::orderBy('updated_at','DESC')->take(24)->get();
            $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
            //lấy truyện cho slide
            $truyennoibat = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',1)->take(15)->get();
            
            return view('pages.home')->with(compact('banner','danhmuc','theloai','truyen','chapter','truyennoibat')); 
        }else{
            return redirect()->back()->with('status','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function register_publisher(Request $request){
        $data = $request->validate(
            [
                'fullname' => 'required|max:150',
                'username' => 'required|unique:publishers|max:100',
                'email' => 'required|unique:publishers|max:100',
                'password' => 'required|required_with:password_confirmation|same:password|max:100',
            ],
            [
                'fullname.required' => 'Chưa nhập tên tài khoản!',
                'username.unique' => 'Tên đăng nhập đã có, điền tên khác!',
                'username.required' => 'Chưa nhập tên đăng nhập!',
                'email.unique' => 'Email đã có, điền tên khác!',
                'email.required' => 'Chưa nhập tên email!',
                'password.required' => 'Chưa nhập mật khẩu!',
            ]
        );
        // $data = $request->all();
        $publisher = new Publisher();
        $publisher->fullname = $data['fullname'];
        $publisher->username = $data['username'];
        $publisher->email = $data['email'];
        $publisher->password = md5($data['password']);
        $publisher->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $publisher->save();

        return redirect()->back()->with('status','Đăng ký thành công');
    }
    public function sign_out(){
        Session::forget('login_publisher');
        Session::forget('publisher_id');
        Session::forget('username');
        Session::forget('email_publisher');

        //lấy thông tin danh mục, thể loai, truyện, banner, chapter
        $banner = Banner::orderBy('updated_at','DESC')->take(5)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('updated_at','DESC')->take(24)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        //lấy truyện cho slide
        $truyennoibat = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',1)->take(15)->get();
        
        return view('pages.home')->with(compact('banner','danhmuc','theloai','truyen','chapter','truyennoibat')); 
    }
    public function yeu_thich(){
        //lấy thông tin danh mục, thể loai
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        $favorites = Favorite::with('publisher')->where('publisher_id',Session::get('publisher_id'))->orderBy('date_updated','DESC')->paginate(24);

        return view('pages.user.yeuthich')->with(compact('danhmuc','theloai','chapter','favorites'));
    }
    public function themyeuthich(Request $request) {
        $data = $request->all();
        $favo_check = Favorite::where('title',$data['title'])->where('publisher_id',$data['publisher_id'])->first();
        if ($favo_check){
            echo 'Fail';
        }else{
            $favo = new Favorite();
            $favo->title = $data['title'];
            $favo->image = $data['image'];
            $favo->status = 0;
            $favo->publisher_id = $data['publisher_id'];
            $favo->save();
            echo 'Done';
        }
    }
    public function xoayeuthich($id) {
        Favorite::find($id)->delete();
        return redirect()->back();
    }
}
