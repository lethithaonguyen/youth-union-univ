<?php

namespace App\Http\Controllers;
use App\phieudanhgia_chidoan;
use Illuminate\Http\Request;
use App\doankhoa;
use App\khoa;
use App\doanvien_thanhnien;
use App\chidoan;
use App\namhoc;
use App\mauphieu;
use App\xeploai_cd;
use App\chitiet_pdg_cd;
use session;
use DB;

class phieudanhgia_chidoanController extends Controller
{


  public function index_create_pdg_cd(Request $request)
  {

    $id_chidoan = $request->session()->get('session_id_chidoan_sv');

// dd($request->session()->get('session_id_sv'));

    $chidoan = DB::table('chidoan')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')
    ->where('chidoan.ID', '=', $id_chidoan)
    ->select('chidoan.*','doankhoa.TEN_DK','khoa.TEN_KHOA')
    ->get();
        // dd($doanvien_thanhnien);
    return view('backend.phieudanhgia_chidoan.add_pdg_cd')
    ->with('i_cd', $id_chidoan)
    ->with('cd', $chidoan);

  }


  public function ds_pdg_cd(Request $request)
  {

   $id_chidoan = $request->session()->get('session_id_chidoan_sv');

// dd($request->session()->get('session_id_sv'));

   $phieudanhgia_chidoan = DB::table('phieudanhgia_chidoan')

   ->join('mauphieu', 'phieudanhgia_chidoan.MAUPHIEU_ID', 'mauphieu.ID')
   ->join('namhoc', 'phieudanhgia_chidoan.NAMHOC_ID', 'namhoc.ID')
   ->join('xeploai_cd', 'phieudanhgia_chidoan.XEPLOAI_CD_ID', 'xeploai_cd.ID')
   ->where('CHIDOAN_ID', '=', $id_chidoan)
   ->select('phieudanhgia_chidoan.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_cd.TEN_XLCD')
   ->get();
        // dd($chidoan_thanhnien);
   return view('backend.phieudanhgia_chidoan.ds_pdg_cd')
   ->with('i_cd', $id_chidoan)
   ->with('pdg_cd', $phieudanhgia_chidoan);

 }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $chidoan = chidoan::find($id);
       // dd($doanvien_thanhnien);
       // $xem_phieudanhgia_sinhvien
     // $request->session()->put('id_doanvien_thanhnien',$id);
      $namhoc = namhoc::all();
      $mauphieu = mauphieu::where('mauphieu.ID', '=', 2)->get();
      $xeploai_cd = xeploai_cd::all();
     // $phieudanhgia_doanvien = phieudanhgia_doanvien::where('DOANVIEN_THANHNIEN_ID',$id)->get();

      return view('backend.phieudanhgia_chidoan.create')
      ->with('nh', $namhoc)
      ->with('mp', $mauphieu)
      ->with('xl_cd', $xeploai_cd)
      ->with('cd', $chidoan);
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

