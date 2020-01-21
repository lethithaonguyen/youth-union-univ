<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\khoa;

use DB;

class khoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khoa = khoa::all();
        return view('backend.khoa.index')
        ->with('kh', $khoa);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.khoa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $khoa = khoa::where('TEN_KHOA', $request->tenkhoa)->first();
        if(!$khoa)
        {
            $khoa = new khoa();
            $khoa->TEN_KHOA = $request->tenkhoa;
            $khoa->TAOMOI    = now();
            $khoa->CAPNHAT   = null;
            $khoa->save();
            return redirect(route('khoa.index'))
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
        $khoa = khoa::find($id);

        return view('backend.khoa.edit')
        ->with('khoa', $khoa);
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
        $khoa = khoa::find($id);
        $khoa1 = khoa::where('TEN_KHOA', $request->tenkhoa)->first();
        if(!$khoa1)
        {
            $khoa->TEN_KHOA = $request->tenkhoa;
            $khoa->CAPNHAT    = now();
            $khoa->save();
            return redirect(route('khoa.index'))
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

    public function bulkDeleteKHOA(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $khoa = khoa::find($id);
                $khoa->delete();
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
