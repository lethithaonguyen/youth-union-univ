<?php

namespace App\Http\Controllers;
use App\phieudanhgia_doankhoa;
use Illuminate\Http\Request;
use App\doankhoa;
use App\khoa;
use App\doanvien_thanhnien;
use App\chidoan;
use App\namhoc;
use App\mauphieu;
use App\xeploai_dk;
use App\chitiet_pdg_dk;
use session;
use DB;

class phieudanhgia_doankhoaController extends Controller
{


  public function index_create_pdg_dk(Request $request)
  {

    $id_doankhoa = $request->session()->get('session_id_doankhoa');

// dd($request->session()->get('session_id_sv'));

    $doankhoa = DB::table('doankhoa')
    ->where('doankhoa.ID', '=', $id_doankhoa)
    ->select('doankhoa.*')
    ->get();
        // dd($doanvien_thanhnien);
    return view('backend.phieudanhgia_doankhoa.add_pdg_dk')
    ->with('i_dk', $id_doankhoa)
    ->with('dk', $doankhoa);

  }

   public function thongke_xeploai_dk (){
        $nam_dp = namhoc::orderBy('ID','asc')->first();

        $results = DB::table('phieudanhgia_doankhoa')
        ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doankhoa.NAMHOC_ID')
        ->join('xeploai_dk','xeploai_dk.ID','=','phieudanhgia_doankhoa.CB_XEPLOAI_DK_ID')
        ->select('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doankhoa.ID) as count'))
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('CB_XEPLOAI_DK_ID','!=',null)
        ->groupBy('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
        ->get();  
        // dd($results);     
// dd($thongke);
        $namhoc = namhoc::all();

        $thongke = DB::table('phieudanhgia_doankhoa')
        ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doankhoa.NAMHOC_ID')
        ->join('xeploai_dk','xeploai_dk.ID','=','phieudanhgia_doankhoa.CB_XEPLOAI_DK_ID')
        ->select('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doankhoa.ID) as count'))
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('CB_XEPLOAI_DK_ID','!=',null)
        ->groupBy('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
        ->get();
        // dd($thongke);

        $labels = $results->pluck('TEN_XLDK');
        $values = $results->pluck('count');
        // $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
        return view('backend.phieudanhgia_doankhoa.thongke_xeploai_dk')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_k',$thongke)
        ->with('results', $results)
        ->with('values', $values);
    }


