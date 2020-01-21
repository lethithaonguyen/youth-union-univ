<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\dv_tt_doan;
use App\qd_dv_ttdoan;
use App\chidoan;
use App\doankhoa;
use App\khoa;
// use App\Http\Controllers\YEAR();
use Session;

use DB;

class qd_dv_ttdoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doankhoa = doankhoa::all();
        $doankhoa_loc = doankhoa::orderBy('ID','asc')->first();
        $khoa = khoa::all();
        $khoa_loc = khoa::orderBy('ID', 'asc')->first();
        if($request->session()->get('session_vt') == 2){
          $qd_dv_ttdoan = DB::table('qd_dv_ttdoan')
          ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID')
          ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
          ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
          ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
          ->join('dv_tt_doan', 'dv_tt_doan.ID', '=', 'qd_dv_ttdoan.DV_TT_DOAN_ID')
          ->where('doankhoa.ID', $request->session()->get('session_id_doankhoa'))
          ->select('qd_dv_ttdoan.*', 'doanvien_thanhnien.TEN_SV', 'dv_tt_doan.NGAYTTDOAN' , 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA', 'doanvien_thanhnien.MSSV')
          ->get();  
      }else{

        $qd_dv_ttdoan = DB::table('qd_dv_ttdoan')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->join('dv_tt_doan', 'dv_tt_doan.ID', '=', 'qd_dv_ttdoan.DV_TT_DOAN_ID')
        ->where('doankhoa.ID', $doankhoa_loc->ID)
        ->where('khoa.ID', $khoa_loc->ID)
        ->select('qd_dv_ttdoan.*', 'doanvien_thanhnien.TEN_SV', 'dv_tt_doan.NGAYTTDOAN' , 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA', 'doanvien_thanhnien.MSSV')
        ->get(); 
    }

    return view('backend.qd_dv_ttdoan.index')
    ->with('qd_dv_tt', $qd_dv_ttdoan)
    ->with('dk', $doankhoa)
    ->with('dk_l', $doankhoa_loc)
    ->with('k', $khoa)
    ->with('k_l', $khoa_loc);

}


public function loc_ttdoan(Request $request)
{
    $doankhoa = doankhoa::all();
    $doankhoa_loc = doankhoa::find($request->doankhoa);
    $khoa  = khoa::all();
    $khoa_loc  = khoa::find($request->khoa);
    $qd_dv_ttdoan = DB::table('qd_dv_ttdoan')
    ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID')
    ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
    ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
    ->join('dv_tt_doan', 'dv_tt_doan.ID', '=', 'qd_dv_ttdoan.DV_TT_DOAN_ID')
    ->where('doankhoa.ID', $doankhoa_loc->ID)
    ->where('khoa.ID', $khoa_loc->ID)
    ->select('qd_dv_ttdoan.*', 'doanvien_thanhnien.TEN_SV', 'dv_tt_doan.NGAYTTDOAN' , 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA', 'doanvien_thanhnien.MSSV')
    ->get();
    return view('backend.qd_dv_ttdoan.index')
    ->with('qd_dv_tt', $qd_dv_ttdoan)
    ->with('dk', $doankhoa)
    ->with('dk_l', $doankhoa_loc)
    ->with('k', $khoa)
    ->with('k_l', $khoa_loc); 
}



public function index_getchidoan_tt(Request $request){
    // $doankhoa = doankhoa::all();
    $khoa = khoa::all();
    return view('backend.qd_dv_ttdoan.index_getchidoan_tt')
    // ->with('dk',$doankhoa)
    ->with('k', $khoa);

}
public function getchidoan_tt(Request $request){
    // $doankhoa = doankhoa::find($request->doankhoa);
    $khoa = khoa::find($request->khoa);
    $chidoan = chidoan::where('DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
    ->where('KHOA_ID',$khoa->ID)
    ->get();
    $request->session()->put('ten_khoa', $khoa->TEN_KHOA);
    // dd($khoa->TEN_KHOA);
    return view('backend.qd_dv_ttdoan.index_getdoanvien_tt')
    // ->with('dk',$doankhoa)
    ->with('k', $khoa)
    ->with('cd',$chidoan);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdoanvien_tt(Request $request)
    {
        $chidoan = chidoan::find($request->chidoan);
        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID', $chidoan->ID)
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV','=', null)
        ->where('doanvien_thanhnien.NGAYSINH_SV','<', '1989-01-01')
        ->get();
        // dd($doanvien_thanhnien);
        $request->session()->put('ten_chidoan', $chidoan->TEN_CD);
        $dv_tt_doan = dv_tt_doan::all();
        return view('backend.qd_dv_ttdoan.create')
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('dv_tt', $dv_tt_doan);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qd_dv_ttdoan = qd_dv_ttdoan::where('DV_TT_DOAN_ID', $request->tenngaydv_tt_doan)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->first();
        $doanvien = $request->doanvien;
        if(!$qd_dv_ttdoan)
        {
         foreach($doanvien as $dv){
            $qd_dv_ttdoan = new qd_dv_ttdoan();
            $qd_dv_ttdoan->DUYET_TTD = $request->tenduyet;
            $qd_dv_ttdoan->DOANVIEN_THANHNIEN_ID = $dv;
            $qd_dv_ttdoan->DV_TT_DOAN_ID = $request->tenngaydv_tt_doan;
            $qd_dv_ttdoan->TAOMOI    = now();
            $qd_dv_ttdoan->CAPNHAT   = null;
            $qd_dv_ttdoan->save();
        }
        return redirect(route('qd_dv_ttdoan.index'))
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
        $qd_dv_ttdoan = qd_dv_ttdoan::find($id);
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $dv_tt_doan = dv_tt_doan::all();
        return view('backend.qd_dv_ttdoan.edit')
        ->with('qd_dv_ttdoan', $qd_dv_ttdoan)
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('dv_tt', $dv_tt_doan);
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
       $qd_dv_ttdoan = qd_dv_ttdoan::find($id);
       $qd_dv_ttdoan1 = qd_dv_ttdoan::where('DV_TT_DOAN_ID', $request->tenngaydv_tt_doan)
       ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
       ->first();
       if(!$qd_dv_ttdoan1)
       {
        $qd_dv_ttdoan->DUYET_TTD = $request->tenduyet;
        $qd_dv_ttdoan->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
        $qd_dv_ttdoan->DV_TT_DOAN_ID = $request->tenngaydv_tt_doan;
        $qd_dv_ttdoan->CAPNHAT    = now();
        $qd_dv_ttdoan->save();
        return redirect(route('qd_dv_ttdoan.index'))
        ->with('success_message', 'Lưu thành công ^^');
    }
    else
    {
       return redirect()->back()
       ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
   }
}


public function huyduyet(Request $request){
    $qd_dv_ttdoan = qd_dv_ttdoan::findOrFail($request->id);
        // dd($k, $k1);
    $qd_dv_ttdoan->DUYET_TTDOAN = '1';
    $qd_dv_ttdoan->save();

    Session::flash('capquyensuccess', 'This is a message!');
    return redirect(route('backend.qd_dv_ttdoan.index'));

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $qd_dv_ttdoan = qd_dv_ttdoan::findOrFail($request->id);
        $qd_dv_ttdoan->delete();
        Session::flash('deletesuccess', 'This is a message!');
        return redirect(route('qd_dv_ttdoan.index'));
    }

}
