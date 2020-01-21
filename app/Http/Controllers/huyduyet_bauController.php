<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chitiet_bau_ut;
use Session;

class huyduyet_bauController extends Controller
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
        $chitiet_bau_ut = chitiet_bau_ut::findOrFail($request->id);
        // dd($k, $k1);
        $chitiet_bau_ut->DUYET_BAU = null ;
        $chitiet_bau_ut->save();

        Session::flash('capquyensuccess', 'Hủy duyệt thành công!!!');
        return redirect(route('chitiet_bau_ut.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $chitiet_bau_ut = chitiet_bau_ut::findOrFail($request->id);
        $chitiet_bau_ut->delete();
        Session::flash('deletesuccess', 'Xóa thành công!!!');
        return redirect(route('chitiet_bau_ut.index'));
    }

    
}
