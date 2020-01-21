<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dv_tt_doan;
use App\doanvien_thanhnien;

use DB;

class dv_tt_doanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dv_tt_doan = DB::table('dv_tt_doan')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'dv_tt_doan.DOANVIEN_THANHNIEN_ID')
        ->select('dv_tt_doan.*', 'doanvien_thanhnien.TEN_SV')
        ->get();
        return view('backend.dv_tt_doan.index')
        ->with('dv_tt', $dv_tt_doan);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $doanvien_thanhnien = doanvien_thanhnien::join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('users.VAITRO_ID', '=', 2)
        ->get();
       // $dv_tt_doan = dv_tt_doan::all();
       return view('backend.dv_tt_doan.create')
       ->with ('dv_tn', $doanvien_thanhnien);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dv_tt_doan = dv_tt_doan::where('NGAYTTDOAN', $request->ngaydv_tt_doan)
        ->where('DOANVIEN_THANHNIEN_ID',$request->tendoanvien_thanhnien)
        ->first();
        if(!$dv_tt_doan)
        {
            $dv_tt_doan = new dv_tt_doan();
            $dv_tt_doan->NGAYTTDOAN = $request->ngaydv_tt_doan;
            $dv_tt_doan->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $dv_tt_doan->TAOMOI    = now();
            $dv_tt_doan->CAPNHAT   = null;
            $dv_tt_doan->save();
            return redirect(route('dv_tt_doan.index'))
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
        $dv_tt_doan = dv_tt_doan::find($id);
        $doanvien_thanhnien = doanvien_thanhnien::all();
        return view('backend.dv_tt_doan.edit')
        ->with('dv_tn', $doanvien_thanhnien)
        ->with('dv_tt_doan', $dv_tt_doan);
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
        $dv_tt_doan = dv_tt_doan::find($id);
        $dv_tt_doan1 = dv_tt_doan::where('NGAYTTDOAN', $request->ngaydv_tt_doan)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->first();
        if(!$dv_tt_doan1)
        {
            $dv_tt_doan->NGAYTTDOAN = $request->ngaydv_tt_doan;
            $dv_tt_doan->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $dv_tt_doan->CAPNHAT    = now();
            $dv_tt_doan->save();
            return redirect(route('dv_tt_doan.index'))
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

    public function bulkDeleteDV_TT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $dv_tt_doan = dv_tt_doan::find($id);
                $dv_tt_doan->delete();
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
