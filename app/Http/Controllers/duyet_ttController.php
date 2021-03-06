<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qd_dv_ttdoan;
use App\doanvien_thanhnien;
use Session;

class duyet_ttController extends Controller
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
    // public function update(Request $request)
    // {
    //     $qd_dv_ketnap = qd_dv_ketnap::findOrFail($request->id);
    //     // dd($k, $k1);
    //     $qd_dv_ketnap->DUYET_KN = '1';
    //     $qd_dv_ketnap->save();

    //     Session::flash('capquyensuccess', 'This is a message!');
    //     return redirect(route('qd_dv_ketnap.index'));
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $student_id = qd_dv_ttdoan::join('dv_tt_doan','dv_tt_doan.ID','qd_dv_ttdoan.DV_TT_DOAN_ID')
        ->where('qd_dv_ttdoan.ID', $request->id)
        ->select('qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID','dv_tt_doan.NGAYTTDOAN')
        ->first();
        $qd_dv_ttdoan = qd_dv_ttdoan::findOrFail($request->id);
        // dd($k, $k1);
        $qd_dv_ttdoan->DUYET_TTD = '1';
        $qd_dv_ttdoan->save();

        $capnhat = doanvien_thanhnien::find($student_id->DOANVIEN_THANHNIEN_ID);
        $capnhat->NGAYTTDOAN_SV = $student_id->NGAYTTDOAN;
        $capnhat->save();

        Session::flash('capquyensuccess', 'Duyệt thành công^^');
        return redirect(route('qd_dv_ttdoan.index'));
    }
    public function destroy($id)
    {
        //
    }
}
