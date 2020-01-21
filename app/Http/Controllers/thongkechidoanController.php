<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Classes\Chartjs\Chart as Charts;
use App\chidoan;
use App\doankhoa;
use App\doanvien_thanhnien;
use App\thangnam;
use App\doanphi_thu_dk;
use App\namhoc;
use Illuminate\Support\Facades\Response;
use DB;

class thongkechidoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::table('chidoan')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('chidoan.DUYET_CD','=',null)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(chidoan.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('chidoan.DUYET_CD','=',null)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(chidoan.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $labels = $results->pluck('title');
        $values = $results->pluck('count');

        return view('backend.chidoan.thongkechidoan')->with('labels', $labels)
        ->with('results', $results)
        ->with('chidoan', $chidoan)
        ->with('values', $values);
    }


    public function bieudocot()
    {
        $results = DB::table('chidoan')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('chidoan.DUYET_CD','=',null)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(chidoan.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('chidoan.DUYET_CD','=',null)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(chidoan.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $labels = $results->pluck('title');
        $values = $results->pluck('count');

        return view('backend.chidoan.bieudocot')->with('labels', $labels)
        ->with('results', $results)
        ->with('chidoan', $chidoan)
        ->with('values', $values);
    }

    public function bieudoduong()
    {
        $results = DB::table('chidoan')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('chidoan.DUYET_CD','=',null)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(chidoan.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('chidoan.DUYET_CD','=',null)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(chidoan.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $labels = $results->pluck('title');
        $values = $results->pluck('count');

        return view('backend.chidoan.bieudoduong')->with('labels', $labels)
        ->with('results', $results)
        ->with('chidoan', $chidoan)
        ->with('values', $values);
    }
    public function tk_sinhvien_doankhoa(){
        $results = DB::table('doanvien_thanhnien')
        ->join('chidoan', 'doanvien_thanhnien.CHIDOAN_ID', '=', 'chidoan.ID')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',NULL)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(doanvien_thanhnien.ID) as count"))

        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $doanvien_thanhnien = DB::table('doanvien_thanhnien')
        ->join('chidoan', 'doanvien_thanhnien.CHIDOAN_ID', '=', 'chidoan.ID')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',NULL)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $labels = $results->pluck('title');
        $values = $results->pluck('count');

        return view('backend.doankhoa.tk_sinhvien_doankhoa')->with('labels', $labels)
        ->with('results', $results)
        ->with('doanvien_thanhnien', $doanvien_thanhnien)
        ->with('values', $values);
    }

    public function tk_doanvien_doankhoa(){
        $results = DB::table('doanvien_thanhnien')
        ->join('chidoan', 'doanvien_thanhnien.CHIDOAN_ID', '=', 'chidoan.ID')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV','=',NULL)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',NULL)
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',NULL)
        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $doanvien_thanhnien = DB::table('doanvien_thanhnien')
        ->join('chidoan', 'doanvien_thanhnien.CHIDOAN_ID', '=', 'chidoan.ID')
        ->join('doankhoa', 'chidoan.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->where('doanvien_thanhnien.NGAYTTDOAN_SV','=',NULL)
        ->where('doanvien_thanhnien.NGAYCHUYENSH_SV','=',NULL)
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',NULL)

        ->select( 'doankhoa.TEN_DK as title', DB::raw("count(doanvien_thanhnien.ID) as count"))
        ->groupBy('doankhoa.TEN_DK')
        ->get();

        $labels = $results->pluck('title');
        $values = $results->pluck('count');

        return view('backend.doankhoa.tk_doanvien_doankhoa')->with('labels', $labels)
        ->with('results', $results)
        ->with('doanvien_thanhnien', $doanvien_thanhnien)
        ->with('values', $values);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $now = Carbon::now();
        // $results = DB::select("
        //             SELECT COUNT(A.DTB)  as SL, A.DTB FROM (
        //             SELECT CASE 
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) < 4 THEN 'F'
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) >= 4 AND Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1))  <=  4.9 THEN 'D'
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) >= 5 AND Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1))  <=  5.4 THEN 'D+'
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) >= 5.5 AND Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1))  <=  6.4 THEN 'C'
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) >= 6.5 AND Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1))  <=  6.9 THEN 'C+'
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) >= 7 AND Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1))  <=  7.9 THEN 'B'
        //             WHEN  Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1) ) >= 8 AND Cast(AVG(HD_DIEMSO)AS DECIMAL(10,1))  <=  8.9 THEN 'B+'
        //             ELSE 'A' 
        //             END AS DTB, cthd.DT_MA, cthd.DK_MA
        //             FROM chitiethoidong cthd JOIN dangki dk 
        //             ON dk.DK_MA = cthd.DK_MA AND dk.DK_TRANGTHAI = 5 
        //             JOIN detai dt on dt.DT_MA = dk.DT_MA
        //             JOIN detai_hocki dthk on dthk.DT_MA = dt.DT_MA
        //             JOIN hocki hk on hk.HK_MA = dthk.HK_MA Where hk.HK_TGBD <= '$now' AND hk.HK_TGKT >= '$now'
        //             GROUP BY cthd.DT_MA, cthd.DK_MA) AS A
        //             group BY A.DTB");

        // $results = collect($results);

        // $labels = $results->pluck('DTB');
        // $values = $results->pluck('SL');

        //   return view('Admin.ThongKe.thongkediem')->with('labels', $labels)
        //                                 ->with('values', $values);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function tkkhoa()
    // {
    //     $now = Carbon::now();
    //     $results = DB::table('bomon')
    //     ->join('khoa', 'bomon.k_ma', '=', 'khoa.k_ma')
    //     ->select( 'khoa.k_ten as title', DB::raw("count(bomon.k_ma) as count"))
    //     ->groupBy('khoa.k_ten')
    //     ->get();

    //     $labels = $results->pluck('title');
    //     $values = $results->pluck('count');

    //       return view('Admin.ThongKe.thongkekhoa')->with('labels', $labels)
    //                                     ->with('values', $values);
    // }
    //  public function tkkhoa()
    // {
    //     $now = Carbon::now();
    //     $results = DB::table('dangki')
    //     ->join('detai', 'dangki.dt_ma', '=', 'detai.dt_ma')
    //     ->join('loaidetai', 'loaidetai.ldt_ma', '=', 'detai.ldt_ma')
    //     ->join('detai_hocki', 'detai_hocki.DT_MA', '=', 'detai.DT_MA')
    //     ->join('hocki', 'hocki.HK_MA', '=', 'detai_hocki.HK_MA')
    //     ->where('hocki.HK_TGBD', '<=' , $now)
    //     ->where('hocki.HK_TGKT', '>=' , $now)
    //     ->select('loaidetai.ldt_ma as id', 'loaidetai.ldt_ten as title', DB::raw("count(dangki.dt_ma) as count"))
    //     ->groupBy('loaidetai.ldt_ma', 'loaidetai.ldt_ten')
    //     ->get();

    //     $labels = $results->pluck('title');
    //     $values = $results->pluck('count');

    //       return view('Admin.ThongKe.thongkekhoa')->with('labels', $labels)
    //                                     ->with('values', $values);
    // }

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