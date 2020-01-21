<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\doankhoa;
use App\phieuchi_dk;
use App\loai_noidung_chi;
use App\pt_doankhoa;
use App\hocky;
use App\namhoc;
use App\v_nguoilap;
use Session;

use DB;

class phieuchi_dkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $namhoc = namhoc::all();
        $nam_dp = namhoc::orderBy('ID','asc')->first();
        $phieuchi_dk = DB::table('phieuchi_dk')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieuchi_dk.DOANVIEN_THANHNIEN_ID_NHAN')
        ->join('v_nguoilap', 'v_nguoilap.ID', 'phieuchi_dk.DOANVIEN_THANHNIEN_ID_TAO')
        ->join('doankhoa', 'doankhoa.ID', '=', 'phieuchi_dk.DOANKHOA_ID')
        ->join('pt_doankhoa', 'pt_doankhoa.ID', '=', 'phieuchi_dk.PT_DOANKHOA_ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->join('loai_noidung_chi', 'loai_noidung_chi.ID', '=', 'phieuchi_dk.LOAI_NOIDUNG_CHI_ID')


        ->where('phieuchi_dk.DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
        ->where('hocky.NAMHOC_ID', $nam_dp->ID)
        ->select('phieuchi_dk.*', 'doanvien_thanhnien.TEN_SV', 'doankhoa.TEN_DK','loai_noidung_chi.TEN_LOAI_DP','pt_doankhoa.TEN_PT_DK','v_nguoilap.TEN_LAP')
        ->get();
        $sotien = DB::table('phieuchi_dk')
        ->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
        ->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
        ->join('v_so_tien_phai_dong', 'v_so_tien_phai_dong.ID', 'phieuchi_dk.DOANKHOA_ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','doankhoa.TEN_DK',DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'), DB::raw('v_so_tien_phai_dong.so_tien_phai_dong - sum(phieuchi_dk.SOTIEN_CHI_DK) as tong_tien_quy_conlai'), DB::raw('v_so_tien_phai_dong.so_tien_phai_dong - sum(phieuchi_dk.SOTIEN_CHI_DK) as tong_tien_quy_conlai'), 'v_so_tien_phai_dong.so_tien_phai_dong as tong_quy_hienco')
        ->where('phieuchi_dk.DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH', 'so_tien_phai_dong')
        ->get();
        // dd($sotien);
        return view('backend.phieuchi_dk.index')
        ->with('pc_dk', $phieuchi_dk)
        ->with('st', $sotien)
        ->with('n_dp', $nam_dp)
        ->with('nh', $namhoc);

    }

    public function loc_phieuchi_dk(Request $request)
    {
        $namhoc = namhoc::all();
        $nam_dp = namhoc::find($request->namhoc);
        $phieuchi_dk = DB::table('phieuchi_dk')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieuchi_dk.DOANVIEN_THANHNIEN_ID_NHAN')
        ->join('v_nguoilap', 'v_nguoilap.ID', 'phieuchi_dk.DOANVIEN_THANHNIEN_ID_TAO')
        ->join('doankhoa', 'doankhoa.ID', '=', 'phieuchi_dk.DOANKHOA_ID')
        ->join('pt_doankhoa', 'pt_doankhoa.ID', '=', 'phieuchi_dk.PT_DOANKHOA_ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->join('loai_noidung_chi', 'loai_noidung_chi.ID', '=', 'phieuchi_dk.LOAI_NOIDUNG_CHI_ID')

        ->where('phieuchi_dk.DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
        ->where('hocky.NAMHOC_ID', $nam_dp->ID)
        ->select('phieuchi_dk.*', 'doanvien_thanhnien.TEN_SV', 'doankhoa.TEN_DK','loai_noidung_chi.TEN_LOAI_DP','pt_doankhoa.TEN_PT_DK','v_nguoilap.TEN_LAP')
        ->get();
        $sotien = DB::table('phieuchi_dk')
        ->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
        ->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
        ->join('v_so_tien_phai_dong', 'v_so_tien_phai_dong.ID', 'phieuchi_dk.DOANKHOA_ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','doankhoa.TEN_DK',DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'), DB::raw('v_so_tien_phai_dong.so_tien_phai_dong - sum(phieuchi_dk.SOTIEN_CHI_DK) as tong_tien_quy_conlai'), DB::raw('v_so_tien_phai_dong.so_tien_phai_dong - sum(phieuchi_dk.SOTIEN_CHI_DK) as tong_tien_quy_conlai'), 'v_so_tien_phai_dong.so_tien_phai_dong as tong_quy_hienco')
        ->where('phieuchi_dk.DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH', 'so_tien_phai_dong')
        ->get();
        // dd($sotien);
        return view('backend.phieuchi_dk.index')
        ->with('pc_dk', $phieuchi_dk)
        ->with('st', $sotien)
        ->with('n_dp', $nam_dp)
        ->with('nh', $namhoc);

    }


    public function index_gethocky_pcdk(){
        $namhoc = namhoc::all();
        return view('backend.phieuchi_dk.index_gethocky_pcdk')
        ->with('nh', $namhoc);
    }

    public function gethocky_pcdk(Request $request){
        $namhoc = namhoc::find($request->namhoc);
        $hocky = hocky::where('NAMHOC_ID', $namhoc->ID)->get();
        return view('backend.phieuchi_dk.index_getpt_pcdk')
        ->with('hk', $hocky)
        ->with('nh', $namhoc);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpt_pcdk(Request $request)
    {
        $hocky = hocky::find($request->hocky);
        $doanvien_thanhnien_nhan = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan','chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', 'chidoan.DOANKHOA_ID')
        ->where('chidoan.DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
        ->where('users.VAITRO_ID', '=', 2)
        ->get();
        $doanvien_thanhnien_tao = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan','chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', 'chidoan.DOANKHOA_ID')
        ->where('chidoan.DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
        ->where('users.VAITRO_ID', '=', 2)
        ->get();
        $doankhoa = doankhoa::where('ID', $request->session()->get('session_id_doankhoa'))->get();
        $pt_doankhoa = pt_doankhoa::where('DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
        ->where('HOCKY_ID', $hocky->ID)
        ->get();
        $loai_noidung_chi = loai_noidung_chi::all();
        return view('backend.phieuchi_dk.create')
        ->with ('dv_tn_nhan', $doanvien_thanhnien_nhan)
        ->with ('dv_tn_tao', $doanvien_thanhnien_tao)
        ->with ('lndc', $loai_noidung_chi)
        ->with ('pt_dk', $pt_doankhoa)
        ->with ('dk', $doankhoa);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $phieuchi_dk = phieuchi_dk::where('DOANKHOA_ID', $request->tendoankhoa)
        ->where('DOANVIEN_THANHNIEN_ID_NHAN', $request->tendoanvien_thanhnien_nhan)
        ->where('DOANVIEN_THANHNIEN_ID_TAO', $request->tendoanvien_thanhnien_tao)
        ->where('LOAI_NOIDUNG_CHI_ID', $request->tenloai_noidung_chi)
        ->where('PT_DOANKHOA_ID', $request->tenpt_doankhoa)
        ->first();
        if(!$phieuchi_dk)
        {
            $phieuchi_dk = new phieuchi_dk();
            // $phieuchi_dk->DUYET_PCDK = $request->tenduyet;
            $phieuchi_dk->DOANVIEN_THANHNIEN_ID_NHAN = $request->tendoanvien_thanhnien_nhan;
            $phieuchi_dk->DOANVIEN_THANHNIEN_ID_TAO = $request->tendoanvien_thanhnien_tao;
            $phieuchi_dk->DOANKHOA_ID = $request->tendoankhoa;
            $phieuchi_dk->LOAI_NOIDUNG_CHI_ID = $request->tenloai_noidung_chi;
            $phieuchi_dk->PT_DOANKHOA_ID = $request->tenpt_doankhoa;
            $phieuchi_dk->NOIDUNG_PC_DK = $request->tennoidung;
            $phieuchi_dk->SOTIEN_CHI_DK = $request->tensotien;
            $phieuchi_dk->NGAY_CHI_DK = $request->tenngay;
            $phieuchi_dk->TAOMOI    = now();
            $phieuchi_dk->CAPNHAT   = null;
            $phieuchi_dk->save();
            return redirect(route('phieuchi_dk.index'))
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
        $phieuchi_dk = phieuchi_dk::find($id);
        $doanvien_thanhnien_nhan = doanvien_thanhnien::all();
        $doanvien_thanhnien_tao = doanvien_thanhnien::all();
        $doankhoa = doankhoa::all();
        $pt_doankhoa = pt_doankhoa::all();
        $loai_noidung_chi = loai_noidung_chi::all();
        return view('backend.phieuchi_dk.edit')
        ->with('phieuchi_dk', $phieuchi_dk)
        ->with ('dv_tn_nhan', $doanvien_thanhnien_nhan)
        ->with ('dv_tn_tao', $doanvien_thanhnien_tao)
        ->with ('pt_dk', $pt_doankhoa)
        ->with ('lndc', $loai_noidung_chi)
        ->with ('dk', $doankhoa);
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
       $phieuchi_dk = phieuchi_dk::find($id);
       $phieuchi_dk1 = phieuchi_dk::where('DOANKHOA_ID', $request->tendoankhoa)
       ->where('DOANVIEN_THANHNIEN_ID_NHAN', $request->tendoanvien_thanhnien_nhan)
       ->where('DOANVIEN_THANHNIEN_ID_TAO', $request->tendoanvien_thanhnien_tao)
       ->where('LOAI_NOIDUNG_CHI_ID', $request->tenloai_noidung_chi)
       ->where('PT_DOANKHOA_ID', $request->tenpt_doankhoa)
       ->where('NOIDUNG_PC_DK', $request->tennoidung)
       ->where('SOTIEN_CHI_DK', $request->tensotien)
       ->where('NGAY_CHI_DK', $request->tenngay)
       ->first();
       if(!$phieuchi_dk1)
       {
        // $phieuchi_dk->DUYET_PCDK = $request->tenduyet;
        $phieuchi_dk->DOANVIEN_THANHNIEN_ID_NHAN = $request->tendoanvien_thanhnien_nhan;
        $phieuchi_dk->DOANVIEN_THANHNIEN_ID_TAO = $request->tendoanvien_thanhnien_tao;
        $phieuchi_dk->DOANKHOA_ID = $request->tendoankhoa;
        $phieuchi_dk->LOAI_NOIDUNG_CHI_ID = $request->tenloai_noidung_chi;
        $phieuchi_dk->PT_DOANKHOA_ID = $request->tenpt_doankhoa;
        $phieuchi_dk->NOIDUNG_PC_DK = $request->tennoidung;
        $phieuchi_dk->SOTIEN_CHI_DK = $request->tensotien;
        $phieuchi_dk->NGAY_CHI_DK = $request->tenngay;
        $phieuchi_dk->CAPNHAT    = now();
        $phieuchi_dk->save();
        return redirect(route('phieuchi_dk.index'))
        ->with('success_message', 'Lưu thành công ^^');
    }
    else
    {
       return redirect()->back()
       ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
   }
}


public function huyduyet(Request $request){
    $phieuchi_dk = phieuchi_dk::findOrFail($request->id);
        // dd($k, $k1);
    $phieuchi_dk->DUYET_PCDK = '1';
    $phieuchi_dk->save();

    Session::flash('capquyensuccess', 'This is a message!');
    return redirect(route('backend.phieuchi_dk.index'));

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $phieuchi_dk = phieuchi_dk::findOrFail($request->id);
        $phieuchi_dk->delete();
        Session::flash('deletesuccess', 'This is a message!');
        return redirect(route('phieuchi_dk.index'));
    }

}
