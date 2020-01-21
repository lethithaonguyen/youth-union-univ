<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vaitro;

use DB;

class vaitroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaitro = vaitro::all();
        return view('backend.vaitro.index')
        ->with('vt', $vaitro);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vaitro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vaitro = vaitro::where('TEN_VT', $request->tenvaitro)->first();
        if(!$vaitro)
        {
            $vaitro = new vaitro();
            $vaitro->TEN_VT = $request->tenvaitro;
            $vaitro->TAOMOI    = now();
            $vaitro->CAPNHAT   = null;
            $vaitro->save();
            return redirect(route('vaitro.index'))
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
        $vaitro = vaitro::find($id);

        return view('backend.vaitro.edit')
        ->with('vaitro', $vaitro);
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
        $vaitro = vaitro::find($id);
        $vaitro1 = vaitro::where('TEN_VT', $request->tenvaitro)->first();
        if(!$vaitro1)
        {
            $vaitro->TEN_VT = $request->tenvaitro;
            $vaitro->CAPNHAT    = now();
            $vaitro->save();
            return redirect(route('vaitro.index'))
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

    public function bulkDeleteVT(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $vaitro = vaitro::find($id);
                $vaitro->delete();
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
