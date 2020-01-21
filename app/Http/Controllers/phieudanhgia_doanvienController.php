<?php

namespace App\Http\Controllers;
use App\phieudanhgia_doanvien;
use Illuminate\Http\Request;
use App\doankhoa;
use App\khoa;
use App\doanvien_thanhnien;
use App\chidoan;
use App\namhoc;
use App\mauphieu;
use App\xeploai_dv;
use App\chitiet_pdg_dv;

use DB;

class phieudanhgia_doanvienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //   $doanvien_thanhnien = doanvien_thanhnien::all();
    //   $doanvien_thanhnien = DB::table('doanvien_thanhnien')
    //   ->join('phuong_xa', 'phuong_xa.ID', '=', 'doanvien_thanhnien.PHUONG_XA_ID_QQ')
    //   ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
    //   ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
    //   ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    //   ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
    //   ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
    //   ->select('doanvien_thanhnien.*', 'phuong_xa.TEN_PX', 'quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT')
    //   ->get();
    //   return view('backend.phieudanhgia_doanvien.add_pdg_dv')
    //   ->with('cd', $chidoan)
    //   ->with('dvtn', $doanvien_thanhnien);

    // }

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

    // public function getdoanvien(Request $request){
    //     $chidoan = chidoan::find($request->chidoan);
    //     $mssv = doanvien_thanhnien::find($request->mssv);
    //     $doanvien_thanhnien = DB::table('doanvien_thanhnien')
    //     // ->join('chidoan', 'doanvien_thanhnien.CHIDOAN_ID', '=', 'chidoan.ID')
    //     ->where('doanvien_thanhnien.CHIDOAN_ID',$chidoan->ID)
    //     ->where('doanvien_thanhnien.MSSV', $request->mssv)
    //     ->select('doanvien_thanhnien.*')
    //     ->get();
    //     $request->session()->put('id_chidoan',$chidoan->ID);
    //     return view('backend.phieudanhgia_doanvien.add_pdg_dv')
    //     ->with('cd',$chidoan)
    //     ->with('dv_tn', $doanvien_thanhnien)
    //     ->with('cd',$chidoan);
    // }


    public function index_create_pdg_dv(Request $request)
    {

      $id_doanvien_thanhnien = $request->session()->get('session_id_sv');

// dd($request->session()->get('session_id_sv'));

      $doanvien_thanhnien = DB::table('doanvien_thanhnien')
      ->join('phuong_xa', 'phuong_xa.ID', '=', 'doanvien_thanhnien.PHUONG_XA_ID_QQ')
      ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
      ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
      ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
      ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
      ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
      ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
      ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
      ->where('doanvien_thanhnien.ID', '=', $id_doanvien_thanhnien)
      ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',null)
      ->select('doanvien_thanhnien.*', 'phuong_xa.TEN_PX', 'quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT', 'khoa.TEN_KHOA', 'doankhoa.TEN_DK')
      ->get();
        // dd($doanvien_thanhnien);
      return view('backend.phieudanhgia_doanvien.add_pdg_dv')
      ->with('i_dv_tn', $id_doanvien_thanhnien)
      ->with('dv_tn', $doanvien_thanhnien);

    }


    public function ds_pdg_dv(Request $request)
    {

      $id_doanvien_thanhnien = $request->session()->get('session_id_sv');

// dd($request->session()->get('session_id_sv'));

      $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
      ->join('mauphieu', 'phieudanhgia_doanvien.MAUPHIEU_ID', 'mauphieu.ID')
      ->join('namhoc', 'phieudanhgia_doanvien.NAMHOC_ID', 'namhoc.ID')
      ->join('xeploai_dv', 'phieudanhgia_doanvien.XEPLOAI_DV_ID', 'xeploai_dv.ID')
      ->where('DOANVIEN_THANHNIEN_ID','=', $id_doanvien_thanhnien)
      ->select('phieudanhgia_doanvien.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_dv.TEN_XLDV')
      ->get();
        // dd($doanvien_thanhnien);
      return view('backend.phieudanhgia_doanvien.ds_pdg_dv')
      ->with('i_dv_tn', $id_doanvien_thanhnien)
      ->with('pdg_dv', $phieudanhgia_doanvien);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
     $doanvien_thanhnien = doanvien_thanhnien::find($id);
       // dd($doanvien_thanhnien);
       // $xem_phieudanhgia_sinhvien
     // $request->session()->put('id_doanvien_thanhnien',$id);
     $namhoc = namhoc::all();
     $mauphieu = mauphieu::where('mauphieu.ID', '=', 1)->get();
     $xeploai_dv = xeploai_dv::all();
     // $phieudanhgia_doanvien = phieudanhgia_doanvien::where('DOANVIEN_THANHNIEN_ID',$id)->get();

     return view('backend.phieudanhgia_doanvien.create')
     ->with('nh', $namhoc)
     ->with('mp', $mauphieu)
     ->with('xl_dv', $xeploai_dv)
     ->with('dv_tn', $doanvien_thanhnien);
   }

    //  public function getphieudanhgia(Request $request, $id){
    //     $doanvien_thanhnien = doanvien_thanhnien::find($id);
    //     $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
    //     ->join('chidoan', 'doanvien_thanhnien.CHIDOAN_ID', '=', 'chidoan.ID')
    //     ->where('doanvien_thanhnien.CHIDOAN_ID',$chidoan->ID)
    //     ->select('doanvien_thanhnien.*', 'chidoan.*')
    //     ->get();
    //     return view('backend.phieudanhgia_doanvien.add_pdg_dv')
    //     ->with('cd',$chidoan)
    //     ->with('dv_tn', $doanvien_thanhnien)
    //     ->with('cd',$chidoan);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
     // $id_doanvien_thanhnien=$request->session()->get('id_doanvien_thanhnien');
     // dd($request->session()->get('id_doanvien_thanhnien'));
        // dd($id);

     $phieudanhgia_doanvien1 = phieudanhgia_doanvien::where('DOANVIEN_THANHNIEN_ID', '=' ,$id)->where('NAMHOC_ID','=',$request->namhoc)->first();
     // dd($phieudanhgia_doanvien1);
     if(!$phieudanhgia_doanvien1){
      $phieudanhgia_doanvien = new phieudanhgia_doanvien();
      $phieudanhgia_doanvien->DOANVIEN_THANHNIEN_ID = $id;
      $phieudanhgia_doanvien->MAUPHIEU_ID = $request->mauphieu;
      $phieudanhgia_doanvien->NAMHOC_ID = $request->namhoc;
      $phieudanhgia_doanvien->XEPLOAI_DV_ID = $request->xeploai_dv;
      $phieudanhgia_doanvien->TEN_PDGDV = $request->ten_pdgdv;
      $phieudanhgia_doanvien->DIEMTRUNGBINH_HK1 = $request->dtb1;
      $phieudanhgia_doanvien->DIEMTRUNGBINH_HK2 = $request->dtb2;
      $phieudanhgia_doanvien->DIEMRENLUYEN_HK1 = $request->drl1;
      $phieudanhgia_doanvien->DIEMRENLUYEN_HK2 = $request->drl2;
      $phieudanhgia_doanvien->TAOMOI    = now();
      $phieudanhgia_doanvien->CAPNHAT   = null;
      $phieudanhgia_doanvien->save();
      $id_new = $phieudanhgia_doanvien->ID;
      $id_doanvien_thanhnien = $phieudanhgia_doanvien->DOANVIEN_THANHNIEN_ID;
        // dd($id_doanvien_thanhnien);
      $request->Session()->put('new_p',$id_new);
      $request->Session()->put('id_doanvien_thanhnien',$id_doanvien_thanhnien);

      return redirect(route('danhgiadoanvien',$request->Session()->get('new_p')))

      ->with('success_message', 'Lưu thành công ^^');
    }
    else{
      return redirect()->back()
      ->with('error_message', 'Trung!!!');
    }


  }


  public function danhgia($id)
  {

    $phieudanhgia_doanvien = phieudanhgia_doanvien::find($id)
    ->join('doanvien_thanhnien','phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
    ->join('xeploai_dv', 'phieudanhgia_doanvien.XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
    ->join('mauphieu', 'phieudanhgia_doanvien.MAUPHIEU_ID', '=', 'mauphieu.ID')
    ->join('namhoc', 'phieudanhgia_doanvien.NAMHOC_ID', '=', 'namhoc.ID')
    ->select('phieudanhgia_doanvien.*','doanvien_thanhnien.TEN_SV', 'mauphieu.TEN_MP', 'xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
    ->orderBy('ID','desc')->first();
        // dd($phieudanhgia_doanvien);
    $chitiet_mauphieu = DB::table('chitiet_mauphieu')
    ->join('mauphieu', 'mauphieu.ID', '=', 'chitiet_mauphieu.MAUPHIEU_ID')
    ->join('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
    ->join('kieu_dulieu', 'kieu_dulieu.ID', '=', 'noidung_pdg.KIEU_DULIEU_ID')
    ->where('chitiet_mauphieu.MAUPHIEU_ID', '=', 1)
    ->select('chitiet_mauphieu.*','mauphieu.TEN_MP','noidung_pdg.TEN_NDPDG', 'noidung_pdg.NOIDUNG_PDG', 'kieu_dulieu.TEN_KIEU_DULIEU')
    ->orderBy('THUTU_NOIDUNG')
    ->get();
    // $chitiet_pdg_dv = chitiet_pdg_dv::all();
    return view('backend.phieudanhgia_doanvien.chitiet_pdg_dv')
    ->with('pdg_dv', $phieudanhgia_doanvien)
    ->with('ct_mp', $chitiet_mauphieu);
    // ->with('ct_pdg_dv', $chitiet_pdg_dv); 
  }


// public function luu_danhgia(Request $request, $id)
// {   

//     foreach ($chitiet_mauphieu as $ct_mp) {
//         $chitiet_pdg_dv = new chitiet_pdg_dv() ;
//         $chitiet_pdg_dv->PHIEUDANHGIA_DOANVIEN_ID = $id;
//         $chitiet_pdg_dv->NOIDUNG_PDG_ID = $ct_mp;
//         $chitiet_pdg_dv->DIEM_DUYET_PDGDV = null;
//         $chitiet_pdg_dv->DIEM_DV_TUDANHGIA = $request->tu_danhgia;
//         $chitiet_pdg_dv->GHICHU_PDGDV = $request->noidung;
//         $chitiet_pdg_dv->save();
//     }
//     return redirect()->back()
//     ->with('success_message', 'Lưu thành công ^^');

// }

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
    // public function edit($id)
    // {
    //     $doanvien_thanhnien = doanvien_thanhnien::find($id);
    //     $phuong_xa_qq = phuong_xa::all();
    //     $chidoan = chidoan::all();
    //     $tongiao = tongiao::all();
    //     $phuong_xa_ns = phuong_xa::all();
    //     $dantoc = dantoc::all();
    //     return view('backend.doanvien_thanhnien.edit')
    //     ->with('doanvien_thanhnien', $doanvien_thanhnien)
    //     ->with ('pxqq', $phuong_xa_qq)
    //     ->with ('cd', $chidoan)
    //     ->with ('tg', $tongiao)
    //     ->with ('pxns', $phuong_xa_ns)
    //     ->with ('dt', $dantoc);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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

    // public function bulkDeleteDVTN(Request $request)
    // {
    //     try {
    //         $all_data = $request->except('_token');
    //         foreach($all_data['id'] as $id) {

    //             $doanvien_thanhnien = doanvien_thanhnien::find($id);
    //             $doanvien_thanhnien->delete();
    //         } 
    //         return redirect()->back();
    //     }
    //     catch(QueryException $ex)
    //     {
    //         return response([
    //             'error' => true, 'message' => $ex->getMessage()
    //         ], 500);
    //     }
    // }




    public function thongke_xeploai_dv (){
      $nam_dp = namhoc::orderBy('ID','asc')->first();

      $results = DB::table('phieudanhgia_doanvien')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doanvien.NAMHOC_ID')
      ->join('xeploai_dv','xeploai_dv.ID','=','phieudanhgia_doanvien.CD_XEPLOAI_DV_ID')
      ->select('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doanvien.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CD_XEPLOAI_DV_ID','!=',null)
      ->groupBy('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
      ->get();  
        // dd($results);     
// dd($thongke);
      $namhoc = namhoc::all();

      $thongke = DB::table('phieudanhgia_doanvien')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doanvien.NAMHOC_ID')
      ->join('xeploai_dv','xeploai_dv.ID','=','phieudanhgia_doanvien.CD_XEPLOAI_DV_ID')
      ->select('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doanvien.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CD_XEPLOAI_DV_ID','!=',null)
      ->groupBy('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
      ->get();
        // dd($thongke);

      $labels = $results->pluck('TEN_XLDV');
      $values = $results->pluck('count');
        // $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
      return view('backend.phieudanhgia_doanvien.thongke_xeploai_dv')
      ->with('nh', $namhoc)
      ->with('n_dp', $nam_dp)
      ->with('labels', $labels)
      ->with('t_k',$thongke)
      ->with('results', $results)
      ->with('values', $values);
    }


    public function thongke_xeploai_theonam_dv (Request $request){
      $nam_dp = namhoc::find($request->namhoc);

      $namhoc = namhoc::all();
      $results = DB::table('phieudanhgia_doanvien')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doanvien.NAMHOC_ID')
      ->join('xeploai_dv','xeploai_dv.ID','=','phieudanhgia_doanvien.CD_XEPLOAI_DV_ID')
      ->select('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doanvien.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CD_XEPLOAI_DV_ID','!=',null)
      ->groupBy('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
      ->get();  
        // dd($results);     
// dd($thongke);
      $namhoc = namhoc::all();

      $thongke = DB::table('phieudanhgia_doanvien')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doanvien.NAMHOC_ID')
      ->join('xeploai_dv','xeploai_dv.ID','=','phieudanhgia_doanvien.CD_XEPLOAI_DV_ID')
      ->select('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doanvien.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CD_XEPLOAI_DV_ID','!=',null)
      ->groupBy('xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
      ->get();
        // dd($thongke);

      $labels = $results->pluck('TEN_XLDV');
      $values = $results->pluck('count');
// dd($values);
      return view('backend.phieudanhgia_doanvien.thongke_xeploai_dv')
      ->with('nh', $namhoc)
      ->with('n_dp', $nam_dp)
      ->with('labels', $labels)
      ->with('t_k', $thongke)
      ->with('results', $results)
      ->with('values', $values);
    }

  }
