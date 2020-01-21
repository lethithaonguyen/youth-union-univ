<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qd_dv_ketnap;
use App\dv_ketnap;
use App\doanvien_thanhnien;
use Session;

class duyetController extends Controller
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
        // dd($request->id);
        // $doanvien_kn = qd_dv_ketnap::join('dv_ketnap','dv_ketnap.ID','=','qd_dv_ketnap.DV_KETNAP_ID')
        // ->where('qd_dv_ketnap.ID', $request->id)
        // ->select('qd_dv_ketnap.DOANVIEN_THANHNIEN_ID', 'dv_ketnap.NGAYKETNAP')
        // ->get();
       
        // $doanvien_thanhnien = doanvien_thanhnien::find('')
        $qd_dv_ketnap = qd_dv_ketnap::findOrFail($request->id);
        // dd($k, $k1);
        $student_id = qd_dv_ketnap::join('dv_ketnap','dv_ketnap.ID','qd_dv_ketnap.DV_KETNAP_ID')
        ->where('qd_dv_ketnap.ID', $request->id)
        ->select('qd_dv_ketnap.DOANVIEN_THANHNIEN_ID','dv_ketnap.NGAYKETNAP')
        ->first();
// print_r($student_id);
        // dd($student_id);
        $qd_dv_ketnap->DUYET_KN = '1';
        $qd_dv_ketnap->save();

        $capnhat = doanvien_thanhnien::find($student_id->DOANVIEN_THANHNIEN_ID);
        $capnhat->NGAYVAODOAN_SV = $student_id->NGAYKETNAP;
        $capnhat->NOIVAODOAN_SV = 'Cần Thơ';
        $capnhat->save();

         //dd($student_id->DOANVIEN_THANHNIEN_ID);
         // $capnhat = 'update doanvien_thanhnien set doanvien_thanhnien.NGAYVAODOAN_SV = ' //+ $student_id->qd_dv_ketnap->NGAYKETNAP
         //  + "'2019/09/20'"
         //  + ' where ID = '+ $student_id->DOANVIEN_THANHNIEN_ID ;

// $capnhat = 
     

        Session::flash('capquyensuccess', 'Duyệt thành công^^');
        return redirect(route('qd_dv_ketnap.index'));
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
}
