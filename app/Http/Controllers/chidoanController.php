<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chidoan;
use App\doankhoa;
use App\khoa;

use DB;

class chidoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $chidoan = chidoan::all();
        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->where('DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
        ->select('chidoan.*', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA')
        ->get();
        return view('backend.chidoan.index')
        ->with('cd', $chidoan);

    }
    public function index_chidoan(Request $request)
    {

        // $chidoan_id = $request->session()->get('session_id_chidoan_sv');
        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->where('chidoan.ID',$request->session()->get('session_id_chidoan_sv'))
        ->select('chidoan.*', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA')
        ->get();
        return view('backend.chidoan.index')
        ->with('cd', $chidoan);

    }
    public function index_doankhoa(Request $request)
    {
        $khoa = khoa::all();
        $khoa_loc = khoa::orderBy('ID','asc')->first();
        // $chidoan = chidoan::all();
        $doankhoa = $request->session()->get('session_id_doankhoa');
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->where('DOANKHOA_ID',$doankhoa)
        ->select('chidoan.*', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA')
        ->get();
        return view('backend.chidoan.index')
        ->with('k',$khoa)
        ->with('k_l', $khoa_loc)
        ->with('cd', $chidoan)
        ->with('dk', $doankhoa)
        ->with('t_dk', $ten_doankhoa);

    }

    public function loc_chidoan(Request $request)
    {

        $khoa_loc = khoa::find($request->khoa);
        $khoa = khoa::all();
        $doankhoa = $request->session()->get('session_id_doankhoa');
        $ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->where('DOANKHOA_ID',$doankhoa)
        ->where('KHOA_ID',$khoa_loc->ID)
        ->select('chidoan.*', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA')
        ->get();
        return view('backend.chidoan.index')
        ->with('k',$khoa)
        ->with('k_l',$khoa_loc)
        ->with('cd', $chidoan)
        ->with('dk', $doankhoa)
        ->with('t_dk', $ten_doankhoa);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doankhoa = doankhoa::where('doankhoa.ID',$request->session()->get('session_id_doankhoa'))->get();
        $khoa = khoa::all();
        return view('backend.chidoan.create')
        ->with ('dk', $doankhoa)
        ->with ('k', $khoa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chidoan = chidoan::where('TEN_CD', $request->tenchidoan)
        ->where('DOANKHOA_ID', $request->tendoankhoa)
        ->where('KHOA_ID', $request->tenkhoa)
        ->first();
        
        if(!$chidoan)
        {
            $chidoan = new chidoan();
            $chidoan->TEN_CD = $request->tenchidoan;
            $chidoan->DOANKHOA_ID = $request->tendoankhoa;
            $chidoan->KHOA_ID = $request->tenkhoa;
            $chidoan->NGAY_THANHLAP = $request->ngaythanhlap;
            $chidoan->TAOMOI    = now();
            $chidoan->CAPNHAT   = null;
            $chidoan->save();
            return redirect(route('chidoan.index'))
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
    public function edit(Request $request, $id)
    {
        $chidoan = chidoan::find($id);
        // dd($chidoan);
        $doankhoa = doankhoa::where('doankhoa.ID',$request->session()->get('session_id_doankhoa'))->get();
        $khoa = khoa::all();
        return view('backend.chidoan.edit')
        ->with('chidoan', $chidoan)
        ->with ('dk', $doankhoa)
        ->with ('k', $khoa);
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
        $chidoan = chidoan::find($id);
        $chidoan1 = chidoan::where('TEN_CD', $request->tenchidoan)
        ->where('DOANKHOA_ID', $request->tendoankhoa)
        ->where('KHOA_ID', $request->tenkhoa)
        ->first();
        if(!$chidoan1)
        {
            $chidoan->TEN_CD = $request->tenchidoan;
            $chidoan->DOANKHOA_ID = $request->tendoankhoa;
            $chidoan->KHOA_ID = $request->tenkhoa;
            $chidoan->NGAY_THANHLAP = $request->ngaythanhlap;
            $chidoan->CAPNHAT    = now();
            $chidoan->save();
            return redirect(route('chidoan.index'))
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

    public function bulkDeleteCD(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $chidoan = chidoan::find($id);
                $chidoan->delete();
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
