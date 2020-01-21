<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pt_doankhoa;
use App\doankhoa;
use App\loai_pt;
use App\hocky;
use App\namhoc;
use DB;

class pt_doankhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        // dd($id_doankhoa); 
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        // $pt_doankhoa = pt_doankhoa::all();
        if($request->session()->has('session_id_doankhoa'))
        {
                                // $pt_doankhoa = pt_doankhoa::all();
            $pt_doankhoa = DB::table('pt_doankhoa')
            ->join('doankhoa', 'doankhoa.ID', '=', 'pt_doankhoa.DOANKHOA_ID')
            ->join('loai_pt', 'loai_pt.ID', '=', 'pt_doankhoa.LOAI_PT_ID')
            ->join('hocky', 'hocky.ID', '=', 'pt_doankhoa.HOCKY_ID')
            ->join('namhoc', 'namhoc.ID', '=', 'hocky.NAMHOC_ID')
            ->where('DOANKHOA_ID', $id_doankhoa)
            ->select('pt_doankhoa.*', 'doankhoa.TEN_DK', 'loai_pt.TEN_LOAI_PT','hocky.TEN_HK', 'namhoc.TEN_NH')
            ->get();

            return view('backend.pt_doankhoa.index')
            ->with('ptdk', $pt_doankhoa);
        }
        else{
                    // $pt_doankhoa = pt_doankhoa::all();
            $pt_doankhoa = DB::table('pt_doankhoa')
            ->join('doankhoa', 'doankhoa.ID', '=', 'pt_doankhoa.DOANKHOA_ID')
            ->join('loai_pt', 'loai_pt.ID', '=', 'pt_doankhoa.LOAI_PT_ID')
            ->join('hocky', 'hocky.ID', '=', 'pt_doankhoa.HOCKY_ID')
            ->join('namhoc', 'namhoc.ID', '=', 'hocky.NAMHOC_ID')
             // ->where('DOANKHOA_ID', $id_doankhoa)
            ->select('pt_doankhoa.*', 'doankhoa.TEN_DK', 'loai_pt.TEN_LOAI_PT','hocky.TEN_HK', 'namhoc.TEN_NH')
            ->get();
            return view('backend.pt_doankhoa.index')
            ->with('ptdk', $pt_doankhoa);
        }

        // dd($pt_doankhoa);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        // dd($id_doankhoa); 
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        $doankhoa = doankhoa::where('ID', $id_doankhoa)->get();
        $loai_pt = loai_pt::all();
        $hocky = hocky::all();
        return view('backend.pt_doankhoa.create')
        ->with ('dk', $doankhoa)
        ->with ('lpt', $loai_pt)
        ->with ('hk', $hocky);
    }


    public function index_get_hocky_ptdk(){
        $namhoc = namhoc::all();
        return view('backend.pt_doankhoa.index_get_hocky')
        ->with ('nh', $namhoc);
    }

    public function get_hocky_ptdk(Request $request){
        $namhoc = namhoc::find($request->namhoc);
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        // dd($id_doankhoa); 
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        $doankhoa = doankhoa::where('ID', $id_doankhoa)->get();
        $loai_pt = loai_pt::all();
        $hocky = hocky::where('NAMHOC_ID',$namhoc->ID)->get();
        // $request->session()->put('id_namhoc',$namhoc->ID);
        // dd($namhoc->ID);
        return view('backend.pt_doankhoa.create')
        ->with ('dk', $doankhoa)
        ->with ('lpt', $loai_pt)
        ->with ('hk', $hocky)
        ->with ('nh', $namhoc);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pt_doankhoa = pt_doankhoa::where('TEN_PT_DK', $request->tenpt_doankhoa)
        ->where('DOANKHOA_ID', $request->tendoankhoa)
        ->where('LOAI_PT_ID', $request->tenloai_pt)
        ->where('HOCKY_ID', $request->tenhocky)
        ->first();
        if(!$pt_doankhoa)
        {
            $pt_doankhoa = new pt_doankhoa();
            $pt_doankhoa->TEN_PT_DK = $request->tenpt_doankhoa;
            $pt_doankhoa->DOANKHOA_ID = $request->tendoankhoa;
            $pt_doankhoa->LOAI_PT_ID = $request->tenloai_pt;
            $pt_doankhoa->HOCKY_ID = $request->tenhocky;
            $pt_doankhoa->NGAY_BD_PT_DK = $request->ngaybd;
            $pt_doankhoa->NGAY_KT_PT_DK = $request->ngaykt;
            $pt_doankhoa->GHICHU_PT_DK = $request->ghichu;
            $pt_doankhoa->TAOMOI    = now();
            $pt_doankhoa->CAPNHAT   = null;
            $pt_doankhoa->save();
            return redirect(route('pt_doankhoa.index'))
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
    public function edit(Request $request,$id)
    {
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        // dd($id_doankhoa); 
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        // $id_namhoc = $request->session()->get('id_namhoc');
        // dd($id_namhoc);
        // $doankhoa = doankhoa::where('ID', $id_doankhoa)->get();
        $pt_doankhoa = pt_doankhoa::find($id);
        $doankhoa = doankhoa::where('ID', $id_doankhoa)->get();
        // $doankhoa = doankhoa::all();
        $loai_pt = loai_pt::all();
        $hocky = hocky::where('ID', $pt_doankhoa->HOCKY_ID)->get();
        return view('backend.pt_doankhoa.edit')
        ->with('pt_doankhoa', $pt_doankhoa)
        ->with ('dk', $doankhoa)
        ->with ('lpt', $loai_pt)
        ->with ('hk', $hocky);
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
        $pt_doankhoa = pt_doankhoa::find($id);
        $pt_doankhoa1 = pt_doankhoa::where('TEN_PT_DK', $request->tenpt_doankhoa)
        ->where('DOANKHOA_ID', $request->tendoankhoa)
        ->where('LOAI_PT_ID', $request->tenloai_pt)
        ->where('HOCKY_ID', $request->tenhocky)
        ->first();
        if(!$pt_doankhoa1)
        {
            $pt_doankhoa->TEN_PT_DK = $request->tenpt_doankhoa;
            $pt_doankhoa->DOANKHOA_ID = $request->tendoankhoa;
            $pt_doankhoa->LOAI_PT_ID = $request->tenloai_pt;
            $pt_doankhoa->HOCKY_ID = $request->tenhocky;
            $pt_doankhoa->NGAY_BD_PT_DK = $request->ngaybd;
            $pt_doankhoa->NGAY_KT_PT_DK = $request->ngaykt;
            $pt_doankhoa->GHICHU_PT_DK = $request->ghichu;
            $pt_doankhoa->CAPNHAT    = now();
            $pt_doankhoa->save();
            return redirect(route('pt_doankhoa.index'))
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

    public function bulkDeletePTDK(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $pt_doankhoa = pt_doankhoa::find($id);
                $pt_doankhoa->delete();
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
