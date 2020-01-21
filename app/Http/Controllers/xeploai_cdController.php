<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\xeploai_cd;

use DB;

class xeploai_cdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xeploai_cd = xeploai_cd::all();
        return view('backend.xeploai_cd.index')
        ->with('xlcd', $xeploai_cd);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.xeploai_cd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $xeploai_cd = xeploai_cd::where('TEN_XLCD', $request->tenxeploai_cd)->first();
        if(!$xeploai_cd)
        {
            $xeploai_cd = new xeploai_cd();
            $xeploai_cd->TEN_XLCD = $request->tenxeploai_cd;
            $xeploai_cd->DIEMDAT_CD = $request->diemdat_cd;
            $xeploai_cd->TAOMOI    = now();
            $xeploai_cd->CAPNHAT   = null;
            $xeploai_cd->save();
            return redirect(route('xeploai_cd.index'))
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
        $xeploai_cd = xeploai_cd::find($id);

        return view('backend.xeploai_cd.edit')
        ->with('xeploai_cd', $xeploai_cd);
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
        $xeploai_cd = xeploai_cd::find($id);
        $xeploai_cd1 = xeploai_cd::where('TEN_XLCD', $request->tenxeploai_cd)->first();
        $xeploai_cd2 = xeploai_cd::where('DIEMDAT_CD', $request->diemdat_cd)->first();
        if(!$xeploai_cd1 || !$xeploai_cd2)
        {
            $xeploai_cd->TEN_XLCD = $request->tenxeploai_cd;
            $xeploai_cd->DIEMDAT_CD = $request->diemdat_cd;
            $xeploai_cd->CAPNHAT    = now();
            $xeploai_cd->save();
            return redirect(route('xeploai_cd.index'))
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

    public function bulkDeleteXLCD(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $xeploai_cd = xeploai_cd::find($id);
                $xeploai_cd->delete();
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
