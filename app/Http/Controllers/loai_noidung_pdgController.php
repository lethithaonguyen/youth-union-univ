<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loai_noidung_pdg;

use DB;

class loai_noidung_pdgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loai_noidung_pdg = loai_noidung_pdg::all();
        return view('backend.loai_noidung_pdg.index')
        ->with('loai_ndpdg', $loai_noidung_pdg);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai_noidung_pdg.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loai_noidung_pdg = loai_noidung_pdg::where('TEN_LOAI_NDPDG', $request->tenloai_noidung_pdg)->first();
        if(!$loai_noidung_pdg)
        {
            $loai_noidung_pdg = new loai_noidung_pdg();
            $loai_noidung_pdg->TEN_LOAI_NDPDG = $request->tenloai_noidung_pdg;
            $loai_noidung_pdg->TAOMOI    = now();
            $loai_noidung_pdg->CAPNHAT   = null;
            $loai_noidung_pdg->save();
            return redirect(route('loai_noidung_pdg.index'))
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
        $loai_noidung_pdg = loai_noidung_pdg::find($id);

        return view('backend.loai_noidung_pdg.edit')
        ->with('loai_noidung_pdg', $loai_noidung_pdg);
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
        $loai_noidung_pdg = loai_noidung_pdg::find($id);
        $loai_noidung_pdg1 = loai_noidung_pdg::where('TEN_LOAI_NDPDG', $request->tenloai_noidung_pdg)->first();
        if(!$loai_noidung_pdg1)
        {
            $loai_noidung_pdg->TEN_LOAI_NDPDG = $request->tenloai_noidung_pdg;
            $loai_noidung_pdg->CAPNHAT    = now();
            $loai_noidung_pdg->save();
            return redirect(route('loai_noidung_pdg.index'))
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

    public function bulkDeleteLNDPDG(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $loai_noidung_pdg = loai_noidung_pdg::find($id);
                $loai_noidung_pdg->delete();
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
