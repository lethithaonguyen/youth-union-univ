<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\thanhtich_thamgia;
use App\pt_doankhoa;
use App\doanvien_thanhnien;
use App\thanhtich;
use App\chidoan;
use App\khoa;
use App\namhoc;
use App\hocky;

use DB;

class thanhtich_thamgiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('session_vt') == 4){
            $id_sv = $request->session()->get('session_id_sv');
            $ten_sv = $request->session()->get('session_ten_sv');
        // $thanhtich_thamgia = thanhtich_thamgia::all();
            $thanhtich_thamgia = DB::table('thanhtich_thamgia')
            ->join('pt_doankhoa', 'pt_doankhoa.ID', '=', 'thanhtich_thamgia.PT_DOANKHOA_ID')
            ->join('hocky', 'hocky.ID', '=', 'pt_doankhoa.HOCKY_ID')
            ->join('namhoc', 'namhoc.ID', '=', 'hocky.NAMHOC_ID')
            ->join('doanvien_thanhnien','doanvien_thanhnien.ID','=','thanhtich_thamgia.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('thanhtich', 'thanhtich.ID', '=', 'thanhtich_thamgia.THANHTICH_ID')
            ->where('DOANVIEN_THANHNIEN_ID', '=', $id_sv)
            ->select('thanhtich_thamgia.*','pt_doankhoa.TEN_PT_DK', 'thanhtich.TEN_TT','doanvien_thanhnien.TEN_SV', 'chidoan.TEN_CD', 'khoa.TEN_KHOA', 'hocky.TEN_HK', 'namhoc.TEN_NH')
            ->get();
        }else if($request->session()->get('session_vt') == 2){
            $id_doankhoa = $request->session()->get('session_id_doankhoa');
            $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        // $thanhtich_thamgia = thanhtich_thamgia::all();
            $thanhtich_thamgia = DB::table('thanhtich_thamgia')
            ->join('pt_doankhoa', 'pt_doankhoa.ID', '=', 'thanhtich_thamgia.PT_DOANKHOA_ID')
            ->join('hocky', 'hocky.ID', '=', 'pt_doankhoa.HOCKY_ID')
            ->join('namhoc', 'namhoc.ID', '=', 'hocky.NAMHOC_ID')
            ->join('doanvien_thanhnien','doanvien_thanhnien.ID','=','thanhtich_thamgia.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('thanhtich', 'thanhtich.ID', '=', 'thanhtich_thamgia.THANHTICH_ID')
            ->where('pt_doankhoa.DOANKHOA_ID', '=', $id_doankhoa)
            ->select('thanhtich_thamgia.*','pt_doankhoa.TEN_PT_DK', 'thanhtich.TEN_TT','doanvien_thanhnien.TEN_SV', 'chidoan.TEN_CD', 'khoa.TEN_KHOA', 'hocky.TEN_HK', 'namhoc.TEN_NH')
            ->get();
        }

        return view('backend.thanhtich_thamgia.index')
        ->with('tt_tg', $thanhtich_thamgia);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pt_doankhoa = pt_doankhoa::all();
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $thanhtich_thamgia = thanhtich_thamgia::all();
        $thanhtich = thanhtich::all();
        return view('backend.thanhtich_thamgia.create')
        ->with ('dvtn', $doanvien_thanhnien)
        ->with ('tt', $thanhtich)
        ->with ('pt_dk', $pt_doankhoa);
    }


    public function index_getchidoan_tttg(Request $request){
        $khoa = khoa::all();
        $namhoc = namhoc::all();
        return view('backend.thanhtich_thamgia.index_getchidoan_tttg')
        ->with ('nh', $namhoc)
        ->with ('k', $khoa);
    }