     $phieudanhgia_chidoan1 = phieudanhgia_chidoan::where('CHIDOAN_ID', '=' ,$id)->where('NAMHOC_ID','=',$request->namhoc)->first();
     // dd($phieudanhgia_chidoan1);
     if(!$phieudanhgia_chidoan1){
      $phieudanhgia_chidoan = new phieudanhgia_chidoan();
      $phieudanhgia_chidoan->CHIDOAN_ID = $id;
      $phieudanhgia_chidoan->MAUPHIEU_ID = $request->mauphieu;
      $phieudanhgia_chidoan->NAMHOC_ID = $request->namhoc;
      $phieudanhgia_chidoan->XEPLOAI_CD_ID = $request->xeploai_cd;
      $phieudanhgia_chidoan->TEN_PDGCD = $request->ten_pdgcd;
      $phieudanhgia_chidoan->TAOMOI    = now();
      $phieudanhgia_chidoan->CAPNHAT   = null;
      $phieudanhgia_chidoan->save();
      $id_new = $phieudanhgia_chidoan->ID;
      $id_chidoan = $phieudanhgia_chidoan->CHIDOAN_ID;
        // dd($id_chidoan_thanhnien);
      $request->Session()->put('new_c',$id_new);
      $request->Session()->put('id_chidoan',$id_chidoan);

      return redirect(route('danhgiachidoan',$request->Session()->get('new_c')))

      ->with('success_message', 'Lưu thành công ^^');
    }
    else{
      return redirect()->back()
      ->with('error_message', 'Trung!!!');
    }


  }


  public function danhgia($id)
  {

    $phieudanhgia_chidoan = phieudanhgia_chidoan::find($id)
    ->join('chidoan','phieudanhgia_chidoan.CHIDOAN_ID', '=', 'chidoan.ID')
    ->join('xeploai_cd', 'phieudanhgia_chidoan.XEPLOAI_CD_ID', '=', 'xeploai_cd.ID')
    ->join('mauphieu', 'phieudanhgia_chidoan.MAUPHIEU_ID', '=', 'mauphieu.ID')
    ->join('namhoc', 'phieudanhgia_chidoan.NAMHOC_ID', '=', 'namhoc.ID')
    ->select('phieudanhgia_chidoan.*','chidoan.TEN_CD', 'mauphieu.TEN_MP', 'xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
    ->orderBy('ID','desc')->first();
        // dd($phieudanhgia_doanvien);
    $chitiet_mauphieu = DB::table('chitiet_mauphieu')
    ->join('mauphieu', 'mauphieu.ID', '=', 'chitiet_mauphieu.MAUPHIEU_ID')
    ->join('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
    ->join('kieu_dulieu', 'kieu_dulieu.ID', '=', 'noidung_pdg.KIEU_DULIEU_ID')
    ->where('chitiet_mauphieu.MAUPHIEU_ID', '=', 2)
    ->select('chitiet_mauphieu.*','mauphieu.TEN_MP', 'noidung_pdg.TEN_NDPDG', 'noidung_pdg.NOIDUNG_PDG', 'kieu_dulieu.TEN_KIEU_DULIEU')
    ->orderBy('THUTU_NOIDUNG')
    ->get();
    // $chitiet_pdg_dv = chitiet_pdg_dv::all();
    return view('backend.phieudanhgia_chidoan.chitiet_pdg_cd')
    ->with('pdg_cd', $phieudanhgia_chidoan)
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





    public function thongke_xeploai_cd (){
      $nam_dp = namhoc::latest('ID')->first();

      $results = DB::table('phieudanhgia_chidoan')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_chidoan.NAMHOC_ID')
      ->join('xeploai_cd','xeploai_cd.ID','=','phieudanhgia_chidoan.CB_XEPLOAI_CD_ID')
      ->select('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_chidoan.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CB_XEPLOAI_CD_ID','!=',null)
      ->groupBy('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
      ->get();  
        // dd($results);     
// dd($thongke);
      $namhoc = namhoc::all();

      $thongke = DB::table('phieudanhgia_chidoan')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_chidoan.NAMHOC_ID')
      ->join('xeploai_cd','xeploai_cd.ID','=','phieudanhgia_chidoan.CB_XEPLOAI_CD_ID')
      ->select('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_chidoan.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CB_XEPLOAI_CD_ID','!=',null)
      ->groupBy('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
      ->get();
        // dd($thongke);

      $labels = $results->pluck('TEN_XLCD');
      $values = $results->pluck('count');
        // $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
      return view('backend.phieudanhgia_chidoan.thongke_xeploai_cd')
      ->with('nh', $namhoc)
      ->with('n_dp', $nam_dp)
      ->with('labels', $labels)
      ->with('t_k',$thongke)
      ->with('results', $results)
      ->with('values', $values);
    }


    public function thongke_xeploai_theonam_cd (Request $request){
      $nam_dp = namhoc::find($request->namhoc);

      $namhoc = namhoc::all();
      $results = DB::table('phieudanhgia_chidoan')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_chidoan.NAMHOC_ID')
      ->join('xeploai_cd','xeploai_cd.ID','=','phieudanhgia_chidoan.CB_XEPLOAI_CD_ID')
      ->select('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_chidoan.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CB_XEPLOAI_CD_ID','!=',null)
      ->groupBy('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
      ->get();  
        // dd($results);     
// dd($thongke);
      $namhoc = namhoc::all();

      $thongke = DB::table('phieudanhgia_chidoan')
      ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_chidoan.NAMHOC_ID')
      ->join('xeploai_cd','xeploai_cd.ID','=','phieudanhgia_chidoan.CB_XEPLOAI_CD_ID')
      ->select('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_chidoan.ID) as count'))
      ->where('NAMHOC_ID', '=', $nam_dp->ID)
      ->where('CB_XEPLOAI_CD_ID','!=',null)
      ->groupBy('xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
      ->get();
        // dd($thongke);

      $labels = $results->pluck('TEN_XLCD');
      $values = $results->pluck('count');
// dd($values);
      return view('backend.phieudanhgia_chidoan.thongke_xeploai_cd')
      ->with('nh', $namhoc)
      ->with('n_dp', $nam_dp)
      ->with('labels', $labels)
      ->with('t_k', $thongke)
      ->with('results', $results)
      ->with('values', $values);
    }













    
  }
