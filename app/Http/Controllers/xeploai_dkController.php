<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\xeploai_dk;

use DB;

class xeploai_dkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xeploai_dk = xeploai_dk::all();
        return view('backend.xeploai_dk.index')
        ->with('xldk', $xeploai_dk);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.xeploai_dk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $xeploai_dk = xeploai_dk::where('TEN_XLdk', $request->tenxeploai_dk)->first();
        if(!$xeploai_dk)
        {
            $xeploai_dk = new xeploai_dk();
            $xeploai_dk->TEN_XLDK = $request->tenxeploai_dk;
            $xeploai_dk->DIEMDAT_DK = $request->diemdat_dk;
            $xeploai_dk->TAOMOI    = now();
            $xeploai_dk->CAPNHAT   = null;
            $xeploai_dk->save();
            return redirect(route('xeploai_dk.index'))
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
        $xeploai_dk = xeploai_dk::find($id);

        return view('backend.xeploai_dk.edit')
        ->with('xeploai_dk', $xeploai_dk);
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
        $xeploai_dk = xeploai_dk::find($id);
        $xeploai_dk1 = xeploai_dk::where('TEN_XLDK', $request->tenxeploai_dk)->first();
        $xeploai_dk2 = xeploai_dk::where('DIEMDAT_DK', $request->diemdat_dk)->first();
        if(!$xeploai_dk1 || !$xeploai_dk2)
        {
            $xeploai_dk->TEN_XLDK = $request->tenxeploai_dk;
            $xeploai_dk->DIEMDAT_DK = $request->diemdat_dk;
            $xeploai_dk->CAPNHAT    = now();
            $xeploai_dk->save();
            return redirect(route('xeploai_dk.index'))
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

    public function bulkDeleteXLDK(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $xeploai_dk = xeploai_dk::find($id);
                $xeploai_dk->delete();
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
