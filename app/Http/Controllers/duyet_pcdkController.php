<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phieuchi_dk;
use Session;

class duyet_pcdkController extends Controller
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
        $phieuchi_dk = phieuchi_dk::findOrFail($request->id);
        // dd($k, $k1);
        $phieuchi_dk->DUYET_PCDK = '1';
        $phieuchi_dk->save();

        Session::flash('capquyensuccess', 'Duyệt thành công^^');
        return redirect(route('phieuchi_dk.index'));
    }
    public function destroy($id)
    {
        //
    }
}
