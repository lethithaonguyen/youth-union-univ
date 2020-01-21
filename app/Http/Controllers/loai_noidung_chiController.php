<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loai_noidung_chi;

use DB;

class loai_noidung_chiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loai_noidung_chi = loai_noidung_chi::all();
        return view('backend.loai_noidung_chi.index')
        ->with('loai_ndc', $loai_noidung_chi);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai_noidung_chi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loai_noidung_chi = loai_noidung_chi::where('TEN_LOAI_DP', $request->tenloai_noidung_chi)->first();
        if(!$loai_noidung_chi)
        {
            $loai_noidung_chi = new loai_noidung_chi();
            $loai_noidung_chi->TEN_LOAI_DP = $request->tenloai_noidung_chi;
            $loai_noidung_chi->TAOMOI    = now();
            $loai_noidung_chi->CAPNHAT   = null;
            $loai_noidung_chi->save();
            return redirect(route('loai_noidung_chi.index'))
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
        $loai_noidung_chi = loai_noidung_chi::find($id);

        return view('backend.loai_noidung_chi.edit')
        ->with('loai_noidung_chi', $loai_noidung_chi);
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
        $loai_noidung_chi = loai_noidung_chi::find($id);
        $loai_noidung_chi1 = loai_noidung_chi::where('TEN_LOAI_DP', $request->tenloai_noidung_chi)->first();
        if(!$loai_noidung_chi1)
        {
            $loai_noidung_chi->TEN_LOAI_DP = $request->tenloai_noidung_chi;
            $loai_noidung_chi->CAPNHAT    = now();
            $loai_noidung_chi->save();
            return redirect(route('loai_noidung_chi.index'))
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

    public function bulkDeleteLNDC(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $loai_noidung_chi = loai_noidung_chi::find($id);
                $loai_noidung_chi->delete();
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
