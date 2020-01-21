<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kieu_dulieu;

use DB;

class kieu_dulieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kieu_dulieu = kieu_dulieu::all();
        return view('backend.kieu_dulieu.index')
        ->with('kdl', $kieu_dulieu);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kieu_dulieu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kieu_dulieu = kieu_dulieu::where('TEN_KIEU_DULIEU', $request->tenkieu_dulieu)->first();
        if(!$kieu_dulieu)
        {
            $kieu_dulieu = new kieu_dulieu();
            $kieu_dulieu->TEN_KIEU_DULIEU = $request->tenkieu_dulieu;
            $kieu_dulieu->TAOMOI    = now();
            $kieu_dulieu->CAPNHAT   = null;
            $kieu_dulieu->save();
            return redirect(route('kieu_dulieu.index'))
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
        $kieu_dulieu = kieu_dulieu::find($id);

        return view('backend.kieu_dulieu.edit')
        ->with('kieu_dulieu', $kieu_dulieu);
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
        $kieu_dulieu = kieu_dulieu::find($id);
        $kieu_dulieu1 = kieu_dulieu::where('TEN_KIEU_DULIEU', $request->tenkieu_dulieu)->first();
        if(!$kieu_dulieu1)
        {
            $kieu_dulieu->TEN_KIEU_DULIEU = $request->tenkieu_dulieu;
            $kieu_dulieu->CAPNHAT    = now();
            $kieu_dulieu->save();
            return redirect(route('kieu_dulieu.index'))
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

    public function bulkDeleteKDL(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $kieu_dulieu = kieu_dulieu::find($id);
                $kieu_dulieu->delete();
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