    public function thongke_xeploai_theonam_dk (Request $request){
        $nam_dp = namhoc::find($request->namhoc);

        $namhoc = namhoc::all();
        $results = DB::table('phieudanhgia_doankhoa')
        ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doankhoa.NAMHOC_ID')
        ->join('xeploai_dk','xeploai_dk.ID','=','phieudanhgia_doankhoa.CB_XEPLOAI_DK_ID')
        ->select('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doankhoa.ID) as count'))
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('CB_XEPLOAI_DK_ID','!=',null)
        ->groupBy('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
        ->get();  
        // dd($results);     
// dd($thongke);
        $namhoc = namhoc::all();

        $thongke = DB::table('phieudanhgia_doankhoa')
        ->join('namhoc', 'namhoc.ID', '=', 'phieudanhgia_doankhoa.NAMHOC_ID')
        ->join('xeploai_dk','xeploai_dk.ID','=','phieudanhgia_doankhoa.CB_XEPLOAI_DK_ID')
        ->select('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH',DB::raw('count(phieudanhgia_doankhoa.ID) as count'))
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->where('CB_XEPLOAI_DK_ID','!=',null)
        ->groupBy('xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
        ->get();
        // dd($thongke);

        $labels = $results->pluck('TEN_XLDK');
        $values = $results->pluck('count');
// dd($values);
        return view('backend.phieudanhgia_doankhoa.thongke_xeploai_dk')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_k', $thongke)
        ->with('results', $results)
        ->with('values', $values);
    }


  public function ds_pdg_dk(Request $request)
  {

   $id_doankhoa = $request->session()->get('session_id_doankhoa');

// dd($request->session()->get('session_id_sv'));

   $phieudanhgia_doankhoa = DB::table('phieudanhgia_doankhoa')

   ->join('mauphieu', 'phieudanhgia_doankhoa.MAUPHIEU_ID', 'mauphieu.ID')
   ->join('namhoc', 'phieudanhgia_doankhoa.NAMHOC_ID', 'namhoc.ID')
   ->join('xeploai_dk', 'phieudanhgia_doankhoa.XEPLOAI_DK_ID', 'xeploai_dk.ID')
   ->where('DOANKHOA_ID', '=', $id_doankhoa)
   ->select('phieudanhgia_doankhoa.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_dk.TEN_XLDK')
   ->get();
        // dd($chidoan_thanhnien);
   return view('backend.phieudanhgia_doankhoa.ds_pdg_dk')
   ->with('i_dk', $id_doankhoa)
   ->with('pdg_dk', $phieudanhgia_doankhoa);

 }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $doankhoa = doankhoa::find($id);
       // dd($doanvien_thanhnien);
       // $xem_phieudanhgia_sinhvien
     // $request->session()->put('id_doanvien_thanhnien',$id);
     $namhoc = namhoc::all();
     $mauphieu = mauphieu::all();
     $xeploai_dk = xeploai_dk::all();
     // $phieudanhgia_doanvien = phieudanhgia_doanvien::where('DOANVIEN_THANHNIEN_ID',$id)->get();

     return view('backend.phieudanhgia_doankhoa.create')
     ->with('nh', $namhoc)
     ->with('mp', $mauphieu)
     ->with('xl_dk', $xeploai_dk)
     ->with('dk', $doankhoa);
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

     $phieudanhgia_doankhoa1 = phieudanhgia_doankhoa::where('DOANKHOA_ID', '=' ,$id)->where('NAMHOC_ID','=',$request->namhoc)->first();
     // dd($phieudanhgia_chidoan1);
     if(!$phieudanhgia_doankhoa1){
      $phieudanhgia_doankhoa = new phieudanhgia_doankhoa();
      $phieudanhgia_doankhoa->DOANKHOA_ID = $id;
      $phieudanhgia_doankhoa->MAUPHIEU_ID = $request->mauphieu;
      $phieudanhgia_doankhoa->NAMHOC_ID = $request->namhoc;
      $phieudanhgia_doankhoa->XEPLOAI_DK_ID = $request->xeploai_dk;
      $phieudanhgia_doankhoa->TEN_PDGDK = $request->ten_pdgdk;
      $phieudanhgia_doankhoa->TAOMOI    = now();
      $phieudanhgia_doankhoa->CAPNHAT   = null;
      $phieudanhgia_doankhoa->save();
      $id_new = $phieudanhgia_doankhoa->ID;
      $id_doankhoa = $phieudanhgia_doankhoa->DOANKHOA_ID;
        // dd($id_chidoan_thanhnien);
      $request->Session()->put('new_dk',$id_new);
      $request->Session()->put('id_doankhoa',$id_doankhoa);

      return redirect(route('danhgiadoankhoa',$request->Session()->get('new_dk')))

      ->with('success_message', 'Lưu thành công ^^');
    }
    else{
      return redirect()->back()
      ->with('error_message', 'Trung!!!');
    }


  }


  public function danhgia($id)
  {

    $phieudanhgia_doankhoa = phieudanhgia_doankhoa::find($id)
    ->join('doankhoa','phieudanhgia_doankhoa.DOANKHOA_ID', '=', 'doankhoa.ID')
    ->join('xeploai_dk', 'phieudanhgia_doankhoa.XEPLOAI_DK_ID', '=', 'xeploai_dk.ID')
    ->join('mauphieu', 'phieudanhgia_doankhoa.MAUPHIEU_ID', '=', 'mauphieu.ID')
    ->join('namhoc', 'phieudanhgia_doankhoa.NAMHOC_ID', '=', 'namhoc.ID')
    ->select('phieudanhgia_doankhoa.*','doankhoa.TEN_DK', 'mauphieu.TEN_MP', 'xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
    ->orderBy('ID','desc')->first();
        // dd($phieudanhgia_doanvien);
    $chitiet_mauphieu = DB::table('chitiet_mauphieu')
    ->join('mauphieu', 'mauphieu.ID', '=', 'chitiet_mauphieu.MAUPHIEU_ID')
    ->join('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
    ->join('kieu_dulieu', 'kieu_dulieu.ID', '=', 'noidung_pdg.KIEU_DULIEU_ID')
    ->where('chitiet_mauphieu.MAUPHIEU_ID', '=', 3)
    ->select('chitiet_mauphieu.*','mauphieu.TEN_MP', 'noidung_pdg.TEN_NDPDG', 'noidung_pdg.NOIDUNG_PDG', 'kieu_dulieu.TEN_KIEU_DULIEU')
    ->orderBy('THUTU_NOIDUNG')
    ->get();
    // $chitiet_pdg_dv = chitiet_pdg_dv::all();
    return view('backend.phieudanhgia_doankhoa.chitiet_pdg_dk')
    ->with('pdg_dk', $phieudanhgia_doankhoa)
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
  }
