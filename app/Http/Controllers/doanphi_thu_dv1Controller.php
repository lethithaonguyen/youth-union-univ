<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\namhoc;
use App\thangnam;
use App\doanvien_thanhnien;
use App\doanphi_thu_dv;
use App\doankhoa;
use App\khoa;
use App\chidoan;
use Illuminate\Http\Request;
use DB;
use Exception;


class doanphi_thu_dv1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getNam(Request $request)
    {

        $namhoc_dp = namhoc::find($request->namhoc);
        $doanphi_thu_dv = doanphi_thu_dv::all();

        $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$request->namhoc)->first();
        $namhoc = namhoc::all();
        $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
        if($request->session()->has('session_id_chidoan_sv')){
            // $id_chidoan=$request->session()->get('id_chidoan');
            // dd($id_chidoan);
            $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID', $request->session()->get('session_id_chidoan_sv'))
            ->where('NGAYVAODOAN_SV', '!=', null)
            ->where('NGAYCHUYENSH_SV', '=', null)
            ->where('NGAYTTDOAN_SV', '=', null)
            ->orderBy('doanvien_thanhnien.ID', 'asc')
            ->get();

        }else
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();
        $tongtien = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'),'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $namhoc_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI','doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();
        // dd($tongtien);
        return view('backend.doanphi_thu_dv1.index')
        ->with('t_t',$tongtien)
        ->with('nh_dp',$namhoc_dp)
        ->with('dp_t_dv', $doanphi_thu_dv)
        ->with('tn_dp', $thangnam_dp)
        ->with('nh', $namhoc)
        ->with('tn', $thangnam)
        ->with('dv_tn', $doanvien_thanhnien)
        ->with('dp', $doanphi);
    }



    public function tong_tien_theonam_dv (Request $request){
        $nam_dp = namhoc::latest('ID')->first();

        // dd($results);

        $results = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI','doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();       
// dd($tongtien);
        $namhoc = namhoc::all();

        $tongtien = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI','doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();

        $labels = $results->pluck('TEN_SV');
        $values = $results->pluck('so_tien_da_dong');
// dd($values);
        return view('backend.doanphi_thu_dv1.tong_tien_theonam_dv')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('values', $values);
    }


    public function tong_tien_loc_theonam_dv (Request $request){
        $nam_dp = namhoc::find($request->namhoc);

        $namhoc = namhoc::all();
        $results = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI','doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();
        // dd($results);
        $tongtien = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI', 'doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();
        // dd($tongtien);


        $labels = $results->pluck('TEN_SV');
        $values = $results->pluck('so_tien_da_dong');
// dd($values);
        return view('backend.doanphi_thu_dv1.tong_tien_theonam_dv')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t', $tongtien)
        ->with('results', $results)
        ->with('values', $values);
    }

    public function bieudocotchong_dv (Request $request){
        $nam_dp = namhoc::latest('ID')->first();

        // dd($results);

        $results = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI', 'doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();       
// dd($tongtien);
        $namhoc = namhoc::all();

        $tongtien = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI', 'doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();

        $labels = $results->pluck('TEN_SV');
        $values = $results->pluck('so_tien_da_dong');
        $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
        return view('backend.doanphi_thu_dv1.bieudocotchong_dv')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('values1', $values1)
        ->with('values', $values);
    }


    public function bieudocotchong_theonam_dv (Request $request){
        $nam_dp = namhoc::find($request->namhoc);

        $namhoc = namhoc::all();
        $results = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI', 'doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();
        // dd($results);
        $tongtien = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('chidoan.ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI', 'doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();
        // dd($tongtien);
        $labels = $results->pluck('TEN_SV');
        $values = $results->pluck('so_tien_da_dong');
        $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
        return view('backend.doanphi_thu_dv1.bieudocotchong_dv')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t', $tongtien)
        ->with('results', $results)
        ->with('values1', $values1)
        ->with('values', $values);
    }


    public function getdoanvien(Request $request){
        // $chidoan = chidoan::find($request->chidoan);
        $chidoan = $request->session()->get('session_id_chidoan_sv');
        $ten_chidoan = $request->session()->get('session_ten_chidoan');

        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID',$chidoan)
        ->where('NGAYVAODOAN_SV', '!=', null)
        ->where('NGAYCHUYENSH_SV', '=', null)
        ->where('NGAYTTDOAN_SV', '=', null)
        ->get();
        // dd( $doanvien_thanhnien);
        $request->session()->put('id_chidoan',$chidoan);
        $doanphi_thu_dv = doanphi_thu_dv::all();
        $namhoc_dp = namhoc::orderBy('ID','asc')->first();
        $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$namhoc_dp->ID)->first();
        $namhoc = namhoc::all();
        $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
        $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();

        $tongtien = DB::table('doanphi_thu_dv')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'doanphi_thu_dv.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dv.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', DB::raw('SUM(thangnam.SOTIEN_DOANPHI) as so_tien_da_dong'), DB::raw('(thangnam.SOTIEN_DOANPHI)*12 as so_tien_phai_dong'), DB::raw('((thangnam.SOTIEN_DOANPHI)*12) - SUM(thangnam.SOTIEN_DOANPHI) as so_tien_chua_dong'), 'doanvien_thanhnien.MSSV' )
        ->where('chidoan.ID', '=', $chidoan)
        ->where('NAMHOC_ID', '=', $namhoc_dp->ID)
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '!=', null)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV', '=', null)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV', '=', null)
        ->groupBy('chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'namhoc.TEN_NH', 'thangnam.SOTIEN_DOANPHI', 'doanvien_thanhnien.MSSV')
        ->orderBy('doanvien_thanhnien.ID', 'asc')
        ->get();
        // dd($tongtien);
        return view('backend.doanphi_thu_dv1.index')
        ->with('t_t',$tongtien)
        ->with('cd',$chidoan)
        ->with('t_cd',$ten_chidoan)
        ->with('dv_tn',$doanvien_thanhnien)
        ->with('nh_dp',$namhoc_dp)
        ->with('dp_t_dv', $doanphi_thu_dv)
        ->with('tn_dp', $thangnam_dp)
        ->with('nh', $namhoc)
        ->with('tn', $thangnam)
        ->with('dp', $doanphi);
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


     $doanphi_thu_dv = doanphi_thu_dv::where('namhoc_dp',$request->namhoc_dp)
     ->get();
     foreach($doanphi_thu_dv as $value){
        $value->delete();
    }
    $doanphi =  $request->doanphi;

    if($doanphi != NULL){
        foreach($doanphi as $iddv => $value)
        {
            foreach($value as $idtn => $gt)
            {
                $data = new doanphi_thu_dv();
                $data->DOANVIEN_THANHNIEN_ID = $iddv;
                $data->THANGNAM_ID = $idtn;
                $data->NGAY_DONG_DP_DV = date("y-m-d");
                $data->CAPNHAT = now();
                $data->TAOMOI = null;
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
}
