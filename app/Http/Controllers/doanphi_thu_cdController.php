<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\namhoc;
use App\thangnam;
use App\chidoan;
use App\khoa;
use App\doanphi_thu_cd;
use App\v_soluong_dv;
use App\v_tongchi_cd;
use App\hocky;
use App\phieuchi_chi_cd;
use App\pt_chidoan;
// use App\v_soluong_cd;
use Illuminate\Http\Request;
use DB;
use Exception;


class doanphi_thu_cdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $doanphi_thu_cd = doanphi_thu_cd::all();
    //     $namhoc_dp = namhoc::orderBy('ID','asc')->first();
    //     $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$namhoc_dp->ID)->first();
    //     $namhoc = namhoc::all();
    //     $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
    //     $chidoan = DB::table('chidoan')
    //     ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
    //     ->select('chidoan.*', 'khoa.TEN_KHOA')
    //     ->get();
    //     // $doanphi = doanphi_thu_cd::with('thangnam')->get();
    //     $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();
    //     // ->where('id','=',$thangnam_dp->id)
    //                 // ->where('namhoc_id','=',$nam_dp->id)
    //     // ->get();
    //     // $doanphi = DB::table('doanphi_thu_cd')
    //     // ->join('thangnam','doanphi_thu_cd.thangnam_id','=','thangnam.id')
    //     // ->where('thangnam.namhoc_id','=',$nam_dp->id)
    //     // ->get();
    //         // var_dump($dongdp);
    //     return view('backend.doanphi_thu_cd.index')
    //     ->with('dp_t_cd', $doanphi_thu_cd)
    //     ->with('nh_dp', $namhoc_dp)
    //     ->with('tn_dp', $thangnam_dp)
    //     ->with('nh', $namhoc)
    //     ->with('tn', $thangnam)
    //     ->with('cd', $chidoan)
    //     ->with('dp', $doanphi);
    // }

    //     public function index(Request $request)
    // {
    //     $dongdp = Dong_Doanphi::all();
    //     $namhoc = Namhoc::all();
    //     $thang = Thang::all();
    //     $nam_dp = Namhoc::orderBy('namhoc_id','aSC')->first();
    //     $doanphi = Doanphi::where('nam_id',$nam_dp->namhoc_id)->get();
    //     $doanvien = Doanvien::paginate(10);
    //     // var_dump($dongdp);
    //     return view('backend.dongdoanphi.index')
    //     ->with('ddp', $dongdp)
    //     ->with('nh', $namhoc)
    //     ->with('dp', $doanphi)
    //     ->with('t', $thang)
    //     ->with('dv', $doanvien)
    //     ->with('ndp', $nam_dp);
    // }
    public function index(Request $request)
    {
        $doankhoa = $request->session()->get('session_id_doankhoa');
        // dd($doankhoa);
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        $doanphi_thu_cd = doanphi_thu_cd::all();
        $namhoc_dp = namhoc::orderBy('ID','asc')->first();
        $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$namhoc_dp->ID)->first();
        $khoa_dp = khoa::orderBy('ID','asc')->first();
        $namhoc = namhoc::all();
        $khoa = khoa::all();
        $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
        $chidoan = DB::table('chidoan')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->where('chidoan.DOANKHOA_ID','=', $doankhoa )
        ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
        ->select('chidoan.*', 'khoa.TEN_KHOA')
        ->get();

        // $sl = v_soluong_dv::all();
        // dd($sl);
        // $doanphi = doanphi_thu_cd::with('thangnam')->get();
        $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();

        $tongtien = DB::table('chidoan')
        ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
        ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

        ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
        ->where('NAMHOC_ID', '=', $namhoc_dp->ID)
        ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
        ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
        ->get();
        return view('backend.doanphi_thu_cd.index')
        ->with('t_t', $tongtien)
        ->with('dp_t_cd', $doanphi_thu_cd)
        ->with('nh_dp', $namhoc_dp)
        ->with('k_dp', $khoa_dp)
        ->with('k', $khoa)
        ->with('tn_dp', $thangnam_dp)
        ->with('nh', $namhoc)
        ->with('tn', $thangnam)
        ->with('cd', $chidoan)
        ->with('dp', $doanphi);
    }


    public function getNam(Request $request)
    {
       $doankhoa = $request->session()->get('session_id_doankhoa');

       $namhoc_dp = namhoc::find($request->namhoc);
       $khoa_dp = khoa::find($request->khoa);
       $doanphi_thu_cd = doanphi_thu_cd::all();

       $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$request->namhoc)->first();
       $namhoc = namhoc::all();
       $khoa = khoa::all();
       $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
       $chidoan = DB::table('chidoan')
       ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
       ->where('chidoan.DOANKHOA_ID','=', $doankhoa )
       ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
       ->select('chidoan.*', 'khoa.TEN_KHOA')
       ->get();
        // $doanphi = doanphithu::with('thangnam')->get();
        // $doanphi = doanphithu::where('thangnam_id','=',$thangnam_dp->id)->get();
       $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();
       // $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();
       $tongtien = DB::table('chidoan')
       ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
       ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
       ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
       ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
       ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
       ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
       ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

       ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
       ->where('NAMHOC_ID', '=', $namhoc_dp->ID)
       ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
        ->where('chidoan.DUYET_CD', '=', null)
       ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
       ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
       ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
       ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
       ->get();
            // var_dump($dongdp);
       return view('backend.doanphi_thu_cd.index')
       ->with('t_t', $tongtien)
       ->with('nh_dp', $namhoc_dp)
       ->with('k_dp', $khoa_dp)
       ->with('dp_t_cd', $doanphi_thu_cd)
       ->with('tn_dp', $thangnam_dp)
       ->with('k', $khoa)
       ->with('nh', $namhoc)
       ->with('tn', $thangnam)
       ->with('cd', $chidoan)
       ->with('dp', $doanphi);
   }


   public function tong_tien_theonam_cd (Request $request){
    $nam_dp = namhoc::latest('ID')->first();
    $khoa_dp = khoa::orderBy('ID','asc')->first();
    $namhoc = namhoc::all();
    $khoa = khoa::all();
        // dd($results);

    $results = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();        
// dd($tongtien);


    $tongtien = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();

    $labels = $results->pluck('TEN_CD');
    $values = $results->pluck('so_tien_da_dong');
// dd($values);
    return view('backend.doanphi_thu_cd.tong_tien_theonam_cd')
    ->with('nh', $namhoc)
    ->with('n_dp', $nam_dp)
    ->with('k', $khoa)
    ->with('k_dp', $khoa_dp)
    ->with('labels', $labels)
    ->with('t_t',$tongtien)
    ->with('results', $results)
    ->with('values', $values);
}


