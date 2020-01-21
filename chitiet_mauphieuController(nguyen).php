<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chitiet_mauphieu;
use App\mauphieu;
use App\noidung_pdg;
use App\loai_noidung_pdg;
use DB;

class chitiet_mauphieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mauphieu = mauphieu::all();
        $chitiet_mauphieu = DB::table('chitiet_mauphieu')
        ->join('mauphieu', 'mauphieu.ID', '=', 'chitiet_mauphieu.MAUPHIEU_ID')
        ->join('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
        ->select('chitiet_mauphieu.*', 'mauphieu.*', 'noidung_pdg.*')
        ->get();
        return view('backend.chitiet_mauphieu.index')
        ->with('ct_mp', $chitiet_mauphieu)
        ->with('mp', $mauphieu);

    }


    public function index_get_noidung()
    {
        $loai_noidung_pdg = loai_noidung_pdg::all();
        return view('backend.chitiet_mauphieu.index_get_noidung')
        ->with('l_nd_pdg', $loai_noidung_pdg);

    }

        public function get_noidung(Request $request)
    {
        $loai_noidung_pdg = loai_noidung_pdg::find($request->loai);

        $mauphieu = mauphieu::all();
        $noidung_pdg = noidung_pdg::where('LOAI_NOIDUNG_PDG_ID',$loai_noidung_pdg->ID)->get();
        return view('backend.chitiet_mauphieu.create')
        ->with ('mp', $mauphieu)
        ->with ('nd_pdg', $noidung_pdg)
        ->with('l_nd_pdg', $loai_noidung_pdg);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $mauphieu1 = mauphieu::find($request->mauphieu);
        $mauphieu = mauphieu::all();
        $noidung_pdg = noidung_pdg::all();
        return view('backend.chitiet_mauphieu.create')
        ->with ('mp', $mauphieu)
        ->with ('nd_pdg', $noidung_pdg);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noidung_pdg = $request->noidung_pdg;
        $i = 1;
        $chitiet_mauphieu_1 = chitiet_mauphieu::where('MAUPHIEU_ID', $request->mauphieu)->where('NOIDUNG_PDG_ID',$request->noidung_pdg)->first();
        $max_offset = chitiet_mauphieu::where('MAUPHIEU_ID',$request->mauphieu)->max('THUTU_NOIDUNG');

            // dd('chao Nguyen max='.$max_offset.' cua phieu'. $request->mauphieu);
        if (!$chitiet_mauphieu_1) {
          foreach ($noidung_pdg as $nd_pdg){
            $chitiet_mauphieu = new chitiet_mauphieu();
            $chitiet_mauphieu->MAUPHIEU_ID = $request->mauphieu;
            $chitiet_mauphieu->NOIDUNG_PDG_ID = $nd_pdg;
            if($max_offset == null){
                $chitiet_mauphieu->THUTU_NOIDUNG = $i;
            }else{
                $chitiet_mauphieu->THUTU_NOIDUNG = $i + $max_offset;
            }

            $i++;
            $chitiet_mauphieu->save();

        }
            // return redirect("update_mau_phieu/{$id}/edit")
        return redirect(route('chitiet_mauphieu.index'))
        ->with('success_message', 'Lưu thành công ^^');
    }
    else{
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
        $chitiet_mauphieu = chitiet_mauphieu::find($id);
        // dd($chitiet_mauphieu);
        $mauphieu = mauphieu::all();
        $noidung_pdg = noidung_pdg::all();
        return view('backend.chitiet_mauphieu.edit')
        ->with('ct_mp', $chitiet_mauphieu)
        ->with ('mp', $mauphieu)
        ->with ('nd_pdg', $noidung_pdg);
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
        $chitiet_mauphieu = chitiet_mauphieu::find($id);
        // $chitiet_mauphieu1 = chitiet_mauphieu::where('NGAYBD_CV', $request->tenchitiet_mauphieu)
        // ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        // ->where('CHUCVU_DV_ID', $request->tenchucvu_dv)
        // ->first();
        // if(!$chitiet_mauphieu1)
        // {
            // $chitiet_mauphieu->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            // $chitiet_mauphieu->CHUCVU_DV_ID = $request->tenchucvu_dv;
            // $chitiet_mauphieu->NGAYBD_CV = $request->ngaybd;
        $chitiet_mauphieu->THUTU_NOIDUNG = $request->thutu;
        $chitiet_mauphieu->CAPNHAT    = now();
        $chitiet_mauphieu->save();
        return redirect(route('chitiet_mauphieu.index'))
        ->with('success_message', 'Lưu thành công ^^');
     //    }
     //    else
     //    {
     //     return redirect()->back()
     //     ->with('error_message', 'Dữ liệu bị trùng xin nhập lại!!!');
     // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $chitiet_mauphieu = chitiet_mauphieu::find($id);
            $chitiet_mauphieu->delete();
            session()->flash('flash_mesage','Xóa dữ liệu thành công');
            return redirect(route('chitiet_mauphieu.index'));
        }
        catch(QueryException $ex)
        {
            return response([
                'error' => true, 'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function bulkDeleteCT_MP(Request $request)
    {
     try {
        $all_data = $request->except('_token');
        foreach($all_data['id'] as $id) {

            $chitiet_mauphieu = chitiet_mauphieu::whereNotNull($id);
            $chitiet_mauphieu->delete();
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
