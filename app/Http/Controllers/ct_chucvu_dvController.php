<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ct_chucvu_dv;
use App\doanvien_thanhnien;
use App\chucvu_dv;
use App\hocky;
use App\doankhoa;
use App\chidoan;
use App\khoa;
use DB;

class ct_chucvu_dvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('session_vt')==2){
            $ct_chucvu_dv = DB::table('ct_chucvu_dv')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'ct_chucvu_dv.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('chucvu_dv', 'chucvu_dv.ID', '=', 'ct_chucvu_dv.CHUCVU_DV_ID')
            ->where('doankhoa.ID', $request->session()->get('session_id_doankhoa'))
            ->select('ct_chucvu_dv.*', 'doanvien_thanhnien.TEN_SV', 'chucvu_dv.TEN_CHUCVU', 'chidoan.TEN_CD', 'khoa.TEN_KHOA', 'doankhoa.TEN_DK')
            ->get();
        }
        else if($request->session()->get('session_vt')==3){
            $ct_chucvu_dv = DB::table('ct_chucvu_dv')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'ct_chucvu_dv.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('chucvu_dv', 'chucvu_dv.ID', '=', 'ct_chucvu_dv.CHUCVU_DV_ID')
            ->where('chidoan.ID', $request->session()->get('session_id_chidoan_sv'))
            ->select('ct_chucvu_dv.*', 'doanvien_thanhnien.TEN_SV', 'chucvu_dv.TEN_CHUCVU', 'chidoan.TEN_CD', 'khoa.TEN_KHOA', 'doankhoa.TEN_DK')
            ->get();
        }
        else{
          $ct_chucvu_dv = DB::table('ct_chucvu_dv')
          ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'ct_chucvu_dv.DOANVIEN_THANHNIEN_ID')
          ->join('chucvu_dv', 'chucvu_dv.ID', '=', 'ct_chucvu_dv.CHUCVU_DV_ID')
          ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
          ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
          ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
          ->select('ct_chucvu_dv.*', 'doanvien_thanhnien.TEN_SV', 'chucvu_dv.TEN_CHUCVU', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA', 'chidoan.TEN_CD')
          ->get();  
          // dd($ct_chucvu_dv);
      }
        // $ct_chucvu_dv = ct_chucvu_dv::all();

      return view('backend.ct_chucvu_dv.index')
      ->with('ct_cv_dv', $ct_chucvu_dv);

  }


  public function index_getchidoan(Request $request){
    $doankhoa = doankhoa::all();
    $khoa = khoa::all();
    return view('backend.ct_chucvu_dv.index_getchidoan')
    ->with('dk',$doankhoa)
    ->with('k', $khoa);

}
public function getchidoan(Request $request){
    $doankhoa = doankhoa::find($request->doankhoa);
    $khoa = khoa::find($request->khoa);
    $chidoan = chidoan::where('DOANKHOA_ID',$doankhoa->ID)
    ->where('KHOA_ID',$khoa->ID)
    ->get();

    return view('backend.ct_chucvu_dv.index_getdoanvien')
    ->with('dk',$doankhoa)
    ->with('k', $khoa)
    ->with('cd',$chidoan);
}

public function getdoanvien(Request $request){
    $chidoan = chidoan::find($request->chidoan);
    $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID',$chidoan->ID)->get();
    $chucvu_dv = chucvu_dv::all();
    return view('backend.ct_chucvu_dv.create')
    ->with('dv_tn', $doanvien_thanhnien)
    ->with('cd', $chidoan)
    ->with('cv_dv', $chucvu_dv);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $chucvu_dv = chucvu_dv::all();
        return view('backend.ct_chucvu_dv.create')
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('cv_dv', $chucvu_dv);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ct_chucvu_dv = ct_chucvu_dv::where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('CHUCVU_DV_ID', $request->tenchucvu_dv)
        ->first();
        if(!$ct_chucvu_dv)
        {
            $ct_chucvu_dv = new ct_chucvu_dv();
            $ct_chucvu_dv->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $ct_chucvu_dv->CHUCVU_DV_ID = $request->tenchucvu_dv;
            $ct_chucvu_dv->NGAYBD_CV = $request->ngaybd;
            $ct_chucvu_dv->NGAYKT_CV = $request->ngaykt;
            $ct_chucvu_dv->TAOMOI    = now();
            $ct_chucvu_dv->CAPNHAT   = null;
            $ct_chucvu_dv->save();
            return redirect(route('ct_chucvu_dv.index'))
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
        $ct_chucvu_dv = ct_chucvu_dv::find($id);
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $chucvu_dv = chucvu_dv::all();
        return view('backend.ct_chucvu_dv.edit')
        ->with('ct_chucvu_dv', $ct_chucvu_dv)
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('cv_dv', $chucvu_dv);
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
        $ct_chucvu_dv = ct_chucvu_dv::find($id);
        $ct_chucvu_dv1 = ct_chucvu_dv::where('NGAYBD_CV', $request->tenct_chucvu_dv)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('CHUCVU_DV_ID', $request->tenchucvu_dv)
        ->first();
        if(!$ct_chucvu_dv1)
        {
            $ct_chucvu_dv->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $ct_chucvu_dv->CHUCVU_DV_ID = $request->tenchucvu_dv;
            $ct_chucvu_dv->NGAYBD_CV = $request->ngaybd;
            $ct_chucvu_dv->NGAYKT_CV = $request->ngaykt;
            $ct_chucvu_dv->CAPNHAT    = now();
            $ct_chucvu_dv->save();
            return redirect(route('ct_chucvu_dv.index'))
            ->with('success_message', 'Lưu thành công ^^');
        }
        else
        {
         return redirect()->back()
         ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
     }
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

    public function bulkDeleteCT_CV_DV(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $ct_chucvu_dv = ct_chucvu_dv::find($id);
                $ct_chucvu_dv->delete();
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
