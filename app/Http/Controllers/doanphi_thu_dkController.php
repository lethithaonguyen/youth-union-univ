<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\namhoc;
use App\thangnam;
use App\doankhoa;
use App\doanphi_thu_dk;
use App\v_soluong_cd;
use App\phieuchi_dk;
use App\pt_doankhoa;
use App\hocky;
use Illuminate\Http\Request;
use DB;
use Exception;


class doanphi_thu_dkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doanphi_thu_dk = doanphi_thu_dk::all();
        $namhoc_dp = namhoc::orderBy('ID','aSC')->first();
        $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$namhoc_dp->ID)->first();
        $namhoc = namhoc::all();
        $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
        $doankhoa = doankhoa::all(); 
        $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();

        $tongtien = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $namhoc_dp->ID)
        ->where('DUYET_CD', '=', null)
        ->groupBy( 'namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();


        // dd($tongtien);

        return view('backend.doanphi_thu_dk.index')
        ->with('t_t', $tongtien)
        ->with('dp_t_dk', $doanphi_thu_dk)
        ->with('nh_dp', $namhoc_dp)
        ->with('tn_dp', $thangnam_dp)
        ->with('nh', $namhoc)
        ->with('tn', $thangnam)
        ->with('dk', $doankhoa)
        ->with('dp', $doanphi);
    }

        // $dongdp = Dong_Doanphi::all();
        // $namhoc = Namhoc::all();
        // $thang = Thang::all();
        // $nam_dp = Namhoc::orderBy('namhoc_id','aSC')->first();
        // $doanphi = Doanphi::where('nam_id',$nam_dp->namhoc_id)->get();
        // $doanvien = Doanvien::paginate(10);
        // // var_dump($dongdp);
        // return view('backend.dongdoanphi.index')
        // ->with('ddp', $dongdp)
        // ->with('nh', $namhoc)
        // ->with('dp', $doanphi)
        // ->with('t', $thang)
        // ->with('dv', $doanvien)
        // ->with('ndp', $nam_dp);
    public function tong_tien_theonam (){


        // dd($results);
        $nam_dp = namhoc::latest('ID')->first();
        $results = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        // dd($tongtien);
        $namhoc = namhoc::all();
        $tongtien = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();

        $labels = $results->pluck('TEN_DK');
        $values = $results->pluck('so_tien_da_dong');
// dd($values);
        return view('backend.doanphi_thu_dk.tong_tien_theonam')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('values', $values);
    }

    public function tong_tien_loc_theonam (Request $request){
        $nam_dp = namhoc::find($request->namhoc);

        $namhoc = namhoc::all();
        $results = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        // dd($results);
        $tongtien = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        // dd($tongtien);


        $labels = $results->pluck('TEN_DK');
        $values = $results->pluck('so_tien_da_dong');
// dd($values);
        return view('backend.doanphi_thu_dk.tong_tien_theonam')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t', $tongtien)
        ->with('results', $results)
        ->with('values', $values);
    }

    public function bieudocotchong_dk (){


        // dd($results);
        $nam_dp = namhoc::latest('ID')->first();
        $results = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        // dd($tongtien);
        $namhoc = namhoc::all();
        $tongtien = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();

        $labels = $results->pluck('TEN_DK');
        $values = $results->pluck('so_tien_da_dong');
        $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
        return view('backend.doanphi_thu_dk.bieudocotchong_dk')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('values1', $values1)
        ->with('values', $values);
    }

    public function bieudocotchong_theonam_dk (Request $request){
        $nam_dp = namhoc::find($request->namhoc);

        $namhoc = namhoc::all();
        $results = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        // dd($results);
        $tongtien = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        // dd($tongtien);


        $labels = $results->pluck('TEN_DK');
        $values = $results->pluck('so_tien_da_dong');
        $values1 = $results->pluck('so_tien_chua_dong');
// dd($values);
        return view('backend.doanphi_thu_dk.bieudocotchong_dk')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t', $tongtien)
        ->with('results', $results)
        ->with('values1', $values1)
        ->with('values', $values);
    }


    public function getNam(Request $request)
    {
        $namhoc_dp = namhoc::find($request->namhoc);
        $doanphi_thu_dk = doanphi_thu_dk::all();

        $thangnam_dp = thangnam::orderBy('ID','aSC')->where('NAMHOC_ID','=',$request->namhoc)->first();
        $namhoc = namhoc::all();
        $thangnam = thangnam::all()->where('NAMHOC_ID','=',$namhoc_dp->ID);
        $doankhoa = doankhoa::all();
        $doanphi = thangnam::where('NAMHOC_ID','=',$namhoc_dp->ID)->get();
        $tongtien = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $namhoc_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
        return view('backend.doanphi_thu_dk.index')
        ->with('t_t', $tongtien)
        ->with('nh_dp',$namhoc_dp)
        ->with('dp_t_dk', $doanphi_thu_dk)
        ->with('tn_dp', $thangnam_dp)
        ->with('nh', $namhoc)
        ->with('tn', $thangnam)
        ->with('dk', $doankhoa)
        ->with('dp', $doanphi);
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
    public function update(Request $request)
    {
    //  $doanphithu = doanphithu::where('thangnam_id',$idtn)->get();
    //  foreach($doanphithu as $value){
    //     $value->delete();
    // }
        //$doanphithu = doanphithu::all();
        // $doanphithu = doanphithu::where('sinhvien_id','=',$doanphithu1->sinhvien_id)->where('thangnam_id','=',$doanphithu1->thangnam_id)->get();


       $doanphi_thu_dk = doanphi_thu_dk::where('namhoc_dp',$request->namhoc_dp)->get();
       foreach($doanphi_thu_dk as $value){
        $value->delete();
    }
    $doanphi =  $request->doanphi;

    if($doanphi != NULL){
        foreach($doanphi as $iddk => $value)
        {
            foreach($value as $idtn => $gt)
            {
                $data = new doanphi_thu_dk();
                $data->DOANKHOA_ID = $iddk;
                $data->THANGNAM_ID = $idtn;
                $data->NGAY_DONG_DK = date("y-m-d");
                $data->CAPNHAT = now();
                $data->TAOMOI = null;
                $data->DADONG = 1;
                $data->namhoc_dp = $request->namhoc_dp;
                $data->save();

            }

        }
    }

    session()->flash('flash_mesage','Cập nhật dữ liệu thành công');
    return redirect()->back();
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


    public function thongke_thuchi_dk (){
        $nam_dp = namhoc::latest('ID')->first();
        $namhoc = namhoc::all();
        $phieuchi_dk = phieuchi_dk::all();
        $hocky = hocky::all();
        $pt_doankhoa = pt_doankhoa::all();
        // dd($results);

        $results = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)*2/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
    //dd($results); 
        $results1 = DB::table('phieuchi_dk')
        ->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
        ->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
        ->get();
    //dd($results1); 
// dd($tongtien);
// SELECT doankhoa.ID, hocky.NAMHOC_ID,doankhoa.TEN_DK, namhoc.TEN_NH, sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa
// FROM doankhoa, phieuchi_dk,pt_doankhoa,namhoc,hocky, khoa
// WHERE phieuchi_dk.DOANKHOA_ID = doankhoa.ID
// and phieuchi_dk.PT_DOANKHOA_ID= pt_doankhoa.ID
// and pt_doankhoa.HOCKY_ID= hocky.ID
// and hocky.NAMHOC_ID= namhoc.ID
// GROUP BY doankhoa.ID, namhoc.ID

        $tongtien =DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)*2/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->get();
        $tongtien1 =DB::table('phieuchi_dk')
        ->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
        ->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();

        $labels = $results->pluck('TEN_DK');
        $values = $results->pluck('so_tien_phai_dong');
        $labels1 = $results1->pluck('TEN_DK');
        $values1 = $results1->pluck('tongchi_doankhoa');
// dd($values);
        return view('backend.phieuchi_dk.thongke_thuchi_dk')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('t_t1',$tongtien1)
        ->with('results', $results1)
        ->with('values', $values)
        ->with('labels1', $labels1)
        ->with('values1', $values1);
    }


    public function thongke_thuchi_theonam_dk (Request $request){
        $nam_dp = namhoc::find($request->namhoc);

        $namhoc = namhoc::all();
        $phieuchi_dk = phieuchi_dk::all();
        $hocky = hocky::all();
    // $v_tongchi_cd = v_tongchi_cd::all();
        $pt_doankhoa = pt_doankhoa::all();
        // dd($results);

        $results = DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)*2/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
    //dd($results); 
        $results1 = DB::table('phieuchi_dk')
        ->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
        ->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();
    //dd($results1); 
