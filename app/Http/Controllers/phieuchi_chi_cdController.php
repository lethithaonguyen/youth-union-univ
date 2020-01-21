<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\chidoan;
use App\phieuchi_chi_cd;
use App\loai_noidung_chi;
use App\pt_chidoan;
use App\khoa;
use App\namhoc;
use App\hocky;
use App\v_nguoilap;
use Session;

use DB;

class phieuchi_chi_cdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('session_vt') == 3){
            $phieuchi_chi_cd = DB::table('phieuchi_chi_cd')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieuchi_chi_cd.DOANVIEN_THANHNIEN_ID_NHAN')
            ->join('v_nguoilap', 'v_nguoilap.ID', 'phieuchi_chi_cd.DOANVIEN_THANHNIEN_ID_TAO')
            ->join('chidoan', 'chidoan.ID', '=', 'phieuchi_chi_cd.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('pt_chidoan', 'pt_chidoan.ID', '=', 'phieuchi_chi_cd.PT_CHIDOAN_ID')
            ->join('loai_noidung_chi', 'loai_noidung_chi.ID', '=', 'phieuchi_chi_cd.LOAI_NOIDUNG_CHI_ID')
            ->where('chidoan.ID',$request->session()->get('session_id_chidoan_sv'))
            ->select('phieuchi_chi_cd.*', 'doanvien_thanhnien.TEN_SV', 'chidoan.TEN_CD','loai_noidung_chi.TEN_LOAI_DP','pt_chidoan.TEN_PT_CD', 'khoa.TEN_KHOA','v_nguoilap.TEN_LAP')
            ->get();
        }else{
            $phieuchi_chi_cd = DB::table('phieuchi_chi_cd')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieuchi_chi_cd.DOANVIEN_THANHNIEN_ID_NHAN')
            ->join('v_nguoilap', 'v_nguoilap.ID', 'phieuchi_chi_cd.DOANVIEN_THANHNIEN_ID_TAO')
            ->join('chidoan', 'chidoan.ID', '=', 'phieuchi_chi_cd.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('pt_chidoan', 'pt_chidoan.ID', '=', 'phieuchi_chi_cd.PT_CHIDOAN_ID')
            ->join('loai_noidung_chi', 'loai_noidung_chi.ID', '=', 'phieuchi_chi_cd.LOAI_NOIDUNG_CHI_ID')
            ->select('phieuchi_chi_cd.*', 'doanvien_thanhnien.TEN_SV', 'chidoan.TEN_CD','loai_noidung_chi.TEN_LOAI_DP','pt_chidoan.TEN_PT_CD', 'khoa.TEN_KHOA','v_nguoilap.TEN_LAP')
            ->get();
        }

        return view('backend.phieuchi_chi_cd.index')
        ->with('pc_cd', $phieuchi_chi_cd);

    }


    public function index_gethocky_pccd(){
        $namhoc = namhoc::all();
        return view('backend.phieuchi_chi_cd.index_gethocky_pccd')
        ->with('nh', $namhoc);
    }

