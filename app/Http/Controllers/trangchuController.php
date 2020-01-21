<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pt_chidoan;
use App\chidoan;
use App\loai_pt;
use App\hocky;
use App\namhoc;
use App\khoa;
use App\pt_doankhoa;
use App\doankhoa;
use DB;
class trangchuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if($request->session()->get('session_vt') == 2){
    		$nam_dp = namhoc::latest('ID')->first();
    		$khoa_dp = khoa::orderBy('ID','asc')->first();
    		$namhoc = namhoc::all();
    		$khoa = khoa::all();
        // dd($results);

    		$results = DB::table('pt_chidoan')
    		->join('chidoan', 'chidoan.ID', '=', 'pt_chidoan.CHIDOAN_ID')
    		->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
            ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
    		->join('hocky', 'hocky.ID', '=', 'pt_chidoan.HOCKY_ID')
    		->join('namhoc', 'namhoc.ID','=','hocky.NAMHOC_ID')

    		->select(DB::raw("count(pt_chidoan.ID) as count"), 'chidoan.TEN_CD', 'khoa.TEN_KHOA','namhoc.TEN_NH' )
    		->where('NAMHOC_ID', '=', $nam_dp->ID)
    		->where('KHOA_ID', '=', $khoa_dp->ID)
            ->where('chidoan.DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
    		->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA')
            ->orderBy(DB::raw("count(pt_chidoan.ID)"), 'desc')
            ->get(); 
        //dd($results);       
// dd($tongtien);
            $labels = $results->pluck('TEN_CD');
        //dd($labels);
            $values = $results->pluck('count');
// dd($values);
            return view('layout.home')
            ->with('nh', $namhoc)
            ->with('n_dp', $nam_dp)
            ->with('k', $khoa)
            ->with('k_dp', $khoa_dp)
            ->with('labels', $labels)
            ->with('results', $results)
            ->with('values', $values);
        }
        elseif($request->session()->get('session_vt') == 1) {
         $nam_dp = namhoc::latest('ID')->first();
    			// dd($nam_dp->ID);
         $namhoc = namhoc::all();
        // dd($results);

         $results = DB::table('pt_doankhoa')
         ->join('doankhoa','doankhoa.ID','=','pt_doankhoa.DOANKHOA_ID')
         ->join('hocky', 'hocky.ID', '=', 'pt_doankhoa.HOCKY_ID')
         ->join('namhoc', 'namhoc.ID','=','hocky.NAMHOC_ID')
         ->where('namhoc.ID', '=', $nam_dp->ID)
         ->select(DB::raw("count(pt_doankhoa.ID) as count"), 'doankhoa.TEN_DK','namhoc.TEN_NH' )
         ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
         ->orderBy(DB::raw("count(pt_doankhoa.ID)"), 'desc')
         ->get(); 
        // dd($results);       
// SELECT namhoc.TEN_NH, doankhoa.TEN_DK, COUNT(pt_doankhoa.ID)
// FROM pt_doankhoa, hocky, namhoc, doankhoa
// WHERE pt_doankhoa.HOCKY_ID = hocky.ID
// and hocky.NAMHOC_ID = namhoc.ID
// AND pt_doankhoa.DOANKHOA_ID =doankhoa.ID
// GROUP BY namhoc.ID, doankhoa.ID;
         $labels = $results->pluck('TEN_DK');
        //dd($labels);
         $values = $results->pluck('count');
// dd($values);
         return view('layout.home')
         ->with('nh', $namhoc)
         ->with('n_dp', $nam_dp)
         ->with('labels', $labels)
         ->with('results', $results)
         ->with('values', $values);
     }
     else{
         return view('layout.home'); 
     }

        // return view('layout.tim_kiem');
 }
 public function thongke_ptcd_loc_theonam(Request $request){
  $nam_dp = namhoc::find($request->namhoc);
  $khoa_dp = khoa::find($request->khoa);
  $namhoc = namhoc::all();
  $khoa = khoa::all();
        // dd($results);

  $results = DB::table('pt_chidoan')
  ->join('chidoan', 'chidoan.ID', '=', 'pt_chidoan.CHIDOAN_ID')
  ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
  ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
  ->join('hocky', 'hocky.ID', '=', 'pt_chidoan.HOCKY_ID')
  ->join('namhoc', 'namhoc.ID','=','hocky.NAMHOC_ID')

  ->select(DB::raw("count(pt_chidoan.ID) as count"), 'chidoan.TEN_CD', 'khoa.TEN_KHOA','namhoc.TEN_NH' )
  ->where('NAMHOC_ID', '=', $nam_dp->ID)
  ->where('KHOA_ID', '=', $khoa_dp->ID)
  ->where('chidoan.DOANKHOA_ID', $request->session()->get('session_id_doankhoa'))
  ->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA')
  ->orderBy(DB::raw("count(pt_chidoan.ID)"), 'desc')
  ->get(); 
        //dd($results);       
// dd($tongtien);
  $labels = $results->pluck('TEN_CD');
  $values = $results->pluck('count');
// dd($values);
  return view('layout.home')
  ->with('nh', $namhoc)
  ->with('n_dp', $nam_dp)
  ->with('k', $khoa)
  ->with('k_dp', $khoa_dp)
  ->with('labels', $labels)
  ->with('results', $results)
  ->with('values', $values);
}
public function thongke_ptdk_loc_theonam(Request $request){
  $nam_dp = namhoc::find($request->namhoc);
    			// dd($nam_dp->ID);
  $namhoc = namhoc::all();
        // dd($results);

  $results = DB::table('pt_doankhoa')
  ->join('doankhoa','doankhoa.ID','=','pt_doankhoa.DOANKHOA_ID')
  ->join('hocky', 'hocky.ID', '=', 'pt_doankhoa.HOCKY_ID')
  ->join('namhoc', 'namhoc.ID','=','hocky.NAMHOC_ID')
  ->where('namhoc.ID', '=', $nam_dp->ID)
  ->select(DB::raw("count(pt_doankhoa.ID) as count"), 'doankhoa.TEN_DK','namhoc.TEN_NH' )
  ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
   ->orderBy(DB::raw("count(pt_doankhoa.ID)"), 'desc')
  ->get(); 
        //dd($results);       
// dd($tongtien);
  $labels = $results->pluck('TEN_DK');
        //dd($labels);
  $values = $results->pluck('count');
// dd($values);
  return view('layout.home')
  ->with('nh', $namhoc)
  ->with('n_dp', $nam_dp)
  ->with('labels', $labels)
  ->with('results', $results)
  ->with('values', $values);
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
