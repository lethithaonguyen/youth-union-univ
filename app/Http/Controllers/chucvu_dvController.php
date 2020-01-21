<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chucvu_dv;

use DB;

class chucvu_dvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chucvu_dv = chucvu_dv::all();
        return view('backend.chucvu_dv.index')
        ->with('cvdv', $chucvu_dv);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.chucvu_dv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chucvu_dv = chucvu_dv::where('TEN_CHUCVU', $request->tenchucvu_dv)->first();
        if(!$chucvu_dv)
        {
            $chucvu_dv = new chucvu_dv();
            $chucvu_dv->TEN_CHUCVU = $request->tenchucvu_dv;
            $chucvu_dv->TAOMOI    = now();
            $chucvu_dv->CAPNHAT   = null;
            $chucvu_dv->save();
            return redirect(route('chucvu_dv.index'))
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
        $chucvu_dv = chucvu_dv::find($id);

        return view('backend.chucvu_dv.edit')
        ->with('chucvu_dv', $chucvu_dv);
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
        $chucvu_dv = chucvu_dv::find($id);
        $chucvu_dv1 = chucvu_dv::where('TEN_CHUCVU', $request->tenchucvu_dv)->first();
        if(!$chucvu_dv1)
        {
            $chucvu_dv->TEN_CHUCVU = $request->tenchucvu_dv;
            $chucvu_dv->CAPNHAT    = now();
            $chucvu_dv->save();
            return redirect(route('chucvu_dv.index'))
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

    public function bulkDeleteCVDV(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $chucvu_dv = chucvu_dv::find($id);
                $chucvu_dv->delete();
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
