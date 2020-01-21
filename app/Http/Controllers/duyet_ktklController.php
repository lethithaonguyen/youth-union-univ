<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chitiet_ktkl;
use Session;

class duyet_ktklController extends Controller
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
        $chitiet_ktkl = chitiet_ktkl::findOrFail($request->id);
        // dd($k, $k1);
        $chitiet_ktkl->DUYET_KTKL = '1';
        $chitiet_ktkl->save();

        Session::flash('capquyensuccess', 'Duyệt thành công^^');
        return redirect(route('chitiet_ktkl.index'));
    }
    public function destroy($id)
    {
        //
    }
}
