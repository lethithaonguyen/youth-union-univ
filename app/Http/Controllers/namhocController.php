<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\namhoc;

use DB;

class namhocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $namhoc = namhoc::all();
        return view('backend.namhoc.index')
        ->with('nh', $namhoc);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.namhoc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namhoc = namhoc::where('TEN_NH', $request->tennamhoc)->first();
        if(!$namhoc)
        {
            $namhoc = new namhoc();
            $namhoc->TEN_NH = $request->tennamhoc;
            $namhoc->TAOMOI    = now();
            $namhoc->CAPNHAT   = null;
            $namhoc->save();
            return redirect(route('namhoc.index'))
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
        $namhoc = namhoc::find($id);

        return view('backend.namhoc.edit')
        ->with('namhoc', $namhoc);
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
        $namhoc = namhoc::find($id);
        $namhoc1 = namhoc::where('TEN_NH', $request->tennamhoc)->first();
        if(!$namhoc1)
        {
            $namhoc->TEN_NH = $request->tennamhoc;
            $namhoc->CAPNHAT    = now();
            $namhoc->save();
            return redirect(route('namhoc.index'))
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

    public function bulkDeleteNH(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $namhoc = namhoc::find($id);
                $namhoc->delete();
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
