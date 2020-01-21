<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tongiao;

use DB;

class tongiaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tongiao = tongiao::all();
        return view('backend.tongiao.index')
        ->with('tg', $tongiao);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tongiao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tongiao = tongiao::where('TEN_TG', $request->tentongiao)->first();
        if(!$tongiao)
        {
            $tongiao = new tongiao();
            $tongiao->TEN_TG = $request->tentongiao;
            $tongiao->TAOMOI    = now();
            $tongiao->CAPNHAT   = null;
            $tongiao->save();
            return redirect(route('tongiao.index'))
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
        $tongiao = tongiao::find($id);

        return view('backend.tongiao.edit')
        ->with('tongiao', $tongiao);
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
        $tongiao = tongiao::find($id);
        $tongiao1 = tongiao::where('TEN_TG', $request->tentongiao)->first();
        if(!$tongiao1)
        {
            $tongiao->TEN_TG = $request->tentongiao;
            $tongiao->CAPNHAT    = now();
            $tongiao->save();
            return redirect(route('tongiao.index'))
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

    public function bulkDeleteTG(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $tongiao = tongiao::find($id);
                $tongiao->delete();
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
