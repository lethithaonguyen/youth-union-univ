<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chitiet_bau_ut;
use App\phieudanhgia_doanvien;
use App\phieubau_uutu;
use App\doanvien_thanhnien;
use App\chidoan;
use App\khoa;
use App\namhoc;
use DB;

class chitiet_bau_utController extends Controller
{
    public function doankhoa_index_getchidoan_ctbau(Request $request){
        $khoa = khoa::all();
        return view('backend.chitiet_bau_ut.doankhoa_index_getchidoan_ctbau')
        ->with('k', $khoa);
    }

    public function doankhoa_getchidoan_ctbau(Request $request){
        $khoa = khoa::find($request->khoa);
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        $chidoan = chidoan::where('DOANKHOA_ID', $id_doankhoa)
        ->where('KHOA_ID','=',$khoa->ID) 
        ->get();
        $request->session()->put('id_khoa', $khoa->ID);
        $request->session()->put('ten_khoa', $khoa->TEN_KHOA);
        return view('backend.chitiet_bau_ut.doankhoa_index_getctbau')
        ->with('k', $khoa)
        ->with('i_dk', $id_doankhoa)
        ->with('cd',$chidoan);
    }


    public function doankhoa_getctbau(Request $request){
        $chidoan = chidoan::find($request->chidoan);
        $chitiet_bau_ut = DB::table('chitiet_bau_ut')
        ->join('phieudanhgia_doanvien', 'phieudanhgia_doanvien.ID', '=', 'chitiet_bau_ut.PHIEUDANHGIA_DOANVIEN_ID')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('phieubau_uutu','phieubau_uutu.ID','=','chitiet_bau_ut.PHIEUBAU_UUTU_ID')
        ->where('chidoan.ID', $chidoan->ID)
        ->where('doankhoa.ID', $request->session()->get('session_id_doankhoa'))
        ->select('chitiet_bau_ut.*', 'phieudanhgia_doanvien.TEN_PDGDV','phieubau_uutu.NGAY_BAU','chidoan.TEN_CD','khoa.TEN_KHOA')
        ->get();
        // dd($chidoan->ID);
        $request->session()->put('chidoan', $chidoan->ID);
        $request->session()->put('ten_chidoan', $chidoan->TEN_CD);
         // dd($chidoan->TEN_CD);
        return view('backend.chitiet_bau_ut.index')
        ->with('ct_bau_ut', $chitiet_bau_ut);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('session_vt')==3){
            $chitiet_bau_ut = DB::table('chitiet_bau_ut')
            ->join('phieudanhgia_doanvien', 'phieudanhgia_doanvien.ID', '=', 'chitiet_bau_ut.PHIEUDANHGIA_DOANVIEN_ID')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('phieubau_uutu','phieubau_uutu.ID','=','chitiet_bau_ut.PHIEUBAU_UUTU_ID')
            ->where('chidoan.ID',$request->session()->get('session_id_chidoan_sv'))
            ->select('chitiet_bau_ut.*', 'phieudanhgia_doanvien.TEN_PDGDV','phieubau_uutu.NGAY_BAU','chidoan.TEN_CD','khoa.TEN_KHOA')
            ->get();    
        }
        else{
            $chitiet_bau_ut = DB::table('chitiet_bau_ut')
            ->join('phieudanhgia_doanvien', 'phieudanhgia_doanvien.ID', '=', 'chitiet_bau_ut.PHIEUDANHGIA_DOANVIEN_ID')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('phieubau_uutu','phieubau_uutu.ID','=','chitiet_bau_ut.PHIEUBAU_UUTU_ID')
            ->where('chidoan.ID',$request->session()->get('chidoan'))
            ->select('chitiet_bau_ut.*', 'phieudanhgia_doanvien.TEN_PDGDV','phieubau_uutu.NGAY_BAU','chidoan.TEN_CD','khoa.TEN_KHOA')
            ->get(); 
            // dd($chitiet_bau_ut);
        }
        // $chitiet_bau_ut = chitiet_bau_ut::all();

