<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loai_ktkl;

use DB;

class loai_ktklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loai_ktkl = loai_ktkl::all();
        return view('backend.loai_ktkl.index')
        ->with('lktkl', $loai_ktkl);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai_ktkl.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loai_ktkl = loai_ktkl::where('TEN_LOAIKTKL', $request->tenloai_ktkl)->first();
        if(!$loai_ktkl)
        {
            $loai_ktkl = new loai_ktkl();
            $loai_ktkl->TEN_LOAIKTKL = $request->tenloai_ktkl;
            $loai_ktkl->TAOMOI    = now();
            $loai_ktkl->CAPNHAT   = null;
            $loai_ktkl->save();
            return redirect(route('loai_ktkl.index'))
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
        $loai_ktkl = loai_ktkl::find($id);

        return view('backend.loai_ktkl.edit')
        ->with('loai_ktkl', $loai_ktkl);
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
        $loai_ktkl = loai_ktkl::find($id);
        $loai_ktkl1 = loai_ktkl::where('TEN_LOAIKTKL', $request->tenloai_ktkl)->first();
        if(!$loai_ktkl1)
        {
            $loai_ktkl->TEN_LOAIKTKL = $request->tenloai_ktkl;
            $loai_ktkl->CAPNHAT    = now();
            $loai_ktkl->save();
            return redirect(route('loai_ktkl.index'))
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

    public function bulkDeleteLKTKL(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $loai_ktkl = loai_ktkl::find($id);
                $loai_ktkl->delete();
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
