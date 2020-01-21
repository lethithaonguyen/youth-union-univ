<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\phuong_xa;
use App\chidoan;
use App\tongiao;
use App\dantoc;
use App\quan_huyen;
use App\tinh_thanhpho;
use App\v_qq_ns;
use App\khoa;
use App\doankhoa;


use DB;

class doanvien_thanhnienController extends Controller
{

    public function index_get_quanhuyen(){
        $tinh_thanhpho = tinh_thanhpho::all();
        return view('backend.doanvien_thanhnien.index_get_quanhuyen')
        ->with('t_tp',$tinh_thanhpho);
    }

    public function get_quanhuyen(Request $request){
        $nq_tinh_thanhpho = tinh_thanhpho::find($request->nq_tp);
        // dd($nq_tinh_thanhpho);(lay dc)
        $ns_tinh_thanhpho = tinh_thanhpho::find($request->ns_tp);
        // dd($ns_tinh_thanhpho);(lay dc)
        $nq_quanhuyen = quan_huyen::where('TINH_THANHPHO_ID',$nq_tinh_thanhpho->ID)->get();
        $ns_quanhuyen = quan_huyen::where('TINH_THANHPHO_ID',$ns_tinh_thanhpho->ID)->get();
        return view('backend.doanvien_thanhnien.index_get_phuongxa')
        ->with('nq_t_tp',$nq_tinh_thanhpho)
        ->with('ns_t_tp',$ns_tinh_thanhpho)
        ->with('nq_qh',$nq_quanhuyen)
        ->with('ns_qh',$ns_quanhuyen);
    }

    public function get_phuongxa(Request $request){
        $ns_quanhuyen = quan_huyen::find($request->ns_qh);
        // dd($ns_quanhuyen->ID);
        $nq_quanhuyen = quan_huyen::find($request->qq_qh);
        // dd($nq_quanhuyen->ID);
        $phuong_xa_qq = DB::table('phuong_xa')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->where('QUAN_HUYEN_ID', $nq_quanhuyen->ID)
        ->select('phuong_xa.*','quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')
        ->get();
        // dd($phuong_xa_qq);

        $phuong_xa_ns = DB::table('phuong_xa')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->where('QUAN_HUYEN_ID','=', $ns_quanhuyen->ID)
        ->select('phuong_xa.*','quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')
        ->get();
        // dd($phuong_xa_ns);
        $chidoan = chidoan::all();
        $tongiao = tongiao::all();
        $dantoc = dantoc::all();
        return view('backend.doanvien_thanhnien.create')
        ->with ('ns_qh', $ns_quanhuyen)
        ->with ('nq_qh', $nq_quanhuyen)        
        ->with ('pxqq', $phuong_xa_qq)
        ->with ('cd', $chidoan)
        ->with ('tg', $tongiao)
        ->with ('pxns', $phuong_xa_ns)
        ->with ('dt', $dantoc);
    }

    public function index_getchidoan(Request $request){
        $doankhoa = doankhoa::all();
        $khoa = khoa::all();
        return view('backend.doanvien_thanhnien.index_getchidoan')
        ->with('dk',$doankhoa)
        ->with('k', $khoa);

    }
    public function getchidoan(Request $request){
        $doankhoa = doankhoa::find($request->doankhoa);
        $khoa = khoa::find($request->khoa);
        $chidoan = chidoan::where('DOANKHOA_ID',$doankhoa->ID)
        ->where('KHOA_ID',$khoa->ID)
        ->get();
        return view('backend.doanvien_thanhnien.index_getdoanvien')
        ->with('dk',$doankhoa)
        ->with('k', $khoa)
        ->with('cd',$chidoan);
    }

