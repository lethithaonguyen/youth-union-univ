<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phieubau_uutu;
use App\chidoan;
use App\doanvien_thanhnien;

use DB;

class phieubau_uutuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $phieubau_uutu = phieubau_uutu::all();
        if($request->session()->get('session_vt') == 3){
            $phieubau_uutu = DB::table('phieubau_uutu')
            ->join('chidoan', 'chidoan.ID', '=', 'phieubau_uutu.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('doanvien_thanhnien','doanvien_thanhnien.ID','=','phieubau_uutu.DOANVIEN_THANHNIEN_ID')
            ->where('chidoan.ID', $request->session()->get('session_id_chidoan_sv'))
            ->select('phieubau_uutu.*', 'chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'khoa.TEN_KHOA')
            ->get();
        }else{
            $phieubau_uutu = DB::table('phieubau_uutu')
            ->join('chidoan', 'chidoan.ID', '=', 'phieubau_uutu.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('doanvien_thanhnien','doanvien_thanhnien.ID','=','phieubau_uutu.DOANVIEN_THANHNIEN_ID')
            ->where('doankhoa.ID', $request->session()->get('session_id_doankhoa'))
            ->select('phieubau_uutu.*', 'chidoan.TEN_CD','doanvien_thanhnien.TEN_SV', 'khoa.TEN_KHOA')
            ->get();
        }
        return view('backend.phieubau_uutu.index')
        ->with('pbut', $phieubau_uutu);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $chidoan = chidoan::join('khoa','khoa.ID','chidoan.KHOA_ID')
        ->where('chidoan.ID', $request->session()->get('session_id_chidoan_sv') )
        ->select('khoa.TEN_KHOA', 'chidoan.*')
        ->get();
        $doanvien_thanhnien = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('doanvien_thanhnien.CHIDOAN_ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('users.VAITRO_ID','=', 3)
        ->select('doanvien_thanhnien.*')
        ->get();
        $phieubau_uutu = phieubau_uutu::all();
        return view('backend.phieubau_uutu.create')
        ->with ('dvtn', $doanvien_thanhnien)
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
        $phieubau_uutu = phieubau_uutu::where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('CHIDOAN_ID', $request->tenchidoan)
        ->where('SOPHIEU_TONG', $request->tenphieubau_uutu)
        ->where('NGAY_BAU', $request->tenngay_bau)
        ->first();
        if(!$phieubau_uutu)
        {
            $phieubau_uutu = new phieubau_uutu();
            $phieubau_uutu->SOPHIEU_TONG = $request->tenphieubau_uutu;
            $phieubau_uutu->CHIDOAN_ID = $request->tenchidoan;
            $phieubau_uutu->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $phieubau_uutu->NGAY_BAU = $request->tenngay_bau;
            $phieubau_uutu->TAOMOI    = now();
            $phieubau_uutu->CAPNHAT   = null;
            $phieubau_uutu->save();
            return redirect(route('phieubau_uutu.index'))
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
    public function edit($id, Request $request)
    {
        $phieubau_uutu = phieubau_uutu::find($id);
        $chidoan = chidoan::all();
        $doanvien_thanhnien = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('doanvien_thanhnien.CHIDOAN_ID', '=', $request->session()->get('session_id_chidoan_sv'))
        ->where('users.VAITRO_ID','=', 3)
        ->select('doanvien_thanhnien.*')
        ->get();
        return view('backend.phieubau_uutu.edit')
        ->with('phieubau_uutu', $phieubau_uutu)
        ->with ('cd', $chidoan)
        ->with('dvtn',$doanvien_thanhnien);
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
        $phieubau_uutu = phieubau_uutu::find($id);
        $phieubau_uutu1 = phieubau_uutu::where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('CHIDOAN_ID', $request->tenchidoan)
        ->where('SOPHIEU_TONG', $request->tenphieubau_uutu)
        ->where('NGAY_BAU', $request->tenngay_bau)
        ->first();
        if(!$phieubau_uutu1)
        {
            $phieubau_uutu->SOPHIEU_TONG = $request->tenphieubau_uutu;
            $phieubau_uutu->NGAY_BAU = $request->tenngay_bau;
            $phieubau_uutu->CHIDOAN_ID = $request->tenchidoan;
            $phieubau_uutu->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $phieubau_uutu->CAPNHAT    = now();
            $phieubau_uutu->save();
            return redirect(route('phieubau_uutu.index'))
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

    public function bulkDeletePBUT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $phieubau_uutu = phieubau_uutu::find($id);
                $phieubau_uutu->delete();
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
