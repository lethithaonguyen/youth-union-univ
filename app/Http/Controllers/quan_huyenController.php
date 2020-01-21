<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\quan_huyen;
use App\tinh_thanhpho;

use DB;

class quan_huyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $quan_huyen = quan_huyen::all();
        $quan_huyen = DB::table('quan_huyen')
        ->join('tinh_thanhpho', 'tinh_thanhpho.ID', '=', 'quan_huyen.TINH_THANHPHO_ID')
        ->select('quan_huyen.*', 'tinh_thanhpho.TEN_TP')
        ->get();
        return view('backend.quan_huyen.index')
        ->with('q_h', $quan_huyen);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tinh_thanhpho = tinh_thanhpho::all();
        return view('backend.quan_huyen.create')
        ->with ('t_tp', $tinh_thanhpho);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quan_huyen = quan_huyen::where('TEN_QH', $request->tenquanhuyen)
        ->where('TINH_THANHPHO_ID', $request->tentinhthanhpho)
        ->first();
        if(!$quan_huyen)
        {
            $quan_huyen = new quan_huyen();
            $quan_huyen->TEN_QH = $request->tenquanhuyen;
            $quan_huyen->TINH_THANHPHO_ID = $request->tentinhthanhpho;
            $quan_huyen->TAOMOI    = now();
            $quan_huyen->CAPNHAT   = null;
            $quan_huyen->save();
            return redirect(route('quan_huyen.index'))
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
        $quan_huyen = quan_huyen::find($id);
        $tinh_thanhpho = tinh_thanhpho::all();
        return view('backend.quan_huyen.edit')
        ->with('q_h', $quan_huyen)
        ->with ('t_tp', $tinh_thanhpho);
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
        $quan_huyen = quan_huyen::find($id);
        $quan_huyen1 = quan_huyen::where('TEN_QH', $request->tenquanhuyen)
        ->where('TINH_THANHPHO_ID', $request->tentinhthanhpho)
        ->first();
        if(!$quan_huyen1)
        {
            $quan_huyen->TEN_QH = $request->tenquanhuyen;
            $quan_huyen->TINH_THANHPHO_ID = $request->tentinhthanhpho;
            $quan_huyen->CAPNHAT    = now();
            $quan_huyen->save();
            return redirect(route('quan_huyen.index'))
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

    public function bulkDeleteQH(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $quan_huyen = quan_huyen::find($id);
                $quan_huyen->delete();
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
