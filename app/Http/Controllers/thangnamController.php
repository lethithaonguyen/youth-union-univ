<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\thangnam;
use App\namhoc;

use DB;

class thangnamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $thangnam = thangnam::all();
        $thangnam = DB::table('thangnam')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->select('thangnam.*', 'namhoc.TEN_NH')
        ->get();
        $namhoc = namhoc::all();
        return view('backend.thangnam.index')
        ->with('nh', $namhoc)
        ->with('tn', $thangnam);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $namhoc = namhoc::all();
        return view('backend.thangnam.create')
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
        // $i = 1;
        $thangnam1 = thangnam::where('THANGNAM', $request->tenthangnam)
        ->where('NAMHOC_ID', $request->namhoc)
        ->where('SOTIEN_DOANPHI', $request->sotiendoanphi)
        ->first();
        if(!$thangnam1){
            for ($i=1; $i<13; $i++) 
            {
                $thangnam = new thangnam();
                $thangnam->THANGNAM = "tháng ".$i;
                $thangnam->NAMHOC_ID = $request->namhoc;
                $thangnam->SOTIEN_DOANPHI = $request->sotiendoanphi;
                $thangnam->save();
            }
            return redirect(route('thangnam.index'))
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
        $thangnam = thangnam::find($id);
        $namhoc = namhoc::all();
        return view('backend.thangnam.edit')
        ->with('tn', $thangnam)
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
        $thangnam = thangnam::find($id);
        $thangnam1 = thangnam::where('THANGNAM', $request->tenthangnam)
        ->where('NAMHOC_ID', $request->namhoc)
        ->where('SOTIEN_DOANPHI', $request->sotiendoanphi)
        ->first();
        if(!$thangnam1)
        {
            $thangnam->THANGNAM = $request->tenthangnam;
            $thangnam->NAMHOC_ID = $request->namhoc;
            $thangnam->SOTIEN_DOANPHI = $request->sotiendoanphi;
            $thangnam->CAPNHAT    = now();
            $thangnam->save();
            return redirect(route('thangnam.index'))
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

    public function bulkDeleteTN(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $thangnam = thangnam::find($id);
                $thangnam->delete();
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
