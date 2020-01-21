<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mauphieu;

use DB;

class mauphieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mauphieu = mauphieu::all();
        return view('backend.mauphieu.index')
        ->with('mp', $mauphieu);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.mauphieu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mauphieu = mauphieu::where('TEN_MP', $request->tenmauphieu)->first();
        if(!$mauphieu)
        {
            $mauphieu = new mauphieu();
            $mauphieu->TEN_MP = $request->tenmauphieu;
            $mauphieu->TAOMOI    = now();
            $mauphieu->CAPNHAT   = null;
            $mauphieu->save();
            return redirect(route('mauphieu.index'))
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
        $mauphieu = mauphieu::find($id);

        return view('backend.mauphieu.edit')
        ->with('mauphieu', $mauphieu);
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
        $mauphieu = mauphieu::find($id);
        $mauphieu1 = mauphieu::where('TEN_MP', $request->tenmauphieu)->first();
        if(!$mauphieu1)
        {
            $mauphieu->TEN_MP = $request->tenmauphieu;
            $mauphieu->CAPNHAT    = now();
            $mauphieu->save();
            return redirect(route('mauphieu.index'))
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

    public function bulkDeleteMP(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $mauphieu = mauphieu::find($id);
                $mauphieu->delete();
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
