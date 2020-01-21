<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\noidung_pdg;
use App\kieu_dulieu;
use App\loai_noidung_pdg;

use DB;

class noidung_pdgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $noidung_pdg = noidung_pdg::all();
        $noidung_pdg = DB::table('noidung_pdg')
        ->join('kieu_dulieu', 'kieu_dulieu.ID', '=', 'noidung_pdg.KIEU_DULIEU_ID')
        ->join('loai_noidung_pdg', 'loai_noidung_pdg.ID', '=', 'noidung_pdg.LOAI_NOIDUNG_PDG_ID')
        ->select('noidung_pdg.*', 'kieu_dulieu.TEN_KIEU_DULIEU', 'loai_noidung_pdg.TEN_LOAI_NDPDG')
        ->get();
        return view('backend.noidung_pdg.index')
        ->with('ndpdg', $noidung_pdg);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noidung_pdg_cha = noidung_pdg::all();
        $kieu_dulieu = kieu_dulieu::all();
        $loai_noidung_pdg = loai_noidung_pdg::all();
        return view('backend.noidung_pdg.create')
        ->with ('kdl', $kieu_dulieu)
        ->with ('ndpdg_cha', $noidung_pdg_cha)
        ->with ('lnd', $loai_noidung_pdg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noidung_pdg = noidung_pdg::where('TEN_NDPDG', $request->tennoidung_pdg)
        ->where('NOIDUNG_PDG_ID_CHA', $request->tennoidung_pdg_cha)
        ->where('KIEU_DULIEU_ID', $request->tenkieu_dulieu)
        ->where('LOAI_NOIDUNG_PDG_ID', $request->tenloai_noidung_pdg)
        ->first();
        if(!$noidung_pdg)
        {
            $noidung_pdg = new noidung_pdg();
            $noidung_pdg->TEN_NDPDG = $request->tennoidung_pdg;
            $noidung_pdg->NOIDUNG_PDG_ID_CHA = $request->tennoidung_pdg_cha;
            $noidung_pdg->KIEU_DULIEU_ID = $request->tenkieu_dulieu;
            $noidung_pdg->LOAI_NOIDUNG_PDG_ID = $request->tenloai_noidung_pdg;
            $noidung_pdg->NOIDUNG_PDG = $request->noidung_ndpdg;
            $noidung_pdg->DIEMTOIDA_NDPDG = $request->tendiemtoida_ndpdg;
            $noidung_pdg->TAOMOI    = now();
            $noidung_pdg->CAPNHAT   = null;
            $noidung_pdg->save();
            return redirect(route('noidung_pdg.index'))
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
        $noidung_pdg = noidung_pdg::find($id);
        $noidung_pdg_cha = noidung_pdg::all();
        $kieu_dulieu = kieu_dulieu::all();
        $loai_noidung_pdg = loai_noidung_pdg::all();
        return view('backend.noidung_pdg.edit')
        ->with('noidung_pdg', $noidung_pdg)
        ->with('ndpdg_cha', $noidung_pdg_cha)
        ->with ('kdl', $kieu_dulieu)
        ->with ('lnd', $loai_noidung_pdg);
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
        $noidung_pdg = noidung_pdg::find($id);
        $noidung_pdg1 = noidung_pdg::where('TEN_NDPDG', $request->tennoidung_pdg)
        ->where('NOIDUNG_PDG_ID_CHA', $request->tennoidung_pdg_cha)
        ->where('KIEU_DULIEU_ID', $request->tenkieu_dulieu)
        ->where('LOAI_NOIDUNG_PDG_ID', $request->tenloai_noidung_pdg)
        ->first();
        if(!$noidung_pdg1)
        {
            $noidung_pdg->TEN_NDPDG = $request->tennoidung_pdg;
            $noidung_pdg->NOIDUNG_PDG_ID_CHA = $request->tennoidung_pdg_cha;
            $noidung_pdg->KIEU_DULIEU_ID = $request->tenkieu_dulieu;
            $noidung_pdg->LOAI_NOIDUNG_PDG_ID = $request->tenloai_noidung_pdg;
            $noidung_pdg->NOIDUNG_PDG = $request->noidung_pdg;
            $noidung_pdg->DIEMTOIDA_NDPDG = $request->tendiemtoida_ndpdg;
            $noidung_pdg->CAPNHAT    = now();
            $noidung_pdg->save();
            return redirect(route('noidung_pdg.index'))
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

    public function bulkDeleteNDPDG(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $noidung_pdg = noidung_pdg::find($id);
                $noidung_pdg->delete();
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