        return view('backend.chitiet_bau_ut.index')
        ->with('ct_bau_ut', $chitiet_bau_ut);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getnam_ctbau(Request $request)
    {
        if($request->session()->get('session_vt')==3){
         $nam_dp = namhoc::find($request->namhoc);
        // dd($nam_dp);
         $namhoc = namhoc::all();
         $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
         ->join('doanvien_thanhnien','doanvien_thanhnien.ID', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
         ->join('chidoan', 'chidoan.ID', 'doanvien_thanhnien.CHIDOAN_ID')
         ->where('phieudanhgia_doanvien.CD_XEPLOAI_DV_ID','!=',null)
         ->where('phieudanhgia_doanvien.NAMHOC_ID','=', $nam_dp->ID )
         ->where('chidoan.ID',$request->session()->get('session_id_chidoan_sv'))
         ->get();
         $phieubau_uutu = phieubau_uutu::join('chidoan', 'chidoan.ID', 'phieubau_uutu.CHIDOAN_ID')
       ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
       ->where('phieubau_uutu.CHIDOAN_ID',$request->session()->get('session_id_chidoan_sv'))
       ->select('phieubau_uutu.*','chidoan.TEN_CD')->get();
         $chitiet_bau_ut = chitiet_bau_ut::all(); 
     }else{
         $nam_dp = namhoc::find($request->namhoc);
        // dd($nam_dp);
         $namhoc = namhoc::all();
         $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
         ->join('doanvien_thanhnien','doanvien_thanhnien.ID', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
         ->join('chidoan', 'chidoan.ID', 'doanvien_thanhnien.CHIDOAN_ID')
         ->where('phieudanhgia_doanvien.CD_XEPLOAI_DV_ID','!=',null)
         ->where('phieudanhgia_doanvien.NAMHOC_ID','=', $nam_dp->ID )
         ->where('chidoan.ID',$request->session()->get('chidoan'))
         ->get();
         $phieubau_uutu = phieubau_uutu::all();
         $chitiet_bau_ut = chitiet_bau_ut::all(); 
     }

     return view('backend.chitiet_bau_ut.create')
     ->with('nh', $namhoc)
     ->with ('n_dp', $nam_dp)
     ->with ('pb_ut', $phieubau_uutu)
     ->with ('pdg_dv', $phieudanhgia_doanvien);
 }




 public function create(Request $request)
 {
    if($request->session()->get('session_vt')==3)
    {
       $nam_dp = namhoc::orderBy('ID','asc')->first();
       $namhoc = namhoc::all();
        // $namhoc = namhoc::find($request->namhoc);
       $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
       ->join('doanvien_thanhnien','doanvien_thanhnien.ID', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
       ->join('chidoan', 'chidoan.ID', 'doanvien_thanhnien.CHIDOAN_ID')
// ->where($request->Carbon()->now()->year,'=',2019)
       ->where('phieudanhgia_doanvien.CD_XEPLOAI_DV_ID','!=',null)
       ->where('phieudanhgia_doanvien.NAMHOC_ID', $nam_dp->ID )
       ->where('chidoan.ID',$request->session()->get('session_id_chidoan_sv'))
        ->select('phieudanhgia_doanvien.*', 'chidoan.TEN_CD')
       ->get();
        // dd($phieudanhgia_doanvien);
       $phieubau_uutu = phieubau_uutu::join('chidoan', 'chidoan.ID', 'phieubau_uutu.CHIDOAN_ID')
       ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
       ->where('phieubau_uutu.CHIDOAN_ID',$request->session()->get('session_id_chidoan_sv'))
       ->select('phieubau_uutu.*','chidoan.TEN_CD')->get();
       // dd($phieubau_uutu);
       $chitiet_bau_ut = chitiet_bau_ut::all(); 
   }
   else{
       $nam_dp = namhoc::latest('ID')->first();
       $namhoc = namhoc::all();
        // $namhoc = namhoc::find($request->namhoc);
       $phieudanhgia_doanvien = phieudanhgia_doanvien::where('phieudanhgia_doanvien.CD_XEPLOAI_DV_ID','!=',null)
       ->join('doanvien_thanhnien','doanvien_thanhnien.ID', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID')
       ->join('chidoan', 'chidoan.ID', 'doanvien_thanhnien.CHIDOAN_ID')
// ->where($request->Carbon()->now()->year,'=',2019)
       ->where('phieudanhgia_doanvien.NAMHOC_ID', $nam_dp->ID )
       ->where('chidoan.ID',$request->session()->get('chidoan'))
        // ->select('phieudanhgia_doanvien.*', 'chidoan.TEN_CD')
       ->get();
        // dd($phieudanhgia_doanvien);
       $phieubau_uutu = phieubau_uutu::join('chidoan', 'chidoan.ID', 'phieubau_uutu.CHIDOAN_ID')
       ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
       ->where('chidoan.ID',$request->session()->get('session_id_chidoan_sv'))
       ->select('phieubau_uutu.*','chidoan.TEN_CD')->get();
       $chitiet_bau_ut = chitiet_bau_ut::all(); 
   }

   return view('backend.chitiet_bau_ut.create')
   ->with ('n_dp', $nam_dp)
   ->with ('nh', $namhoc)
   ->with ('pb_ut', $phieubau_uutu)
   ->with ('pdg_dv', $phieudanhgia_doanvien);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chitiet_bau_ut = chitiet_bau_ut::where('PHIEUBAU_UUTU_ID', $request->tenphieubau_uutu)
        ->where('PHIEUDANHGIA_DOANVIEN_ID', $request->tenphieudanhgia_doanvien)
        ->where('SOPHIEU_DONGY', $request->tenchitiet_bau_ut)
        ->first();
        // dd($request->pdg);
        if(!$chitiet_bau_ut)
        {
            $chitiet_bau_ut = new chitiet_bau_ut();
            $chitiet_bau_ut->SOPHIEU_DONGY = $request->tenchitiet_bau_ut;
            $chitiet_bau_ut->PHIEUDANHGIA_DOANVIEN_ID = $request->pdg;
            $chitiet_bau_ut->PHIEUBAU_UUTU_ID = $request->tenphieubau_uutu;
            $chitiet_bau_ut->TAOMOI    = now();
            $chitiet_bau_ut->CAPNHAT   = null;
            $chitiet_bau_ut->save();
            return redirect(route('chitiet_bau_ut.index'))
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
        $chitiet_bau_ut = chitiet_bau_ut::find($id);
        $phieudanhgia_doanvien = phieudanhgia_doanvien::all();
        $phieubau_uutu = phieubau_uutu::join('chidoan', 'chidoan.ID', 'phieubau_uutu.CHIDOAN_ID')
       ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
       ->select('phieubau_uutu.*','chidoan.TEN_CD')->get();
        return view('backend.chitiet_bau_ut.edit')
        ->with('chitiet_bau_ut', $chitiet_bau_ut)
        ->with ('pdg_dv', $phieudanhgia_doanvien)
        ->with('pb_ut',$phieubau_uutu);
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
        $chitiet_bau_ut = chitiet_bau_ut::find($id);
        $chitiet_bau_ut1 = chitiet_bau_ut::where('PHIEUBAU_UUTU_ID', $request->tenphieubau_uutu)
        ->where('PHIEUDANHGIA_DOANVIEN_ID', $request->tenphieudanhgia_doanvien)
        ->where('SOPHIEU_DONGY', $request->tenchitiet_bau_ut)
        ->first();
        if(!$chitiet_bau_ut1)
        {
            $chitiet_bau_ut->SOPHIEU_DONGY = $request->tenchitiet_bau_ut;
            $chitiet_bau_ut->PHIEUDANHGIA_DOANVIEN_ID = $request->tenphieudanhgia_doanvien;
            $chitiet_bau_ut->PHIEUBAU_UUTU_ID = $request->tenphieubau_uutu;
            $chitiet_bau_ut->CAPNHAT    = now();
            $chitiet_bau_ut->save();
            return redirect(route('chitiet_bau_ut.index'))
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

    public function bulkDeleteCT_PBUT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $chitiet_bau_ut = chitiet_bau_ut::find($id);
                $chitiet_bau_ut->delete();
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