public function tong_tien_loc_theonam_cd (Request $request){
    $nam_dp = namhoc::find($request->namhoc);
    $khoa_dp = khoa::find($request->khoa);
    $namhoc = namhoc::all();
    $khoa = khoa::all();
    $results = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();
        // dd($results);
    $tongtien = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)

    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();
        // dd($tongtien);


    $labels = $results->pluck('TEN_CD');
    $values = $results->pluck('so_tien_da_dong');
// dd($values);
    return view('backend.doanphi_thu_cd.tong_tien_theonam_cd')
    ->with('nh', $namhoc)
    ->with('n_dp', $nam_dp)
    ->with('k', $khoa)
    ->with('k_dp', $khoa_dp)
    ->with('labels', $labels)
    ->with('t_t', $tongtien)
    ->with('results', $results)
    ->with('values', $values);
}

public function bieudocotchong_cd (Request $request){
    $nam_dp = namhoc::latest('ID')->first();
    $khoa_dp = khoa::orderBy('ID','asc')->first();
    $namhoc = namhoc::all();
    $khoa = khoa::all();
        // dd($results);

    $results = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();        
// dd($tongtien);


    $tongtien = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();

    $labels = $results->pluck('TEN_CD');
    $values = $results->pluck('so_tien_da_dong');
    $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
    return view('backend.doanphi_thu_cd.bieudocotchong_cd')
    ->with('nh', $namhoc)
    ->with('n_dp', $nam_dp)
    ->with('k', $khoa)
    ->with('k_dp', $khoa_dp)
    ->with('labels', $labels)
    ->with('t_t',$tongtien)
    ->with('results', $results)
    ->with('values1', $values1)
    ->with('values', $values);
}


