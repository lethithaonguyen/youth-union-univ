<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hocky;
use App\namhoc;

use DB;

class hockyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $hocky = hocky::all();
        $hocky = DB::table('hocky')
        ->join('namhoc', 'namhoc.ID', '=', 'hocky.NAMHOC_ID')
        ->select('hocky.*', 'namhoc.TEN_NH')
        ->get();
        return view('backend.hocky.index')
        ->with('hk', $hocky);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $namhoc = namhoc::all();
        $hocky = hocky::all();
        return view('backend.hocky.create')
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
        $hocky = hocky::where('TEN_HK', $request->tenhocky)
        ->where('NAMHOC_ID', $request->tennamhoc)
        ->first();
        if(!$hocky)
        {
            $hocky = new hocky();
            $hocky->TEN_HK = $request->tenhocky;
            $hocky->NAMHOC_ID = $request->tennamhoc;
            $hocky->TAOMOI    = now();
            $hocky->CAPNHAT   = null;
            $hocky->save();
            return redirect(route('hocky.index'))
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
        $hocky = hocky::find($id);
        $namhoc = namhoc::all();
        return view('backend.hocky.edit')
        ->with('hocky', $hocky)
        ->with ('nh', $namhoc);
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
        $hocky = hocky::find($id);
        $hocky1 = hocky::where('TEN_HK', $request->tenhocky)
        ->where('NAMHOC_ID', $request->tennamhoc)
        ->first();
        if(!$hocky1)
        {
            $hocky->TEN_HK = $request->tenhocky;
            $hocky->NAMHOC_ID = $request->tennamhoc;
            $hocky->CAPNHAT    = now();
            $hocky->save();
            return redirect(route('hocky.index'))
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

    public function bulkDeleteHK(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $hocky = hocky::find($id);
                $hocky->delete();
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
