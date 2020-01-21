<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chidoan;
use Session;

class huyduyet_cdController extends Controller
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
    //     $qd_dv_ketnap->DUYET_KN = null ;
    //     $qd_dv_ketnap->save();

    //     Session::flash('capquyensuccess', 'This is a message!');
    //     return redirect(route('qd_dv_ketnap.index'));
    // }

    // *
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response

    // public function destroy(Request $request)
    // {
    //     $qd_dv_ketnap = qd_dv_ketnap::findOrFail($request->id);
    //     $qd_dv_ketnap->delete();
    //     Session::flash('deletesuccess', 'This is a message!');
    //     return redirect(route('qd_dv_ketnap.index'));
    // }

    public function update(Request $request)
    {
        $chidoan = chidoan::findOrFail($request->id);
        // dd($k, $k1);
        $chidoan->DUYET_CD = null ;
        $chidoan->save();

        Session::flash('capquyensuccess', 'Hủy duyệt thành công!!!');
        if(Session::get('session_vt') == 1)
        {
          return redirect(route('chidoan.index'));  
      }elseif (Session::get('session_vt') == 2) {
          return redirect(route('index_doankhoa')); 
      }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $chidoan = chidoan::findOrFail($request->id);
        $chidoan->delete();
        Session::flash('deletesuccess', 'Xóa thành công!!!');
        if(Session::get('session_vt') == 1)
        {
          return redirect(route('chidoan.index'));  
      }elseif (Session::get('session_vt') == 2) {
          return redirect(route('index_doankhoa')); 
      }
      
  }
}