    public function getchidoan_tttg(Request $request){
        $khoa = khoa::find($request->khoa);
        $namhoc = namhoc::find($request->namhoc);
        $hocky = hocky::where('NAMHOC_ID', '=', $namhoc->ID)->get();
        $chidoan = chidoan::where('DOANKHOA_ID', $request->session()->get('session_id_doankhoa') )
        ->where('KHOA_ID',$khoa->ID)
        ->get();
        $hocky = hocky::where('NAMHOC_ID', $namhoc->ID)->get();
        // dd($khoa);
        return view('backend.thanhtich_thamgia.index_getdoanvien_tttg')
        ->with ('hk', $hocky)
        ->with ('k', $khoa)
        ->with ('nh', $namhoc)
        ->with ('cd', $chidoan);
    }



    public function getdoanvien_tttg(Request $request)
    {
        $chidoan = chidoan::find($request->chidoan);
        // $khoa = khoa::find()
        // dd($chidoan);
        $hocky = hocky::find($request->hocky);
        $pt_doankhoa = pt_doankhoa::where('DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
        ->where('HOCKY_ID', '=', $hocky->ID)
        ->get();
        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID',$chidoan->ID)
        ->where('NGAYVAODOAN_SV','!=',null)
        ->get();
        // dd($doanvien_thanhnien);
        // $thanhtich_thamgia = thanhtich_thamgia::all();
        $thanhtich = thanhtich::all();
        return view('backend.thanhtich_thamgia.create')
        ->with ('cd', $chidoan)
        ->with ('hk', $hocky)
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('tt', $thanhtich)
        ->with ('pt_dk', $pt_doankhoa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thanhtich_thamgia = thanhtich_thamgia::where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('PT_DOANKHOA_ID', $request->tenpt_doankhoa)
        ->where('THANHTICH_ID', $request->tenthanhtich)
        ->where('DIENGIAI', $request->tendiengiai)
        ->first();
        $doanvien = $request->doanvien; 
        // dd($doanvien);
        if(!$thanhtich_thamgia)
        {
            foreach($doanvien as $dv){


                $thanhtich_thamgia = new thanhtich_thamgia();
                $thanhtich_thamgia->DIENGIAI = $request->tendiengiai;
                $thanhtich_thamgia->PT_DOANKHOA_ID = $request->tenpt_doankhoa;
                $thanhtich_thamgia->DOANVIEN_THANHNIEN_ID = $dv;
                $thanhtich_thamgia->THANHTICH_ID = $request->tenthanhtich;
                $thanhtich_thamgia->TAOMOI    = now();
                $thanhtich_thamgia->CAPNHAT   = null;
                $thanhtich_thamgia->save();
            }
            return redirect(route('thanhtich_thamgia.index'))
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
        $thanhtich_thamgia = thanhtich_thamgia::find($id);
        $pt_doankhoa = pt_doankhoa::all();
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $thanhtich = thanhtich::all();
        return view('backend.thanhtich_thamgia.edit')
        ->with('thanhtich_thamgia', $thanhtich_thamgia)
        ->with ('pt_dk', $pt_doankhoa)
        ->with ('dvtn', $doanvien_thanhnien)
        ->with('tt',$thanhtich);
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
        $thanhtich_thamgia = thanhtich_thamgia::find($id);
        $thanhtich_thamgia1 = thanhtich_thamgia::where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('PT_DOANKHOA_ID', $request->tenpt_doankhoa)
        ->where('THANHTICH_ID', $request->tenthanhtich)
        ->where('DIENGIAI', $request->tendiengiai)
        ->first();
        if(!$thanhtich_thamgia1)
        {
            $thanhtich_thamgia->DIENGIAI = $request->tendiengiai;
            $thanhtich_thamgia->PT_DOANKHOA_ID = $request->tenpt_doankhoa;
            $thanhtich_thamgia->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $thanhtich_thamgia->THANHTICH_ID = $request->tenthanhtich;
            $thanhtich_thamgia->CAPNHAT    = now();
            $thanhtich_thamgia->save();
            return redirect(route('thanhtich_thamgia.index'))
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

    public function bulkDeleteTTTG(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $thanhtich_thamgia = thanhtich_thamgia::find($id);
                $thanhtich_thamgia->delete();
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
