<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\khenthuong_kyluat;
use App\chitiet_ktkl;
use App\chidoan;
use App\doankhoa;
use App\khoa;
use Session;

use DB;

class chitiet_ktklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('session_vt')==3){
            $chitiet_ktkl = DB::table('chitiet_ktkl')
            ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'chitiet_ktkl.DOANVIEN_THANHNIEN_ID')
            ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('doankhoa', 'doankhoa.ID', 'chidoan.DOANKHOA_ID')
            ->join('khenthuong_kyluat', 'khenthuong_kyluat.ID', '=', 'chitiet_ktkl.KHENTHUONG_KYLUAT_ID')
            ->where('chidoan.ID', $request->session()->get('session_id_chidoan_sv'))
            ->select('chitiet_ktkl.*', 'doanvien_thanhnien.TEN_SV', 'khenthuong_kyluat.TEN_KTKL','chidoan.TEN_CD','khoa.TEN_KHOA', 'doankhoa.TEN_DK')
            ->get();
            // dd($chitiet_ktkl);
        }else{
           $chitiet_ktkl = DB::table('chitiet_ktkl')
           ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'chitiet_ktkl.DOANVIEN_THANHNIEN_ID')
           ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
           ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
           ->join('doankhoa', 'doankhoa.ID', 'chidoan.DOANKHOA_ID')
           ->join('khenthuong_kyluat', 'khenthuong_kyluat.ID', '=', 'chitiet_ktkl.KHENTHUONG_KYLUAT_ID')
           ->select('chitiet_ktkl.*', 'doanvien_thanhnien.TEN_SV', 'khenthuong_kyluat.TEN_KTKL','chidoan.TEN_CD','khoa.TEN_KHOA', 'doankhoa.TEN_DK')
           ->get(); 
       }

       return view('backend.chitiet_ktkl.index')
       ->with('ct_ktkl', $chitiet_ktkl);

   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID',$request->session()->get('session_id_chidoan_sv'))->get();
        $khenthuong_kyluat = khenthuong_kyluat::all();
        return view('backend.chitiet_ktkl.create')
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('kt_kl', $khenthuong_kyluat);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $chitiet_ktkl = chitiet_ktkl::where('KHENTHUONG_KYLUAT_ID', $request->tenkhenthuong_kyluat)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('NGAYBATDAU',$request->tenngaybatdau)
        ->first();
        $doanvien = $request->doanvien;
        if(!$chitiet_ktkl)
        {
            foreach ($doanvien as $dv) {
               $chitiet_ktkl = new chitiet_ktkl();
               $chitiet_ktkl->DUYET_KTKL = $request->tenduyet;
               $chitiet_ktkl->DOANVIEN_THANHNIEN_ID = $dv;
               $chitiet_ktkl->KHENTHUONG_KYLUAT_ID = $request->tenkhenthuong_kyluat;
               $chitiet_ktkl->NOIDUNG_KTKL = $request->tennoidung;
               $chitiet_ktkl->NGAYBATDAU = $request->tenngaybatdau;
               $chitiet_ktkl->TAOMOI    = now();
               $chitiet_ktkl->CAPNHAT   = null;
               $chitiet_ktkl->save();
           }

           return redirect(route('chitiet_ktkl.index'))
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
        $chitiet_ktkl = chitiet_ktkl::find($id);
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $khenthuong_kyluat = khenthuong_kyluat::all();
        return view('backend.chitiet_ktkl.edit')
        ->with('chitiet_ktkl', $chitiet_ktkl)
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('kt_kl', $khenthuong_kyluat);
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
     $chitiet_ktkl = chitiet_ktkl::find($id);
     $chitiet_ktkl1 = chitiet_ktkl::where('KHENTHUONG_KYLUAT_ID', $request->tenkhenthuong_kyluat)
     ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
     ->where('NOIDUNG_KTKL',$request->tennoidung)
     ->where('NGAYBATDAU',$request->tenngaybatdau)
     ->first();
     if(!$chitiet_ktkl1)
     {
        $chitiet_ktkl->DUYET_KTKL = $request->tenduyet;
        $chitiet_ktkl->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
        $chitiet_ktkl->KHENTHUONG_KYLUAT_ID = $request->tenkhenthuong_kyluat;
        $chitiet_ktkl->NOIDUNG_KTKL = $request->tennoidung;
        $chitiet_ktkl->NGAYBATDAU = $request->tenngaybatdau;
        $chitiet_ktkl->CAPNHAT    = now();
        $chitiet_ktkl->save();
        return redirect(route('chitiet_ktkl.index'))
        ->with('success_message', 'Lưu thành công ^^');
    }
    else
    {
     return redirect()->back()
     ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
 }
}


public function huyduyet(Request $request){
    $chitiet_ktkl = chitiet_ktkl::findOrFail($request->id);
        // dd($k, $k1);
    $chitiet_ktkl->DUYET_KTKL = '1';
    $chitiet_ktkl->save();

    Session::flash('capquyensuccess', 'This is a message!');
    return redirect(route('backend.chitiet_ktkl.index'));

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $chitiet_ktkl = chitiet_ktkl::findOrFail($request->id);
        $chitiet_ktkl->delete();
        Session::flash('deletesuccess', 'This is a message!');
        return redirect(route('chitiet_ktkl.index'));
    }

}