public function bieudocotchong_theonam_cd (Request $request){
    $nam_dp = namhoc::find($request->namhoc);
    $khoa_dp = khoa::find($request->khoa);
    $namhoc = namhoc::all();
    $khoa = khoa::all();
    $results = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();
        // dd($results);
    $tongtien = DB::table('chidoan')
    ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
    ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
    ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
    ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
    ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

    ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
    ->where('NAMHOC_ID', '=', $nam_dp->ID)
    ->where('KHOA_ID', '=', $khoa_dp->ID)
     ->where('chidoan.DUYET_CD', '=', null)
    ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
    ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
    ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
    ->get();
        // dd($tongtien);


    $labels = $results->pluck('TEN_CD');
    $values = $results->pluck('so_tien_da_dong');
    $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
    return view('backend.doanphi_thu_cd.bieudocotchong_cd')
    ->with('nh', $namhoc)
    ->with('n_dp', $nam_dp)
    ->with('k', $khoa)
    ->with('k_dp', $khoa_dp)
    ->with('labels', $labels)
    ->with('t_t', $tongtien)
    ->with('results', $results)
    ->with('values1', $values1)
    ->with('values', $values);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    //  $doanphithu = doanphithu::where('thangnam_id',$idtn)->get();
    //  foreach($doanphithu as $value){
    //     $value->delete();
    // }
        //$doanphithu = doanphithu::all();
        // $doanphithu = doanphithu::where('sinhvien_id','=',$doanphithu1->sinhvien_id)->where('thangnam_id','=',$doanphithu1->thangnam_id)->get();
       // $namhoc_dp = namhoc::find($request->namhoc);
       // $doanphi_thu_cd = DB::table('doanphi_thu_cd')
       // ->join('thangnam','doanphi_thu_cd.THANGNAM_ID','=','thangnam.ID')
       // ->where('thangnam.NAMHOC_ID','=',$namhoc_dp )
       // ->get();

        $doanphi_thu_cd = doanphi_thu_cd::where('namhoc_dp',$request->namhoc_dp)->get();
        foreach($doanphi_thu_cd as $value){
            $value->delete();
        }
        $doanphi =  $request->doanphi;
// dd($doanphi);
        if($doanphi != NULL){
            foreach($doanphi as $idcd => $value)
            {
               // dd($doanphi);
               // dd($idcd); 
                // dd($value);
                foreach($value as $idtn => $gt)
                {
                    // dd($value);
                    // dd($idtn);
                    // dd($gt); 
                    $data = new doanphi_thu_cd();
                    $data->CHIDOAN_ID = $idcd;
                    $data->THANGNAM_ID = $idtn;
                    $data->NGAY_DONG_CD = date("y-m-d");
                    $data->TAOMOI = NULL;
                    $data->CAPNHAT = now();
                    $data->DADONG = 1;
                    $data->namhoc_dp = $request->namhoc_dp;
                    $data->save();

                }

            }
        }

        session()->flash('flash_mesage','Cập nhật dữ liệu thành công');
        return redirect()->back();
    }

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



    public function thongke_thuchi_cd (Request $request){
        $nam_dp = namhoc::latest('ID')->first();
        $khoa_dp = khoa::orderBy('ID','asc')->first();
        $namhoc = namhoc::all();
        $khoa = khoa::all();
        $phieuchi_chi_cd = phieuchi_chi_cd::all();
        $hocky = hocky::all();
    // $v_tongchi_cd = v_tongchi_cd::all();
        $pt_chidoan = pt_chidoan::all();
        // dd($results);

        $results = DB::table('chidoan')
        ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
        ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

        ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        // ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
        ->get();  
    //dd($results); 
        $results1 = DB::table('phieuchi_chi_cd')
        ->join('chidoan','phieuchi_chi_cd.CHIDOAN_ID', '=','chidoan.ID')
        ->join('khoa','khoa.ID','=', 'chidoan.KHOA_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('pt_chidoan','phieuchi_chi_cd.PT_CHIDOAN_ID','=','pt_chidoan.ID')
        ->join('hocky','pt_chidoan.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','chidoan.TEN_CD', 'khoa.TEN_KHOA', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_chi_cd.SOTIEN_CHI_CD) as tongchi_chidoan'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA')
        ->get();

        $tongtien = DB::table('chidoan')
        ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
        ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

        ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
        ->get();
        $tongtien1 = DB::table('phieuchi_chi_cd')
        ->join('chidoan','phieuchi_chi_cd.CHIDOAN_ID', '=','chidoan.ID')
        ->join('khoa','khoa.ID','=', 'chidoan.KHOA_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('pt_chidoan','phieuchi_chi_cd.PT_CHIDOAN_ID','=','pt_chidoan.ID')
        ->join('hocky','pt_chidoan.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','chidoan.TEN_CD', 'khoa.TEN_KHOA', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_chi_cd.SOTIEN_CHI_CD) as tongchi_chidoan'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA')
        ->get();

        $labels = $results->pluck('TEN_CD');
        $values = $results->pluck('so_tien_da_dong');
        $labels1 = $results1->pluck('TEN_CD');
        $values1 = $results1->pluck('tongchi_chidoan');
// dd($values);
        return view('backend.phieuchi_chi_cd.thongke_thuchi_cd')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('k', $khoa)
        ->with('k_dp', $khoa_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('t_t1',$tongtien1)
        ->with('results', $results1)
        ->with('values', $values)
        ->with('labels1', $labels1)
        ->with('values1', $values1);
    }


    public function thongke_thuchi_theonam_cd (Request $request){
        $nam_dp = namhoc::find($request->namhoc);
        $khoa_dp = khoa::find($request->khoa);
        $namhoc = namhoc::all();
        $khoa = khoa::all();
        $phieuchi_chi_cd = phieuchi_chi_cd::all();
        $hocky = hocky::all();
    // $v_tongchi_cd = v_tongchi_cd::all();
        $pt_chidoan = pt_chidoan::all();
        // dd($results);

        $results = DB::table('chidoan')
        ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
        ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

        ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
        ->get();  
    //dd($results); 
        $results1 = DB::table('phieuchi_chi_cd')
        ->join('chidoan','phieuchi_chi_cd.CHIDOAN_ID', '=','chidoan.ID')
        ->join('khoa','khoa.ID','=', 'chidoan.KHOA_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('pt_chidoan','phieuchi_chi_cd.PT_CHIDOAN_ID','=','pt_chidoan.ID')
        ->join('hocky','pt_chidoan.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','chidoan.TEN_CD', 'khoa.TEN_KHOA', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_chi_cd.SOTIEN_CHI_CD) as tongchi_chidoan'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA')
        ->get();

        $tongtien = DB::table('chidoan')
        ->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_dv', 'v_soluong_dv.ID', '=', 'chidoan.ID')
        ->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

        ->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_dv.soluong_dv', DB::raw('((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_dv.soluong_dv' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_dv.soluong_dv')
        ->get();
        $tongtien1 = DB::table('phieuchi_chi_cd')
        ->join('chidoan','phieuchi_chi_cd.CHIDOAN_ID', '=','chidoan.ID')
        ->join('khoa','khoa.ID','=', 'chidoan.KHOA_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('pt_chidoan','phieuchi_chi_cd.PT_CHIDOAN_ID','=','pt_chidoan.ID')
        ->join('hocky','pt_chidoan.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','chidoan.TEN_CD', 'khoa.TEN_KHOA', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_chi_cd.SOTIEN_CHI_CD) as tongchi_chidoan'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.KHOA_ID', '=', $khoa_dp->ID)
         ->where('chidoan.DUYET_CD', '=', null)
        ->where('doankhoa.ID', '=', $request->session()->get('session_id_doankhoa'))
        ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA')
        ->get();

        $labels = $results->pluck('TEN_CD');
        $values = $results->pluck('so_tien_da_dong');
        $labels1 = $results1->pluck('TEN_CD');
        $values1 = $results1->pluck('tongchi_chidoan');
// dd($values);
        return view('backend.phieuchi_chi_cd.thongke_thuchi_cd')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('k', $khoa)
        ->with('k_dp', $khoa_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('t_t1',$tongtien1)
        ->with('results', $results1)
        ->with('values', $values)
        ->with('labels1', $labels1)
        ->with('values1', $values1);
    }


    
}
