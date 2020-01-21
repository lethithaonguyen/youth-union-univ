<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pt_chidoan;
use App\chidoan;
use App\loai_pt;
use App\hocky;
use App\namhoc;
use DB;

class pt_chidoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_chidoan = $request->session()->get('session_id_chidoan_sv');
        // dd($id_chidoan); 
        $ten_chidoan = $request->session()->get('session_ten_chidoan_sv');
        // $pt_chidoan = pt_chidoan::all();
        if($request->session()->has('session_id_chidoan_sv'))
        {
            $id_chidoan = $request->session()->get('session_id_chidoan_sv');
            $pt_chidoan = DB::table('pt_chidoan')
            ->join('chidoan', 'chidoan.ID', '=', 'pt_chidoan.CHIDOAN_ID')
            ->join('loai_pt', 'loai_pt.ID', '=', 'pt_chidoan.LOAI_PT_ID')
            ->join('hocky', 'hocky.ID', '=', 'pt_chidoan.HOCKY_ID')
            ->where('CHIDOAN_ID',$id_chidoan)
            ->select('pt_chidoan.*', 'chidoan.TEN_CD', 'loai_pt.TEN_LOAI_PT','hocky.TEN_HK')
            ->get();
        }
        else{
            $pt_chidoan = DB::table('pt_chidoan')
            ->join('chidoan', 'chidoan.ID', '=', 'pt_chidoan.CHIDOAN_ID')
            ->join('loai_pt', 'loai_pt.ID', '=', 'pt_chidoan.LOAI_PT_ID')
            ->join('hocky', 'hocky.ID', '=', 'pt_chidoan.HOCKY_ID')
            ->select('pt_chidoan.*', 'chidoan.TEN_CD', 'loai_pt.TEN_LOAI_PT','hocky.TEN_HK')
            ->get();
        }
        return view('backend.pt_chidoan.index')
        ->with('ptcd', $pt_chidoan);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_chidoan = $request->session()->get('session_id_chidoan_sv');
        // dd($id_chidoan); 
        $ten_chidoan = $request->session()->get('session_ten_chidoan_sv');
        $chidoan = chidoan::where('ID', $id_chidoan)->get();
        $loai_pt = loai_pt::all();
        $hocky = hocky::all();
        return view('backend.pt_chidoan.create')
        ->with ('cd', $chidoan)
        ->with ('lpt', $loai_pt)
        ->with ('hk', $hocky);
    }


    public function index_get_hocky_ptcd(){
        $namhoc = namhoc::all();
        return view('backend.pt_chidoan.index_get_hocky')
        ->with ('nh', $namhoc);
    }

    public function get_hocky_ptcd(Request $request){
        $namhoc = namhoc::find($request->namhoc);
        $id_chidoan = $request->session()->get('session_id_chidoan_sv');
        // dd($id_chidoan); 
        $ten_chidoan = $request->session()->get('session_ten_chidoan_sv');
        $chidoan = chidoan::where('ID', $id_chidoan)->get();
        // $chidoan = chidoan::all();
        $loai_pt = loai_pt::all();
        $hocky = hocky::where('NAMHOC_ID',$namhoc->ID)->get();
        return view('backend.pt_chidoan.create')
        ->with ('cd', $chidoan)
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
        $pt_chidoan = pt_chidoan::where('TEN_PT_CD', $request->tenpt_chidoan)
        ->where('CHIDOAN_ID', $request->tenchidoan)
        ->where('LOAI_PT_ID', $request->tenloai_pt)
        ->where('HOCKY_ID', $request->tenhocky)
        ->first();
        if(!$pt_chidoan)
        {
            $pt_chidoan = new pt_chidoan();
            $pt_chidoan->TEN_PT_CD = $request->tenpt_chidoan;
            $pt_chidoan->CHIDOAN_ID = $request->tenchidoan;
            $pt_chidoan->LOAI_PT_ID = $request->tenloai_pt;
            $pt_chidoan->HOCKY_ID = $request->tenhocky;
            $pt_chidoan->NGAY_BD_PT_CD = $request->ngaybd;
            $pt_chidoan->NGAY_KT_PT_CD = $request->ngaykt;
            $pt_chidoan->GHICHU_PT_CD = $request->ghichu;
            $pt_chidoan->TAOMOI    = now();
            $pt_chidoan->CAPNHAT   = null;
            $pt_chidoan->save();
            return redirect(route('pt_chidoan.index'))
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
        $pt_chidoan = pt_chidoan::find($id);
        $chidoan = chidoan::all();
        $loai_pt = loai_pt::all();
        $hocky = hocky::all();
        return view('backend.pt_chidoan.edit')
        ->with('pt_chidoan', $pt_chidoan)
        ->with ('cd', $chidoan)
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
        $pt_chidoan = pt_chidoan::find($id);
        $pt_chidoan1 = pt_chidoan::where('TEN_PT_CD', $request->tenpt_chidoan)
        ->where('CHIDOAN_ID', $request->tenchidoan)
        ->where('LOAI_PT_ID', $request->tenloai_pt)
        ->where('HOCKY_ID', $request->tenhocky)
        ->first();
        if(!$pt_chidoan1)
        {
            $pt_chidoan->TEN_PT_CD = $request->tenpt_chidoan;
            $pt_chidoan->CHIDOAN_ID = $request->tenchidoan;
            $pt_chidoan->LOAI_PT_ID = $request->tenloai_pt;
            $pt_chidoan->HOCKY_ID = $request->tenhocky;
            $pt_chidoan->NGAY_BD_PT_CD = $request->ngaybd;
            $pt_chidoan->NGAY_KT_PT_CD = $request->ngaykt;
            $pt_chidoan->GHICHU_PT_CD = $request->ghichu;
            $pt_chidoan->CAPNHAT    = now();
            $pt_chidoan->save();
            return redirect(route('pt_chidoan.index'))
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

    public function bulkDeletePTCD(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $pt_chidoan = pt_chidoan::find($id);
                $pt_chidoan->delete();
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
