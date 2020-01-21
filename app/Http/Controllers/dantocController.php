<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dantoc;

use DB;

class dantocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dantoc = dantoc::all();
        return view('backend.dantoc.index')
        ->with('dt', $dantoc);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.dantoc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dantoc = dantoc::where('TEN_dt', $request->tendantoc)->first();
        if(!$dantoc)
        {
            $dantoc = new dantoc();
            $dantoc->TEN_dt = $request->tendantoc;
            $dantoc->TAOMOI    = now();
            $dantoc->CAPNHAT   = null;
            $dantoc->save();
            return redirect(route('dantoc.index'))
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
        $dantoc = dantoc::find($id);

        return view('backend.dantoc.edit')
        ->with('dantoc', $dantoc);
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
        $dantoc = dantoc::find($id);
        $dantoc1 = dantoc::where('TEN_dt', $request->tendantoc)->first();
        if(!$dantoc1)
        {
            $dantoc->TEN_dt = $request->tendantoc;
            $dantoc->CAPNHAT    = now();
            $dantoc->save();
            return redirect(route('dantoc.index'))
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

    public function bulkDeleteDT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $dantoc = dantoc::find($id);
                $dantoc->delete();
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
