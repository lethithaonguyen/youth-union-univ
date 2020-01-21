<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\xeploai_dv;

use DB;

class xeploai_dvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xeploai_dv = xeploai_dv::all();
        return view('backend.xeploai_dv.index')
        ->with('xldv', $xeploai_dv);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.xeploai_dv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $xeploai_dv = xeploai_dv::where('TEN_XLDV', $request->tenxeploai_dv)->first();
        if(!$xeploai_dv)
        {
            $xeploai_dv = new xeploai_dv();
            $xeploai_dv->TEN_XLDV = $request->tenxeploai_dv;
            $xeploai_dv->DIEMDAT_DV = $request->diemdat_dv;
            $xeploai_dv->TAOMOI    = now();
            $xeploai_dv->CAPNHAT   = null;
            $xeploai_dv->save();
            return redirect(route('xeploai_dv.index'))
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
        $xeploai_dv = xeploai_dv::find($id);

        return view('backend.xeploai_dv.edit')
        ->with('xeploai_dv', $xeploai_dv);
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
        $xeploai_dv = xeploai_dv::find($id);
        $xeploai_dv1 = xeploai_dv::where('TEN_XLDV', $request->tenxeploai_dv)->first();
        $xeploai_dv2 = xeploai_dv::where('DIEMDAT_DV', $request->diemdat_dv)->first();
        if(!$xeploai_dv1 || !$xeploai_dv2)
        {
            $xeploai_dv->TEN_XLDV = $request->tenxeploai_dv;
            $xeploai_dv->DIEMDAT_DV = $request->diemdat_dv;
            $xeploai_dv->CAPNHAT    = now();
            $xeploai_dv->save();
            return redirect(route('xeploai_dv.index'))
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

    public function bulkDeleteXLDV(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $xeploai_dv = xeploai_dv::find($id);
                $xeploai_dv->delete();
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
