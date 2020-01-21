<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doanvien_thanhnien;
use App\phuong_xa;
use App\chidoan;
use App\tongiao;
use App\dantoc;
use App\quan_huyen;
use App\tinh_thanhpho;
use App\v_qq_ns;
use App\khoa;
use App\doankhoa;
use App\thanhtich_thamgia;
use App\chucvu;
use App\phieudanhgia_doanvien;
use App\namhoc;
use App\hocky;
use App\pt_doankhoa;
use App\xeploai_dv;
use DB;

class tim_kiemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.tim_kiem');
    }
    function get_timkiem(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('doanvien_thanhnien')
            ->where('TEN_SV', 'LIKE', "%{$query}%")
            ->get();
            // dd($data);
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '
               <li><a href="#">'.$row->TEN_SV.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
         // dd($output);
       }
   }
    function get_timkiem_dk(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('doankhoa')
            ->where('TEN_DK', 'LIKE', "%{$query}%")
            ->get();
            // dd($data);
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '
               <li><a href="#">'.$row->TEN_DK.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
         // dd($output);
       }
   }
   function get_thongtin(Request $request){
    $sv = $request->sinhvien;
    $dk = $request->doankhoa;
    // dd($sv);
    if($dk != null){
        $sinhvien = DB::table('doanvien_thanhnien')
        ->join('v_qq_ns', 'v_qq_ns.ID', '=', 'doanvien_thanhnien.ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
        ->join('doankhoa','doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
        ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
        ->where('doanvien_thanhnien.TEN_SV', '=', $sv)
        ->where('doankhoa.TEN_DK', $dk)
        ->select('doanvien_thanhnien.*','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT','v_qq_ns.*','khoa.TEN_KHOA','doankhoa.TEN_DK')
        ->get();
    }else{
     $sinhvien = DB::table('doanvien_thanhnien')
     ->join('v_qq_ns', 'v_qq_ns.ID', '=', 'doanvien_thanhnien.ID')
     ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
     ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
     ->join('doankhoa','doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
     ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
     ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
     ->where('doanvien_thanhnien.TEN_SV', '=', $sv)
        // ->where('doankhoa.TEN_DK', $dk)
     ->select('doanvien_thanhnien.*','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT','v_qq_ns.*','khoa.TEN_KHOA','doankhoa.TEN_DK')
     ->get(); 
 }

 dd($sinhvien);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
