<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\thanhtich;

use DB;

class thanhtichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thanhtich = thanhtich::all();
        return view('backend.thanhtich.index')
        ->with('tt', $thanhtich);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.thanhtich.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thanhtich = thanhtich::where('TEN_TT', $request->tenthanhtich)->first();
        if(!$thanhtich)
        {
            $thanhtich = new thanhtich();
            $thanhtich->TEN_TT = $request->tenthanhtich;
            $thanhtich->TAOMOI    = now();
            $thanhtich->CAPNHAT   = null;
            $thanhtich->save();
            return redirect(route('thanhtich.index'))
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
        $thanhtich = thanhtich::find($id);

        return view('backend.thanhtich.edit')
        ->with('thanhtich', $thanhtich);
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
        $thanhtich = thanhtich::find($id);
        $thanhtich1 = thanhtich::where('TEN_TT', $request->tenthanhtich)->first();
        if(!$thanhtich1)
        {
            $thanhtich->TEN_TT = $request->tenthanhtich;
            $thanhtich->CAPNHAT    = now();
            $thanhtich->save();
            return redirect(route('thanhtich.index'))
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

    public function bulkDeleteTT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $thanhtich = thanhtich::find($id);
                $thanhtich->delete();
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
