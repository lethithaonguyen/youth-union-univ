<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loai_pt;

use DB;

class loai_ptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loai_pt = loai_pt::all();
        return view('backend.loai_pt.index')
        ->with('lpt', $loai_pt);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai_pt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loai_pt = loai_pt::where('TEN_LOAI_PT', $request->tenloai_pt)->first();
        if(!$loai_pt)
        {
            $loai_pt = new loai_pt();
            $loai_pt->TEN_LOAI_PT = $request->tenloai_pt;
            $loai_pt->TAOMOI    = now();
            $loai_pt->CAPNHAT   = null;
            $loai_pt->save();
            return redirect(route('loai_pt.index'))
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
        $loai_pt = loai_pt::find($id);

        return view('backend.loai_pt.edit')
        ->with('loai_pt', $loai_pt);
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
        $loai_pt = loai_pt::find($id);
        $loai_pt1 = loai_pt::where('TEN_LOAI_PT', $request->tenloai_pt)->first();
        if(!$loai_pt1)
        {
            $loai_pt->TEN_LOAI_PT = $request->tenloai_pt;
            $loai_pt->CAPNHAT    = now();
            $loai_pt->save();
            return redirect(route('loai_pt.index'))
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

    public function bulkDeleteLPT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $loai_pt = loai_pt::find($id);
                $loai_pt->delete();
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