    public function getdoanvien(Request $request){
        $chidoan = chidoan::find($request->chidoan);
        $doanvien_thanhnien = DB::table('doanvien_thanhnien')
        ->join('v_qq_ns', 'v_qq_ns.ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
        ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
        ->where('CHIDOAN_ID', '=', $chidoan->ID)
        ->select('doanvien_thanhnien.*','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT','v_qq_ns.*')
        ->get();
        return view('backend.doanvien_thanhnien.index')
        ->with('dvtn', $doanvien_thanhnien);
    }

    public function index_chidoan(Request $request)
    {
        $chidoan = $request->session()->get('session_id_chidoan_sv');
        $ten_chidoan = $request->session()->get('session_ten_chidoan');
        $doanvien_thanhnien = DB::table('doanvien_thanhnien')
        ->join('v_qq_ns', 'v_qq_ns.ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
        ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
        ->where('CHIDOAN_ID', '=', $chidoan)
        ->select('doanvien_thanhnien.*','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT','v_qq_ns.*')
        ->get();
        return view('backend.doanvien_thanhnien.index')
        ->with('cd', $chidoan)
        ->with('t_cd', $ten_chidoan)
        ->with('dvtn', $doanvien_thanhnien);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

        $doanvien_thanhnien = DB::table('doanvien_thanhnien')
        ->join('v_qq_ns', 'v_qq_ns.ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
        ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
        ->select('doanvien_thanhnien.*','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT','v_qq_ns.*')
        ->get();
        return view('backend.doanvien_thanhnien.index')
        ->with('dvtn', $doanvien_thanhnien);

//         create view v_ns as 
//         select doanvien_thanhnien.MSSV,  
//                 doanvien_thanhnien.TEN_SV, phuong_xa.TEN_PX as ns_phuong, 
//                 quan_huyen.TEN_QH as ns_quan, tinh_thanhpho.TEN_TP as ns_tp
//         from doanvien_thanhnien, phuong_xa, tinh_thanhpho, quan_huyen, chidoan, tongiao, dantoc
//         where  doanvien_thanhnien.PHUONG_XA_ID_NS = phuong_xa.ID
//             and doanvien_thanhnien.DANTOC_ID = dantoc.ID
//             and  doanvien_thanhnien.DANTOC_ID = tongiao.ID
//             and  doanvien_thanhnien.DANTOC_ID = chidoan.ID
//             and quan_huyen.ID = phuong_xa.QUAN_HUYEN_ID
//             and quan_huyen.TINH_THANHPHO_ID = tinh_thanhpho.ID


        // create view v_qq as 
        // select doanvien_thanhnien.ID,  
        // doanvien_thanhnien.TEN_SV, phuong_xa.TEN_PX as qq_phuong, 
        // quan_huyen.TEN_QH as qq_quan, tinh_thanhpho.TEN_TP as qq_tp
        // from doanvien_thanhnien, phuong_xa, tinh_thanhpho, quan_huyen
        // where doanvien_thanhnien.PHUONG_XA_ID_QQ = phuong_xa.ID
        // and quan_huyen.ID = phuong_xa.QUAN_HUYEN_ID
        // and quan_huyen.TINH_THANHPHO_ID = tinh_thanhpho.ID


        // create view v_ns as 
        // select doanvien_thanhnien.ID,  
        // doanvien_thanhnien.TEN_SV, phuong_xa.TEN_PX as ns_phuong, 
        // quan_huyen.TEN_QH as ns_quan, tinh_thanhpho.TEN_TP as ns_tp
        // from doanvien_thanhnien, phuong_xa, tinh_thanhpho, quan_huyen
        // where doanvien_thanhnien.PHUONG_XA_ID_NS = phuong_xa.ID
        // and quan_huyen.ID = phuong_xa.QUAN_HUYEN_ID
        // and quan_huyen.TINH_THANHPHO_ID = tinh_thanhpho.ID


        // create view v_qq_ns as
        // select a.*, b.ns_phuong, b.ns_quan, b.ns_tp
        // from v_qq a, v_ns b
        // where a.ID = b.ID;


    }



        // public function index_getchidoan(){
    //     $doankhoa = doankhoa::all();
    //     $khoa = khoa::all();
    //     return view('backend.phieudanhgia_doanvien.index_getchidoan')
    //     ->with('dk',$doankhoa)
    //     ->with('k', $khoa);
    // }

    // public function getchidoan(Request $request){
    //     $doankhoa = doankhoa::find($request->doankhoa);
    //     $khoa = khoa::find($request->khoa);
    //     $chidoan = chidoan::where('DOANKHOA_ID',$doankhoa->ID)
    //     ->where('KHOA_ID',$khoa->ID)
    //     ->get();
    //     return view('backend.phieudanhgia_doanvien.index_getdoanvien')
    //     ->with('dk',$doankhoa)
    //     ->with('k', $khoa)
    //     ->with('cd',$chidoan);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function thongke_quequan(){
        $results = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_QQ')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_QQ')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($thongke);

        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_quequan')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }

    public function thongke_quequan_dv(){
        $results = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_QQ')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_QQ')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($thongke);
        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_quequan_dv')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }
    public function thongke_noisinh(){
        $results = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_NS')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_NS')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($thongke);


        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_noisinh')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }

    public function thongke_noisinh_dv(){
        $results = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_NS')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('phuong_xa','phuong_xa.ID','=','doanvien_thanhnien.PHUONG_XA_ID_NS')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->select('tinh_thanhpho.TEN_TP as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tinh_thanhpho.TEN_TP')
        ->get();
        // dd($thongke);


        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_noisinh_dv')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }
    public function thongke_dantoc(){
        $results = DB::table('doanvien_thanhnien')
        ->join('dantoc','dantoc.ID','=','doanvien_thanhnien.DANTOC_ID')
        ->select('dantoc.TEN_DT as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('dantoc.TEN_DT')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('dantoc','dantoc.ID','=','doanvien_thanhnien.DANTOC_ID')
        ->select('dantoc.TEN_DT as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('dantoc.TEN_DT')
        ->get();
        // dd($thongke);


        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_dantoc')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }
    public function thongke_dantoc_dv(){
        $results = DB::table('doanvien_thanhnien')
        ->join('dantoc','dantoc.ID','=','doanvien_thanhnien.DANTOC_ID')
        ->select('dantoc.TEN_DT as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->groupBy('dantoc.TEN_DT')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('dantoc','dantoc.ID','=','doanvien_thanhnien.DANTOC_ID')
        ->select('dantoc.TEN_DT as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->groupBy('dantoc.TEN_DT')
        ->get();
        // dd($thongke);


        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_dantoc_dv')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }
    public function thongke_tongiao(){
        $results = DB::table('doanvien_thanhnien')
        ->join('tongiao','tongiao.ID','=','doanvien_thanhnien.TONGIAO_ID')
        ->select('tongiao.TEN_TG as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tongiao.TEN_TG')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('tongiao','tongiao.ID','=','doanvien_thanhnien.TONGIAO_ID')
        ->select('tongiao.TEN_TG as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('tongiao.TEN_TG')
        ->get();
        // dd($thongke);


        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_tongiao')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }
    public function thongke_tongiao_dv(){
        $results = DB::table('doanvien_thanhnien')
        ->join('tongiao','tongiao.ID','=','doanvien_thanhnien.TONGIAO_ID')
        ->select('tongiao.TEN_TG as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->groupBy('tongiao.TEN_TG')
        ->get();
        // dd($results);
        // $namhoc = namhoc::all();
        $thongke = DB::table('doanvien_thanhnien')
        ->join('tongiao','tongiao.ID','=','doanvien_thanhnien.TONGIAO_ID')
        ->select('tongiao.TEN_TG as title',DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->where('doanvien_thanhnien.NOIVAODOAN_SV','!=',null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',null)
        ->groupBy('tongiao.TEN_TG')
        ->get();
        // dd($thongke);


        $labels = $results->pluck('title');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.doanvien_thanhnien.thongke_tongiao_dv')
        // ->with('nh', $namhoc)
        ->with('labels', $labels)
        ->with('results', $results)
        ->with('t_k', $thongke)
        ->with('values', $values);
    }
    public function create()
    {
        $phuong_xa_qq = DB::table('phuong_xa')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('phuong_xa.*','quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')
        ->get();
        $phuong_xa_ns = DB::table('phuong_xa')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('phuong_xa.*','quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')
        ->get();
        $chidoan = chidoan::all();
        $tongiao = tongiao::all();
        $dantoc = dantoc::all();
        return view('backend.doanvien_thanhnien.create')
        ->with ('pxqq', $phuong_xa_qq)
        ->with ('cd', $chidoan)
        ->with ('tg', $tongiao)
        ->with ('pxns', $phuong_xa_ns)
        ->with ('dt', $dantoc);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doanvien_thanhnien = doanvien_thanhnien::where('TEN_SV', $request->tendoanvien_thanhnien)
        ->where('PHUONG_XA_ID_QQ', $request->tenphuong_xa_qq)
        ->where('CHIDOAN_ID', $request->tenchidoan)
        ->where('TONGIAO_ID', $request->tentongiao)
        ->where('PHUONG_XA_ID_NS', $request->tenphuong_xa_ns)
        ->where('DANTOC_ID', $request->tendantoc)
        ->first();

        $doanvien_thanhnien2 = doanvien_thanhnien::where('MSSV', $request->tenmssv)
        ->where('EMAIL_SV', $request->tenemail)
        ->where('SDT_SV',$request->tensdt)
        ->first();
        $doanvien_thanhnien3 = doanvien_thanhnien:: where('MSSV', $request->tenmssv)
        ->first();
        $doanvien_thanhnien4 = doanvien_thanhnien::where ('EMAIL_SV',$request->tenemail)
        ->first();
        $doanvien_thanhnien5 = doanvien_thanhnien::where ('SDT_SV',$request->tensdt)
        ->first();
        if(!$doanvien_thanhnien|| !$doanvien_thanhnien2|| !$doanvien_thanhnien3|| !$doanvien_thanhnien4|| !$doanvien_thanhnien5)
        {
            $doanvien_thanhnien = new doanvien_thanhnien();
            $doanvien_thanhnien->MSSV = $request->tenmssv;
            $doanvien_thanhnien->TEN_SV = $request->tendoanvien_thanhnien;
            $doanvien_thanhnien->PHUONG_XA_ID_QQ = $request->tenphuong_xa_qq;
            $doanvien_thanhnien->CHIDOAN_ID = $request->tenchidoan;
            $doanvien_thanhnien->TONGIAO_ID = $request->tentongiao;
            $doanvien_thanhnien->PHUONG_XA_ID_NS = $request->tenphuong_xa_ns;
            $doanvien_thanhnien->DANTOC_ID = $request->tendantoc;

            $doanvien_thanhnien->DIACHI_SV = $request->tendiachi;
            $doanvien_thanhnien->SDT_SV = $request->tensdt;
            $doanvien_thanhnien->NGAYSINH_SV = $request->tenngaysinh;
            $doanvien_thanhnien->PHAI_SV = $request->tenphai;
            $doanvien_thanhnien->EMAIL_SV = $request->tenemail;
            $doanvien_thanhnien->NGAYVAODOAN_SV = $request->tenngayvaodoan;
            $doanvien_thanhnien->NOIVAODOAN_SV = $request->tennoivaodoan;
            $doanvien_thanhnien->NGAYCHUYENSH_SV = $request->tenngaychuyensh;
            $doanvien_thanhnien->TAOMOI    = now();
            $doanvien_thanhnien->CAPNHAT   = null;
            $doanvien_thanhnien->save();
            return redirect(route('doanvien_thanhnien.index'))
            ->with('success_message', 'Lưu thành công ^^');
        }
        else
        {
         return redirect()->back()
         ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
     }

 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doanvien_thanhnien = doanvien_thanhnien::find($id);
        $phuong_xa_qq = DB::table('phuong_xa')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('phuong_xa.*','quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')
        ->get();
        $chidoan = chidoan::all();
        $tongiao = tongiao::all();
        $phuong_xa_ns = DB::table('phuong_xa')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('phuong_xa.*','quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')
        ->get();
        $dantoc = dantoc::all();
        return view('backend.doanvien_thanhnien.edit')
        ->with('doanvien_thanhnien', $doanvien_thanhnien)
        ->with ('pxqq', $phuong_xa_qq)
        ->with ('cd', $chidoan)
        ->with ('tg', $tongiao)
        ->with ('pxns', $phuong_xa_ns)
        ->with ('dt', $dantoc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doanvien_thanhnien = doanvien_thanhnien::find($id);
        // $doanvien_thanhnien1 = doanvien_thanhnien::where('TEN_SV', $request->tendoanvien_thanhnien)
        // ->where('PHUONG_XA_ID_QQ', $request->tenphuong_xa_qq)
        // ->where('CHIDOAN_ID', $request->tenchidoan)
        // ->where('TONGIAO_ID', $request->tentongiao)
        // ->where('PHUONG_XA_ID_NS', $request->tenphuong_xa_ns)
        // ->where('DANTOC_ID', $request->tendantoc)
        // ->first();
        // $doanvien_thanhnien2 = doanvien_thanhnien::where('MSSV', $request->tenmssv)
        // ->where('EMAIL_SV', $request->tenemail)
        // ->where('SDT_SV',$request->tensdt)
        // ->first();
        // $doanvien_thanhnien3 = doanvien_thanhnien:: where('MSSV', $request->tenmssv)
        // ->first();
        // $doanvien_thanhnien4 = doanvien_thanhnien::where ('EMAIL_SV',$request->tenemail)
        // ->first();
        // $doanvien_thanhnien5 = doanvien_thanhnien::where ('SDT_SV',$request->tensdt)
        // ->first();
        // $doanvien_thanhnien6 = doanvien_thanhnien::where 
        // if(!$doanvien_thanhnien3)
        // {
        $doanvien_thanhnien->MSSV = $request->tenmssv;
        $doanvien_thanhnien->TEN_SV = $request->tendoanvien_thanhnien;
        $doanvien_thanhnien->PHUONG_XA_ID_QQ = $request->tenphuong_xa_qq;
        $doanvien_thanhnien->CHIDOAN_ID = $request->tenchidoan;
        $doanvien_thanhnien->TONGIAO_ID = $request->tentongiao;
        $doanvien_thanhnien->PHUONG_XA_ID_NS = $request->tenphuong_xa_ns;
        $doanvien_thanhnien->DANTOC_ID = $request->tendantoc;

        $doanvien_thanhnien->DIACHI_SV = $request->tendiachi;
        $doanvien_thanhnien->SDT_SV = $request->tensdt;
        $doanvien_thanhnien->NGAYSINH_SV = $request->tenngaysinh;
        $doanvien_thanhnien->PHAI_SV = $request->tenphai;
        $doanvien_thanhnien->EMAIL_SV = $request->tenemail;
        $doanvien_thanhnien->NGAYVAODOAN_SV = $request->tenngayvaodoan;
        $doanvien_thanhnien->NOIVAODOAN_SV = $request->tennoivaodoan;
        $doanvien_thanhnien->NGAYCHUYENSH_SV = $request->tenngaychuyensh;
        $doanvien_thanhnien->CAPNHAT    = now();
        $doanvien_thanhnien->save();
        return redirect(route('doanvien_thanhnien.index'))
        ->with('success_message', 'Lưu thành công ^^');
        }
       //  else
       //  {
       //     return redirect()->back()
       //     ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
       // }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bulkDeleteDVTN(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $doanvien_thanhnien = doanvien_thanhnien::find($id);
                $doanvien_thanhnien->delete();
            } 
            return redirect()->back();
        }
        catch(QueryException $ex)
        {
            return response([
                'error' => true, 'message' => $ex->getMessage()
            ], 500);
        }
    }
}
