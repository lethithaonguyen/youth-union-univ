<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tinh_thanhpho;

use DB;

class tinh_thanhphoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tinh_thanhpho = tinh_thanhpho::all();
        return view('backend.tinh_thanhpho.index')
        ->with('tp', $tinh_thanhpho);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tinh_thanhpho.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tinh_thanhpho = tinh_thanhpho::where('TEN_TP', $request->tentinh_thanhpho)->first();
        if(!$tinh_thanhpho)
        {
            $tinh_thanhpho = new tinh_thanhpho();
            $tinh_thanhpho->TEN_TP = $request->tentinh_thanhpho;
            $tinh_thanhpho->TAOMOI    = now();
            $tinh_thanhpho->CAPNHAT   = null;
            $tinh_thanhpho->save();
            return redirect(route('tinh_thanhpho.index'))
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
        $tinh_thanhpho = tinh_thanhpho::find($id);

        return view('backend.tinh_thanhpho.edit')
        ->with('tinh_thanhpho', $tinh_thanhpho);
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
        $tinh_thanhpho = tinh_thanhpho::find($id);
        $tinh_thanhpho1 = tinh_thanhpho::where('TEN_TP', $request->tentinh_thanhpho)->first();
        if(!$tinh_thanhpho1)
        {
            $tinh_thanhpho->TEN_TP = $request->tentinh_thanhpho;
            $tinh_thanhpho->CAPNHAT    = now();
            $tinh_thanhpho->save();
            return redirect(route('tinh_thanhpho.index'))
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

    public function bulkDeleteTP(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $tinh_thanhpho = tinh_thanhpho::find($id);
                $tinh_thanhpho->delete();
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
