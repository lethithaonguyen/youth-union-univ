<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\dv_ketnap;
use App\qd_dv_ketnap;
use App\chidoan;
use App\doankhoa;
use App\khoa;
use Session;

use DB;

class qd_dv_ketnapController extends Controller
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
            $qd_dv_ketnap = DB::table('qd_dv_ketnap')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'qd_dv_ketnap.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('dv_ketnap', 'dv_ketnap.ID', '=', 'qd_dv_ketnap.DV_KETNAP_ID')
            ->where('doankhoa.ID', $request->session()->get('session_id_doankhoa'))
            ->select('qd_dv_ketnap.*', 'doanvien_thanhnien.TEN_SV', 'dv_ketnap.NGAYKETNAP', 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA', 'doanvien_thanhnien.MSSV')
            ->get();
        }else{

            $qd_dv_ketnap = DB::table('qd_dv_ketnap')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'qd_dv_ketnap.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('dv_ketnap', 'dv_ketnap.ID', '=', 'qd_dv_ketnap.DV_KETNAP_ID')
            ->where('doankhoa.ID', $doankhoa_loc->ID)
            ->where('khoa.ID', $khoa_loc->ID)
            ->select('qd_dv_ketnap.*', 'doanvien_thanhnien.TEN_SV', 'dv_ketnap.NGAYKETNAP', 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA','doanvien_thanhnien.MSSV')
            ->get(); 
        }
        return view('backend.qd_dv_ketnap.index')
        ->with('qd_dv_kn', $qd_dv_ketnap)
        ->with('dk', $doankhoa)
        ->with('dk_l', $doankhoa_loc)
        ->with('k', $khoa)
        ->with('k_l', $khoa_loc);

    }

    public function loc_ketnap(Request $request)
    {
        $doankhoa = doankhoa::all();
        $doankhoa_loc = doankhoa::find($request->doankhoa);
        $khoa  = khoa::all();
        $khoa_loc  = khoa::find($request->khoa);
        $qd_dv_ketnap = DB::table('qd_dv_ketnap')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'qd_dv_ketnap.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->join('dv_ketnap', 'dv_ketnap.ID', '=', 'qd_dv_ketnap.DV_KETNAP_ID')
        ->where('doankhoa.ID', $doankhoa_loc->ID)
        ->where('khoa.ID', $khoa_loc->ID)
        ->select('qd_dv_ketnap.*', 'doanvien_thanhnien.TEN_SV', 'dv_ketnap.NGAYKETNAP', 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA','doanvien_thanhnien.MSSV')
        ->get();
        return view('backend.qd_dv_ketnap.index')
        ->with('qd_dv_kn', $qd_dv_ketnap)
        ->with('dk', $doankhoa)
        ->with('dk_l', $doankhoa_loc)
        ->with('k', $khoa)
        ->with('k_l', $khoa_loc); 
    }

    public function index_getchidoan_kn(Request $request){
    // $doankhoa = doankhoa::all();
        $khoa = khoa::all();
        return view('backend.qd_dv_ketnap.index_getchidoan_kn')
    // ->with('dk',$doankhoa)
        ->with('k', $khoa);

    }
    public function getchidoan_kn(Request $request){
    // $doankhoa = doankhoa::find($request->doankhoa);
        $khoa = khoa::find($request->khoa);
        $chidoan = chidoan::where('DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
        ->where('KHOA_ID',$khoa->ID)
        ->get();
        $request->session()->put('ten_khoa', $khoa->TEN_KHOA);
    // dd($khoa->TEN_KHOA);
        return view('backend.qd_dv_ketnap.index_getdoanvien_kn')
    // ->with('dk',$doankhoa)
        ->with('k', $khoa)
        ->with('cd',$chidoan);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdoanvien_kn(Request $request)
    {
        $chidoan = chidoan::find($request->chidoan);
        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID', $chidoan->ID)
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV', '=', null)
        ->get();
        $request->session()->put('ten_chidoan', $chidoan->TEN_CD);
        $dv_ketnap = dv_ketnap::all();
        return view('backend.qd_dv_ketnap.create')
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('dv_kn', $dv_ketnap);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $qd_dv_ketnap = qd_dv_ketnap::where('DV_KETNAP_ID', $request->tenngayketnap)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->first();
        $doanvien = $request->doanvien; 
        if(!$qd_dv_ketnap)
        {
            foreach($doanvien as $dv){
                $qd_dv_ketnap = new qd_dv_ketnap();
                $qd_dv_ketnap->DUYET_KN = $request->tenduyet;
                $qd_dv_ketnap->DOANVIEN_THANHNIEN_ID = $dv;
                $qd_dv_ketnap->DV_KETNAP_ID = $request->tendv_ketnap;
                $qd_dv_ketnap->TAOMOI    = now();
                $qd_dv_ketnap->CAPNHAT   = null;
                $qd_dv_ketnap->save();
            }
            return redirect(route('qd_dv_ketnap.index'))
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
        $qd_dv_ketnap = qd_dv_ketnap::find($id);
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $dv_ketnap = dv_ketnap::all();
        return view('backend.qd_dv_ketnap.edit')
        ->with('qd_dv_ketnap', $qd_dv_ketnap)
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('dv_kn', $dv_ketnap);
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
       $qd_dv_ketnap = qd_dv_ketnap::find($id);
       $qd_dv_ketnap1 = qd_dv_ketnap::where('DV_KETNAP_ID', $request->tenngayketnap)
       ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
       ->first();
       if(!$qd_dv_ketnap1)
       {
        $qd_dv_ketnap->DUYET_KN = $request->tenduyet;
        $qd_dv_ketnap->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
        $qd_dv_ketnap->DV_KETNAP_ID = $request->tendv_ketnap;
        $qd_dv_ketnap->CAPNHAT    = now();
        $qd_dv_ketnap->save();
        return redirect(route('qd_dv_ketnap.index'))
        ->with('success_message', 'Lưu thành công ^^');
    }
    else
    {
       return redirect()->back()
       ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
   }
}


public function huyduyet(Request $request){
    $qd_dv_ketnap = qd_dv_ketnap::findOrFail($request->id);
        // dd($k, $k1);
    $qd_dv_ketnap->DUYET_KN = '1';
    $qd_dv_ketnap->save();

    Session::flash('capquyensuccess', 'This is a message!');
    return redirect(route('backend.qd_dv_ketnap.index'));

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $qd_dv_ketnap = qd_dv_ketnap::findOrFail($request->id);
        $qd_dv_ketnap->delete();
        Session::flash('deletesuccess', 'This is a message!');
        return redirect(route('qd_dv_ketnap.index'));
    }

}
