<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hinhthuc_ktkl;

use DB;

class hinhthuc_ktklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hinhthuc_ktkl = hinhthuc_ktkl::all();
        return view('backend.hinhthuc_ktkl.index')
        ->with('ht_ktkl', $hinhthuc_ktkl);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.hinhthuc_ktkl.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hinhthuc_ktkl = hinhthuc_ktkl::where('TEN_HT', $request->tenhinhthuc_ktkl)->first();
        if(!$hinhthuc_ktkl)
        {
            $hinhthuc_ktkl = new hinhthuc_ktkl();
            $hinhthuc_ktkl->TEN_HT = $request->tenhinhthuc_ktkl;
            $hinhthuc_ktkl->TAOMOI    = now();
            $hinhthuc_ktkl->CAPNHAT   = null;
            $hinhthuc_ktkl->save();
            return redirect(route('hinhthuc_ktkl.index'))
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
        $hinhthuc_ktkl = hinhthuc_ktkl::find($id);

        return view('backend.hinhthuc_ktkl.edit')
        ->with('hinhthuc_ktkl', $hinhthuc_ktkl);
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
        $hinhthuc_ktkl = hinhthuc_ktkl::find($id);
        $hinhthuc_ktkl1 = hinhthuc_ktkl::where('TEN_HT', $request->tenhinhthuc_ktkl)->first();
        if(!$hinhthuc_ktkl1)
        {
            $hinhthuc_ktkl->TEN_HT = $request->tenhinhthuc_ktkl;
            $hinhthuc_ktkl->CAPNHAT    = now();
            $hinhthuc_ktkl->save();
            return redirect(route('hinhthuc_ktkl.index'))
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

    public function bulkDeleteHT_KTKL(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $hinhthuc_ktkl = hinhthuc_ktkl::find($id);
                $hinhthuc_ktkl->delete();
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
