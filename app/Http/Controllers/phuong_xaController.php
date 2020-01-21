<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phuong_xa;
use App\quan_huyen;

use App\tinh_thanhpho;


use DB;

class phuong_xaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phuong_xa = DB::table('phuong_xa')
        ->join('quan_huyen', 'quan_huyen.ID', '=', 'phuong_xa.QUAN_HUYEN_ID')


        ->select('phuong_xa.*', 'quan_huyen.TEN_QH')


        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->select('phuong_xa.*', 'quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP')


        ->get();
        return view('backend.phuong_xa.index')
        ->with('p_x', $phuong_xa);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quan_huyen =quan_huyen::all();
        $tinh_thanhpho = tinh_thanhpho::all();
        return view('backend.phuong_xa.create')
        ->with ('q_h', $quan_huyen)
        ->with ('tp', $tinh_thanhpho);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phuong_xa = phuong_xa::where('TEN_PX', $request->tenphuongxa)
        ->where('QUAN_HUYEN_ID', $request->tenquanhuyen)
        ->first();




        // $tinh_thanhpho =ti


        if(!$phuong_xa)
        {
            $phuong_xa = new phuong_xa();
            $phuong_xa->TEN_PX = $request->tenphuongxa;
            $phuong_xa->QUAN_HUYEN_ID = $request->tenquanhuyen;
            $phuong_xa->TAOMOI    = now();
            $phuong_xa->CAPNHAT   = null;
            $phuong_xa->save();
            return redirect(route('phuong_xa.index'))
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
        $phuong_xa = phuong_xa::find($id);
        $quan_huyen = quan_huyen::all();
        return view('backend.phuong_xa.edit')
        ->with('p_x', $phuong_xa)
        ->with('q_h', $quan_huyen);
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
        $phuong_xa = phuong_xa::find($id);
        $phuong_xa1 = phuong_xa::where('TEN_PX', $request->tenphuongxa)
        ->where('QUAN_HUYEN_ID', $request->tenquanhuyen)
        ->first();
        if(!$phuong_xa1)
        {
            $phuong_xa->TEN_PX = $request->tenphuongxa;
            $phuong_xa->QUAN_HUYEN_ID = $request->tenquanhuyen;
            $phuong_xa->CAPNHAT    = now();
            $phuong_xa->save();
            return redirect(route('phuong_xa.index'))
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

    public function bulkDeletePX(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $phuong_xa = phuong_xa::find($id);
                $phuong_xa->delete();
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