    public function gethocky_pccd(Request $request){
        $namhoc = namhoc::find($request->namhoc);
        $hocky = hocky::where('NAMHOC_ID', $namhoc->ID)->get();
        return view('backend.phieuchi_chi_cd.index_getpt_pccd')
        ->with('hk', $hocky)
        ->with('nh', $namhoc);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpt_pccd(Request $request)
    {
        $doanvien_thanhnien_nhan = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('users.VAITRO_ID', '=', 3)
        ->where('CHIDOAN_ID', $request->session()->get('session_id_chidoan_sv'))
        ->get();
        $doanvien_thanhnien_tao = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('users.VAITRO_ID', '=', 3)
        ->where('CHIDOAN_ID', $request->session()->get('session_id_chidoan_sv'))
        ->get();
        $chidoan = DB::table('chidoan')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->where('chidoan.ID', $request->session()->get('session_id_chidoan_sv'))
        ->select('chidoan.*', 'khoa.TEN_KHOA')
        ->get();
        $pt_chidoan = pt_chidoan::all();
        $loai_noidung_chi = loai_noidung_chi::all();
        return view('backend.phieuchi_chi_cd.create')
        ->with ('dv_tn_nhan', $doanvien_thanhnien_nhan)
        ->with ('dv_tn_tao', $doanvien_thanhnien_tao)
        ->with ('lndc', $loai_noidung_chi)
        ->with ('pt_cd', $pt_chidoan)
        ->with ('cd', $chidoan);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $phieuchi_chi_cd = phieuchi_chi_cd::where('CHIDOAN_ID', $request->tenchidoan)
        ->where('DOANVIEN_THANHNIEN_ID_NHAN', $request->tendoanvien_thanhnien_nhan)
        ->where('DOANVIEN_THANHNIEN_ID_TAO', $request->tendoanvien_thanhnien_tao)
        ->where('LOAI_NOIDUNG_CHI_ID', $request->tenloai_noidung_chi)
        ->where('PT_CHIDOAN_ID', $request->tenpt_chidoan)
        ->first();
        if(!$phieuchi_chi_cd)
        {
            $phieuchi_chi_cd = new phieuchi_chi_cd();
            // $phieuchi_chi_cd->DUYET_PCCD = $request->tenduyet;
            $phieuchi_chi_cd->DOANVIEN_THANHNIEN_ID_NHAN = $request->tendoanvien_thanhnien_nhan;
            $phieuchi_chi_cd->DOANVIEN_THANHNIEN_ID_TAO = $request->tendoanvien_thanhnien_tao;
            $phieuchi_chi_cd->CHIDOAN_ID = $request->tenchidoan;
            $phieuchi_chi_cd->LOAI_NOIDUNG_CHI_ID = $request->tenloai_noidung_chi;
            $phieuchi_chi_cd->PT_CHIDOAN_ID = $request->tenpt_chidoan;
            $phieuchi_chi_cd->NOIDUNG_PC_CD = $request->tennoidung;
            $phieuchi_chi_cd->SOTIEN_CHI_CD = $request->tensotien;
            $phieuchi_chi_cd->NGAY_CHI_CD = $request->tenngay;
            $phieuchi_chi_cd->TAOMOI    = now();
            $phieuchi_chi_cd->CAPNHAT   = null;
            $phieuchi_chi_cd->save();
            return redirect(route('phieuchi_chi_cd.index'))
            ->with('success_message', 'Lưu thành công ^^');

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
        $phieuchi_chi_cd = phieuchi_chi_cd::find($id);
        $doanvien_thanhnien_nhan = doanvien_thanhnien::all();
        $doanvien_thanhnien_tao = doanvien_thanhnien::all();
        $chidoan = DB::table('chidoan')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->select('chidoan.*', 'khoa.TEN_KHOA')
        ->get();
        $pt_chidoan = pt_chidoan::all();
        $loai_noidung_chi = loai_noidung_chi::all();
        return view('backend.phieuchi_chi_cd.edit')
        ->with('phieuchi_chi_cd', $phieuchi_chi_cd)
        ->with ('dv_tn_nhan', $doanvien_thanhnien_nhan)
        ->with ('dv_tn_tao', $doanvien_thanhnien_tao)
        ->with ('pt_cd', $pt_chidoan)
        ->with ('lndc', $loai_noidung_chi)
        ->with ('cd', $chidoan);
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
       $phieuchi_chi_cd = phieuchi_chi_cd::find($id);
       $phieuchi_chi_cd1 = phieuchi_chi_cd::where('CHIDOAN_ID', $request->tenchidoan)
       ->where('DOANVIEN_THANHNIEN_ID_NHAN', $request->tendoanvien_thanhnien_nhan)
       ->where('DOANVIEN_THANHNIEN_ID_TAO', $request->tendoanvien_thanhnien_tao)
       ->where('LOAI_NOIDUNG_CHI_ID', $request->tenloai_noidung_chi)
       ->where('PT_CHIDOAN_ID', $request->tenpt_chidoan)
       ->where('NOIDUNG_PC_CD', $request->tennoidung)
       ->where('SOTIEN_CHI_CD', $request->tensotien)
       ->where('NGAY_CHI_CD', $request->tenngay)
       ->first();
       if(!$phieuchi_chi_cd1)
       {
        // $phieuchi_chi_cd->DUYET_PCCD = $request->tenduyet;
        $phieuchi_chi_cd->DOANVIEN_THANHNIEN_ID_NHAN = $request->tendoanvien_thanhnien_nhan;
        $phieuchi_chi_cd->DOANVIEN_THANHNIEN_ID_TAO = $request->tendoanvien_thanhnien_tao;
        $phieuchi_chi_cd->CHIDOAN_ID = $request->tenchidoan;
        $phieuchi_chi_cd->LOAI_NOIDUNG_CHI_ID = $request->tenloai_noidung_chi;
        $phieuchi_chi_cd->PT_CHIDOAN_ID = $request->tenpt_chidoan;
        $phieuchi_chi_cd->NOIDUNG_PC_CD = $request->tennoidung;
        $phieuchi_chi_cd->SOTIEN_CHI_CD = $request->tensotien;
        $phieuchi_chi_cd->NGAY_CHI_CD = $request->tenngay;
        $phieuchi_chi_cd->CAPNHAT    = now();
        $phieuchi_chi_cd->save();
        return redirect(route('phieuchi_chi_cd.index'))
        ->with('success_message', 'Lưu thành công ^^');
    }
    else
    {
       return redirect()->back()
       ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
   }
}


public function huyduyet(Request $request){
    $phieuchi_chi_cd = phieuchi_chi_cd::findOrFail($request->id);
        // dd($k, $k1);
    $phieuchi_chi_cd->DUYET_PCCD = '1';
    $phieuchi_chi_cd->save();

    Session::flash('capquyensuccess', 'This is a message!');
    return redirect(route('backend.phieuchi_chi_cd.index'));

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $phieuchi_chi_cd = phieuchi_chi_cd::findOrFail($request->id);
        $phieuchi_chi_cd->delete();
        Session::flash('deletesuccess', 'This is a message!');
        return redirect(route('phieuchi_chi_cd.index'));
    }

}
