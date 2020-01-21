<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doankhoa;

use DB;

class doankhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doankhoa = doankhoa::all();
        return view('backend.doankhoa.index')
        ->with('dk', $doankhoa);

    }

    public function doankhoa_view(Request $request)
    {
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        $doankhoa = doankhoa::where('ID',$id_doankhoa)->get();
        return view('backend.doankhoa.index')
        ->with('i_dk', $id_doankhoa)
        ->with('dk', $doankhoa);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.doankhoa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doankhoa = doankhoa::where('TEN_DK', $request->tendoankhoa)->first();
        if(!$doankhoa)
        {
            $doankhoa = new doankhoa();
            $doankhoa->TEN_DK = $request->tendoankhoa;
            $doankhoa->TAOMOI    = now();
            $doankhoa->CAPNHAT   = null;
            $doankhoa->save();
            return redirect(route('doankhoa.index'))
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
        $doankhoa = doankhoa::find($id);

        return view('backend.doankhoa.edit')
        ->with('doankhoa', $doankhoa);
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
        $doankhoa = doankhoa::find($id);
        $doankhoa1 = doankhoa::where('TEN_DK', $request->tendoankhoa)->first();
        if(!$doankhoa1)
        {
            $doankhoa->TEN_DK = $request->tendoankhoa;
            $doankhoa->CAPNHAT    = now();
            $doankhoa->save();
            return redirect(route('doankhoa.index'))
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

    public function bulkDeleteDK(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $doankhoa = doankhoa::find($id);
                $doankhoa->delete();
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
