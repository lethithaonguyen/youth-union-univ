<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qd_dv_ketnap;
use App\doanvien_thanhnien;
use Session;

class huyduyetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student_id = qd_dv_ketnap::join('dv_ketnap','dv_ketnap.ID','qd_dv_ketnap.DV_KETNAP_ID')
        ->where('qd_dv_ketnap.ID', $request->id)
        ->select('qd_dv_ketnap.DOANVIEN_THANHNIEN_ID','dv_ketnap.NGAYKETNAP')
        ->first();
        $qd_dv_ketnap = qd_dv_ketnap::findOrFail($request->id);
        // dd($k, $k1);
        $qd_dv_ketnap->DUYET_KN = null ;
        $qd_dv_ketnap->save();
        $capnhat = doanvien_thanhnien::find($student_id->DOANVIEN_THANHNIEN_ID);
        $capnhat->NGAYVAODOAN_SV = null;
        $capnhat->NOIVAODOAN_SV = null;
        $capnhat->save();
        Session::flash('capquyensuccess', 'Hủy duyệt thành công!!!');
        return redirect(route('qd_dv_ketnap.index'));
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
        Session::flash('deletesuccess', 'Xóa thành công!!!');
        return redirect(route('qd_dv_ketnap.index'));
    }

    
}