// dd($tongtien);
// SELECT doankhoa.ID, hocky.NAMHOC_ID,doankhoa.TEN_DK, namhoc.TEN_NH, sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa
// FROM doankhoa, phieuchi_dk,pt_doankhoa,namhoc,hocky, khoa
// WHERE phieuchi_dk.DOANKHOA_ID = doankhoa.ID
// and phieuchi_dk.PT_DOANKHOA_ID= pt_doankhoa.ID
// and pt_doankhoa.HOCKY_ID= hocky.ID
// and hocky.NAMHOC_ID= namhoc.ID
// GROUP BY doankhoa.ID, namhoc.ID

        $tongtien =DB::table('doankhoa')
        ->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
        ->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
        ->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
        ->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
        ->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)*2/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
        ->where('NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
        ->get();
        $tongtien1 =DB::table('phieuchi_dk')
        ->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
        ->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
        ->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
        ->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
        ->select( 'namhoc.TEN_NH','doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'))
        ->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
        ->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
        ->orderBy('doankhoa.ID', 'asc')
        ->get();

        $labels = $results->pluck('TEN_DK');
        $values = $results->pluck('so_tien_phai_dong');
        $labels1 = $results1->pluck('TEN_DK');
        $values1 = $results1->pluck('tongchi_doankhoa');
// dd($values);
        return view('backend.phieuchi_dk.thongke_thuchi_dk')
        ->with('nh', $namhoc)
        ->with('n_dp', $nam_dp)
        ->with('labels', $labels)
        ->with('t_t',$tongtien)
        ->with('results', $results)
        ->with('t_t1',$tongtien1)
        ->with('results', $results1)
        ->with('values', $values)
        ->with('labels1', $labels1)
        ->with('values1', $values1);
    }

}
