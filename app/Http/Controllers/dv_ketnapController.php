<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dv_ketnap;
use App\doanvien_thanhnien;

use DB;

class dv_ketnapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dv_ketnap = DB::table('dv_ketnap')
        ->join('doanvien_thanhnien', 'doanvien_thanhnien.ID', '=', 'dv_ketnap.DOANVIEN_THANHNIEN_ID')
        ->select('dv_ketnap.*', 'doanvien_thanhnien.TEN_SV')
        ->get();
        return view('backend.dv_ketnap.index')
        ->with('dv_kn', $dv_ketnap);

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
       $dv_ketnap = dv_ketnap::all();
       return view('backend.dv_ketnap.create')
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
        $dv_ketnap = dv_ketnap::where('NGAYKETNAP', $request->ngaydv_ketnap)
        ->where('DOANVIEN_THANHNIEN_ID',$request->tendoanvien_thanhnien)
        ->first();
        if(!$dv_ketnap)
        {
            $dv_ketnap = new dv_ketnap();
            $dv_ketnap->NGAYKETNAP = $request->ngaydv_ketnap;
            $dv_ketnap->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $dv_ketnap->TAOMOI    = now();
            $dv_ketnap->CAPNHAT   = null;
            $dv_ketnap->save();
            return redirect(route('dv_ketnap.index'))
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
        $dv_ketnap = dv_ketnap::find($id);
        $doanvien_thanhnien = doanvien_thanhnien::all();
        return view('backend.dv_ketnap.edit')
        ->with('dv_tn', $doanvien_thanhnien)
        ->with('dv_ketnap', $dv_ketnap);
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
        $dv_ketnap = dv_ketnap::find($id);
        $dv_ketnap1 = dv_ketnap::where('NGAYKETNAP', $request->ngaydv_ketnap)
        ->where('DOANVIEN_THANHNIEN_ID', $request->tendoanvien_thanhnien)
        ->first();
        if(!$dv_ketnap1)
        {
            $dv_ketnap->NGAYKETNAP = $request->ngaydv_ketnap;
            $dv_ketnap->DOANVIEN_THANHNIEN_ID = $request->tendoanvien_thanhnien;
            $dv_ketnap->CAPNHAT    = now();
            $dv_ketnap->save();
            return redirect(route('dv_ketnap.index'))
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

    public function bulkDeleteDV_KN(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $dv_ketnap = dv_ketnap::find($id);
                $dv_ketnap->delete();
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
