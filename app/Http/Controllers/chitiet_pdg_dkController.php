<?php

namespace App\Http\Controllers;
use App\phieudanhgia_doankhoa;
use App\doankhoa;
use App\khoa;
use App\doanvien_thanhnien;
use App\chidoan;
use App\namhoc;
use App\mauphieu;
use App\xeploai_dk;
use App\chitiet_pdg_dk;
use DB;

use Illuminate\Http\Request;

class chitiet_pdg_dkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $chitiet_pdg_dv = DB::table('chitiet_pdg_dv')
    //     ->join('phieudanhgia_doanvien', 'chitiet_pdg_dv.PHIEUDANHGIA_DOANVIEN_ID', '=', 'phieudanhgia_doanvien.ID')
    //     ->where('phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID', '=', $request->Session()->get('id_doanvien_thanhnien')) )
    //     ->get();
    //     dd($chitiet_pdg_dv); 
    // }

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
    public function store(Request $request, $id)
    {
        $chitiet_mauphieu = $request->chitiet_mauphieu;
        $chitiet_pdg_dk1 = chitiet_pdg_dk::where('PHIEUDANHGIA_DOANKHOA_ID',$id)->first();
        if(!$chitiet_pdg_dk1){
// dd($chitiet_mauphieu);
            foreach ($chitiet_mauphieu as $ct_mp) {
                $chitiet_pdg_dk = new chitiet_pdg_dk() ;
                $chitiet_pdg_dk->PHIEUDANHGIA_DOANKHOA_ID = $id;
                $chitiet_pdg_dk->NOIDUNG_PDG_ID = $ct_mp;
                // $chitiet_pdg_cd->NOIDUNG_TU_DANHGIA = $request->noidung;
                $chitiet_pdg_dk->save();
            }
            return redirect(route('ds_pdg_dk'))
            ->with('success_message', 'Lưu thành công ^^');
        }
        else{
            return redirect()->back()
            ->with('error_message', 'Lưu thành công ^^');
        }
        


    }



    public function index_duyet_pdg_dk(Request $request){
        // $id_doankhoa = $request->session()->get('session_id_doankhoa');
        // $id_ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        // dd($id_ten_chidoan);
        // dd($id_chidoan);
        // $chidoan = chidoan::where('ID',$id_chidoan)->get();
        // $request->session()->put('ten_chidoan',$chidoan->TEN_CD);
        // dd($request->session()->get('ten_chidoan'));
        $doankhoa = DB::table('doankhoa')
        // ->where('doankhoa.DOANKHOA_ID', '=', $id_doankhoa)
        ->select('doankhoa.*')
        ->get();

        return view('backend.phieudanhgia_doankhoa.index_duyet_pdg_dk')
        // ->with('cd', $chidoan)
        // ->with('i_dk', $id_doankhoa)
        // ->with('i_t_dk', $id_ten_doankhoa)
        ->with('dk', $doankhoa);
    }


    public function ds_duyet_pdg_dk(Request $request,$id){
        $doankhoa = doankhoa::find($id);
        // dd($doanvien_thanhnien);
        $phieudanhgia_doankhoa = DB::table('phieudanhgia_doankhoa')
        ->join('mauphieu', 'phieudanhgia_doankhoa.MAUPHIEU_ID', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_doankhoa.NAMHOC_ID', 'namhoc.ID')
        ->join('xeploai_dk', 'phieudanhgia_doankhoa.XEPLOAI_DK_ID', 'xeploai_dk.ID')
        ->join('doankhoa', 'phieudanhgia_doankhoa.DOANKHOA_ID', 'doankhoa.ID')
        ->where('DOANKHOA_ID','=', $doankhoa->ID)
        ->where('phieudanhgia_doankhoa.TRANGTHAI_DUYET','=', null)
        ->select('phieudanhgia_doankhoa.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_dk.TEN_XLDK', 'doankhoa.TEN_DK')
        ->get();
        $phieudanhgia_doankhoa1 = DB::table('phieudanhgia_doankhoa')
        ->join('mauphieu', 'phieudanhgia_doankhoa.MAUPHIEU_ID', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_doankhoa.NAMHOC_ID', 'namhoc.ID')
        ->join('xeploai_dk', 'phieudanhgia_doankhoa.XEPLOAI_DK_ID', 'xeploai_dk.ID')
        ->join('doankhoa', 'phieudanhgia_doankhoa.DOANKHOA_ID', 'doankhoa.ID')
        ->where('DOANKHOA_ID','=', $doankhoa->ID)
        ->where('phieudanhgia_doankhoa.TRANGTHAI_DUYET','=', 1)
        ->select('phieudanhgia_doankhoa.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_dk.TEN_XLDK', 'doankhoa.TEN_DK')
        ->get();
        $request->session()->put('id_dk_tn',$doankhoa->ID);
        $request->session()->put('ten_dk_tn',$doankhoa->TEN_DK);
        // dd($request->session()->get('id_dv_tn'));
        $cb_xeploai = DB::table('phieudanhgia_doankhoa')
        ->join('xeploai_dk', 'phieudanhgia_doankhoa.CB_XEPLOAI_DK_ID','=', 'xeploai_dk.ID')
        ->select('xeploai_dk.TEN_XLDK')
        // ->where('DOANVIEN_THANHNIEN_ID','=', $doanvien_thanhnien->ID)
        ->get();
        // $cb_xeploai = xeploai_dv::all();
        return view('backend.phieudanhgia_doankhoa.ds_duyet_pdg_dk')


        // ->with('cd', $chidoan)
        ->with('cb_xl', $cb_xeploai)
        ->with('pdg_dk', $phieudanhgia_doankhoa)
        ->with('pdg_dk1', $phieudanhgia_doankhoa1)
        ->with('dk', $doankhoa);
    }


    public function duyet_pdg_dk(Request $request, $id){
        $phieudanhgia_doankhoa1 = phieudanhgia_doankhoa::find($id);
        // dd($phieudanhgia_doankhoa1->ID);
        $phieudanhgia_doankhoa = DB::table('phieudanhgia_doankhoa')
        ->join('doankhoa','phieudanhgia_doankhoa.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->join('xeploai_dk', 'phieudanhgia_doankhoa.XEPLOAI_DK_ID', '=', 'xeploai_dk.ID')
        // ->join('xeploai_dv', 'phieudanhgia_doanvien.CB_XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
        ->join('mauphieu', 'phieudanhgia_doankhoa.MAUPHIEU_ID', '=', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_doankhoa.NAMHOC_ID', '=', 'namhoc.ID')
        ->where('phieudanhgia_doankhoa.ID','=', $phieudanhgia_doankhoa1->ID)
        ->select('phieudanhgia_doankhoa.*','doankhoa.TEN_DK', 'mauphieu.TEN_MP', 'xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
        ->get();
        $request->session()->put('pdg_dk',$phieudanhgia_doankhoa1->ID);

        // dd($phieudanhgia_doanvien);

        $chitiet_pdg_dk = DB::table('chitiet_pdg_dk')
        ->leftjoin('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_pdg_dk.NOIDUNG_PDG_ID')
        ->where('chitiet_pdg_dk.PHIEUDANHGIA_DOANKHOA_ID','=', $id)
        ->select('chitiet_pdg_dk.*', 'noidung_pdg.TEN_NDPDG', 'noidung_pdg.NOIDUNG_PDG')
        ->get();

        // dd($chitiet_pdg_dk );

        $xeploai_dk = xeploai_dk::all();
        $nguoiduyet = DB::table('doanvien_thanhnien')
        ->join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('users.VAITRO_ID', '=', 1)
        ->select('doanvien_thanhnien.*')
        ->get();

        return view('backend.phieudanhgia_doankhoa.duyet_pdg_dk')
        ->with('pdg_dk', $phieudanhgia_doankhoa)
        ->with('xl_dk', $xeploai_dk)
        ->with('nd', $nguoiduyet)
        ->with('ct_pdg_dk', $chitiet_pdg_dk); 
    } 



    public function ketqua_duyet_pdg_dk(Request $request, $id){
        $phieudanhgia_doankhoa1 = phieudanhgia_doankhoa::find($id);
        $phieudanhgia_doankhoa = DB::table('phieudanhgia_doankhoa')
        ->join('doankhoa','phieudanhgia_doankhoa.DOANKHOA_ID', '=', 'doankhoa.ID')
        ->join('xeploai_dk', 'phieudanhgia_doankhoa.XEPLOAI_DK_ID', '=', 'xeploai_dk.ID')
        // ->join('xeploai_dv', 'phieudanhgia_doanvien.CB_XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
        ->join('mauphieu', 'phieudanhgia_doankhoa.MAUPHIEU_ID', '=', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_doankhoa.NAMHOC_ID', '=', 'namhoc.ID')
        ->where('phieudanhgia_doankhoa.ID','=', $phieudanhgia_doankhoa1->ID)
        ->select('phieudanhgia_doankhoa.*','doankhoa.TEN_DK', 'mauphieu.TEN_MP', 'xeploai_dk.TEN_XLDK', 'namhoc.TEN_NH')
        ->get();
        $request->session()->put('pdg_dk',$phieudanhgia_doankhoa1->ID);

        // dd($phieudanhgia_doanvien);

        $chitiet_pdg_dk = DB::table('chitiet_pdg_dk')
        ->leftjoin('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_pdg_dk.NOIDUNG_PDG_ID')
        ->where('chitiet_pdg_dk.PHIEUDANHGIA_DOANKHOA_ID','=', $id)
        ->select('chitiet_pdg_dk.*', 'noidung_pdg.TEN_NDPDG', 'noidung_pdg.NOIDUNG_PDG')
        ->get();

        $xeploai_dk = xeploai_dk::all();
        $cb_xeploai = xeploai_dk::all();

        return view('backend.phieudanhgia_doankhoa.ketqua_duyet_pdg_dk')
        ->with('pdg_dk', $phieudanhgia_doankhoa)
        ->with('xl_dk', $xeploai_dk)
        ->with('cb_xl', $cb_xeploai)
        ->with('ct_pdg_dk', $chitiet_pdg_dk); 
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
        // dd($id);
        $chitiet_pdg_dk = $request->duyet_pdgdk;
        $data = $request->duyet;
        $ghichu = $request->ghichu;
        $xeploai = $request->cb_xeploai;
        $nguoiduyet = $request->nguoiduyet;
        // dd($xeploai);
        $id = $request->id;
        $i = 0;
        $danhgia = phieudanhgia_doankhoa::find($id);
        $danhgia->CB_XEPLOAI_DK_ID  = $xeploai;
        $danhgia->NGUOI_DUYET_PDGDK_ID = $nguoiduyet;
        $danhgia->TRANGTHAI_DUYET = 1;
        $danhgia->save();

        foreach ($request->duyet_pdgdk as $ct_pdg_dk) {
            $chitiet_pdg_dk = chitiet_pdg_dk::find($ct_pdg_dk);
            $chitiet_pdg_dk->DUYET_PDG_DK = $data[$i];
            $chitiet_pdg_dk->GHICHU_PDGDK = $ghichu[$i];
            // dd($chitiet_pdg_dv);
            $chitiet_pdg_dk->save();
            $i++;
        }



// $id =  $request->session()->get('pdg_dv');
// dd($request->session()->get('pdg_dv'));
        // $id_chidoan_dv = $request->session()->get('session_id_chidoan_sv');
        // dd($id_chidoan_dv);
        return redirect(route('index_duyet_pdg_dk'))
        ->with('success_message', 'Lưu thành công ^^');
        // }
        // else{
        //     return redirect()->back()
        //     ->with('error_message', 'Lưu thành công ^^');
        // }
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
