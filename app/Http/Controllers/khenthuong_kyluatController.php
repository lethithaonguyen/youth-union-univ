<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\khenthuong_kyluat;
use App\hinhthuc_ktkl;
use App\loai_ktkl;
use App\chidoan;
use App\doankhoa;
use DB;

class khenthuong_kyluatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $khenthuong_kyluat = khenthuong_kyluat::all();
        $khenthuong_kyluat = DB::table('khenthuong_kyluat')
        ->join('doanvien_thanhnien','doanvien_thanhnien.ID','=','khenthuong_kyluat.DOANVIEN_THANHNIEN_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('hinhthuc_ktkl', 'hinhthuc_ktkl.ID', '=', 'khenthuong_kyluat.HINHTHUC_KTKL_ID')
        ->join('loai_ktkl', 'loai_ktkl.ID', '=', 'khenthuong_kyluat.LOAI_KTKL_ID')
        ->where('doankhoa.ID',$request->session()->get('session_id_doankhoa'))
        ->select('khenthuong_kyluat.*', 'hinhthuc_ktkl.TEN_HT', 'loai_ktkl.TEN_LOAIKTKL','doanvien_thanhnien.TEN_SV', 'chidoan.TEN_CD', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA')
        ->get();
        return view('backend.khenthuong_kyluat.index')
        ->with('ktkl', $khenthuong_kyluat);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hinhthuc_ktkl = hinhthuc_ktkl::all();
        $loai_ktkl = loai_ktkl::all();
        $doanvien_thanhnien = doanvien_thanhnien::join('users','users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->where('doankhoa.ID',$request->session()->get('session_id_doankhoa'))
        ->where('users.VAITRO_ID', '=', 2)
        ->get()
        ;
        return view('backend.khenthuong_kyluat.create')
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('ht_ktkl', $hinhthuc_ktkl)
        ->with ('lktkl', $loai_ktkl);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $khenthuong_kyluat = khenthuong_kyluat::where('TEN_KTKL', $request->tenkhenthuong_kyluat)
        ->where('HINHTHUC_KTKL_ID', $request->tenhinhthuc_ktkl)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->where('LOAI_KTKL_ID', $request->tenloai_ktkl)
        ->first();
        if(!$khenthuong_kyluat)
        {
            $khenthuong_kyluat = new khenthuong_kyluat();
            $khenthuong_kyluat->TEN_KTKL = $request->tenkhenthuong_kyluat;
            $khenthuong_kyluat->HINHTHUC_KTKL_ID = $request->tenhinhthuc_ktkl;
            $khenthuong_kyluat->LOAI_KTKL_ID = $request->tenloai_ktkl;
            $khenthuong_kyluat->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $khenthuong_kyluat->TAOMOI    = now();
            $khenthuong_kyluat->CAPNHAT   = null;
            $khenthuong_kyluat->save();
            return redirect(route('khenthuong_kyluat.index'))
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
        $khenthuong_kyluat = khenthuong_kyluat::find($id);
        $hinhthuc_ktkl = hinhthuc_ktkl::all();
        $loai_ktkl = loai_ktkl::all();
        $doanvien_thanhnien = doanvien_thanhnien::all();
        return view('backend.khenthuong_kyluat.edit')
        ->with('khenthuong_kyluat', $khenthuong_kyluat)
        ->with ('ht_ktkl', $hinhthuc_ktkl)
        ->with ('dv_tn', $doanvien_thanhnien)
        ->with ('lktkl', $loai_ktkl);
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
        $khenthuong_kyluat = khenthuong_kyluat::find($id);
        $khenthuong_kyluat1 = khenthuong_kyluat::where('TEN_KTKL', $request->tenkhenthuong_kyluat)
        ->where('HINHTHUC_KTKL_ID', $request->tenhinhthuc_ktkl)
        ->where('LOAI_KTKL_ID', $request->tenloai_ktkl)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->first();
        if(!$khenthuong_kyluat1)
        {
            $khenthuong_kyluat->TEN_KTKL = $request->tenkhenthuong_kyluat;
            $khenthuong_kyluat->HINHTHUC_KTKL_ID = $request->tenhinhthuc_ktkl;
            $khenthuong_kyluat->LOAI_KTKL_ID = $request->tenloai_ktkl;
            $khenthuong_kyluat->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $khenthuong_kyluat->CAPNHAT    = now();
            $khenthuong_kyluat->save();
            return redirect(route('khenthuong_kyluat.index'))
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

    public function bulkDeleteKTKL(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $khenthuong_kyluat = khenthuong_kyluat::find($id);
                $khenthuong_kyluat->delete();
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
