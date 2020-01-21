<?php

namespace App\Http\Controllers;
use App\phieudanhgia_chidoan;
use App\doankhoa;
use App\khoa;
use App\doanvien_thanhnien;
use App\chidoan;
use App\namhoc;
use App\mauphieu;
use App\xeploai_cd;
use App\chitiet_pdg_cd;
use DB;

use Illuminate\Http\Request;

class chitiet_pdg_cdController extends Controller
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
        $chitiet_pdg_cd1 = chitiet_pdg_cd::where('PHIEUDANHGIA_CHIDOAN_ID',$id)->first();
        if(!$chitiet_pdg_cd1){
// dd($chitiet_mauphieu);
            foreach ($chitiet_mauphieu as $ct_mp) {
                $chitiet_pdg_cd = new chitiet_pdg_cd() ;
                $chitiet_pdg_cd->PHIEUDANHGIA_CHIDOAN_ID = $id;
                $chitiet_pdg_cd->NOIDUNG_PDG_ID = $ct_mp;
                // $chitiet_pdg_cd->NOIDUNG_TU_DANHGIA = $request->noidung;
                $chitiet_pdg_cd->save();
            }
            return redirect(route('ds_pdg_cd'))
            ->with('success_message', 'Lưu thành công ^^');
        }
        else{
            return redirect()->back()
            ->with('error_message', 'Lưu thành công ^^');
        }
        


    }



    public function index_duyet_pdg_cd(Request $request){
        $id_doankhoa = $request->session()->get('session_id_doankhoa');
        $id_ten_doankhoa = $request->session()->get('session_ten_doankhoa');
        $chidoan = DB::table('chidoan')
        ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
        ->join('khoa','khoa.ID','=','chidoan.KHOA_ID')
        ->where('chidoan.DOANKHOA_ID', '=', $id_doankhoa)
        ->select('chidoan.*','doankhoa.TEN_DK','khoa.TEN_KHOA')
        ->get();

        return view('backend.phieudanhgia_chidoan.index_duyet_pdg_cd')
        // ->with('cd', $chidoan)
        ->with('i_dk', $id_doankhoa)
        ->with('i_t_dk', $id_ten_doankhoa)
        ->with('cd', $chidoan);
    }


    public function ds_duyet_pdg_cd(Request $request,$id){
        $chidoan = chidoan::find($id);
        // dd($doanvien_thanhnien);
        $phieudanhgia_chidoan = DB::table('phieudanhgia_chidoan')
        ->join('mauphieu', 'phieudanhgia_chidoan.MAUPHIEU_ID', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_chidoan.NAMHOC_ID', 'namhoc.ID')
        ->join('xeploai_cd', 'phieudanhgia_chidoan.XEPLOAI_CD_ID', 'xeploai_cd.ID')
        ->join('chidoan', 'phieudanhgia_chidoan.CHIDOAN_ID', 'chidoan.ID')
        ->where('CHIDOAN_ID','=', $chidoan->ID)
        ->where('phieudanhgia_chidoan.TRANGTHAI_DUYET','=', null)
        ->select('phieudanhgia_chidoan.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_cd.TEN_XLCD', 'chidoan.TEN_CD')
        ->get();
        $request->session()->put('id_cd_tn',$chidoan->ID);
        $request->session()->put('ten_cd_tn',$chidoan->TEN_CD);
        // dd($request->session()->get('id_dv_tn'));
        $cb_xeploai = DB::table('phieudanhgia_chidoan')
        ->join('xeploai_cd', 'phieudanhgia_chidoan.CB_XEPLOAI_CD_ID','=', 'xeploai_cd.ID')
        ->select('xeploai_cd.TEN_XLCD')
        // ->where('DOANVIEN_THANHNIEN_ID','=', $doanvien_thanhnien->ID)
        ->get();

                $phieudanhgia_chidoan1 = DB::table('phieudanhgia_chidoan')
        ->join('mauphieu', 'phieudanhgia_chidoan.MAUPHIEU_ID', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_chidoan.NAMHOC_ID', 'namhoc.ID')
        ->join('xeploai_cd', 'phieudanhgia_chidoan.XEPLOAI_CD_ID', 'xeploai_cd.ID')
        ->join('chidoan', 'phieudanhgia_chidoan.CHIDOAN_ID', 'chidoan.ID')
        ->where('CHIDOAN_ID','=', $chidoan->ID)
        ->where('phieudanhgia_chidoan.TRANGTHAI_DUYET','=', 1)
        ->select('phieudanhgia_chidoan.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_cd.TEN_XLCD', 'chidoan.TEN_CD')
        ->get();
        // $cb_xeploai = xeploai_dv::all();
        return view('backend.phieudanhgia_chidoan.ds_duyet_pdg_cd')


        // ->with('cd', $chidoan)
        ->with('cb_xl', $cb_xeploai)
        ->with('pdg_cd', $phieudanhgia_chidoan)
        ->with('pdg_cd1', $phieudanhgia_chidoan1)
        ->with('cd', $chidoan);
    }




    public function duyet_pdg_cd(Request $request, $id){
        $phieudanhgia_chidoan1 = phieudanhgia_chidoan::find($id);
        $phieudanhgia_chidoan = DB::table('phieudanhgia_chidoan')
        ->join('chidoan','phieudanhgia_chidoan.CHIDOAN_ID', '=', 'chidoan.ID')
        ->join('xeploai_cd', 'phieudanhgia_chidoan.XEPLOAI_CD_ID', '=', 'xeploai_cd.ID')
        // ->join('xeploai_dv', 'phieudanhgia_doanvien.CB_XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
        ->join('mauphieu', 'phieudanhgia_chidoan.MAUPHIEU_ID', '=', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_chidoan.NAMHOC_ID', '=', 'namhoc.ID')
        ->where('phieudanhgia_chidoan.ID','=', $phieudanhgia_chidoan1->ID)
        ->select('phieudanhgia_chidoan.*','chidoan.TEN_CD', 'mauphieu.TEN_MP', 'xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
        ->get();
        $request->session()->put('pdg_cd',$phieudanhgia_chidoan1->ID);

        // dd($phieudanhgia_doanvien);

        $chitiet_pdg_cd = DB::table('chitiet_pdg_cd')
        ->leftjoin('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_pdg_cd.NOIDUNG_PDG_ID')
        ->leftjoin('chitiet_mauphieu','noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
        ->where('chitiet_pdg_cd.PHIEUDANHGIA_CHIDOAN_ID','=', $id)
        ->select('chitiet_pdg_cd.*', 'noidung_pdg.TEN_NDPDG','noidung_pdg.NOIDUNG_PDG', 'chitiet_mauphieu.THUTU_NOIDUNG')
        ->get();
        // dd($chitiet_pdg_cd );

        $xeploai_cd = xeploai_cd::all();
        $nguoiduyet = DB::table('doanvien_thanhnien')
        ->join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
        ->where('users.VAITRO_ID', '=', 2)
        ->select('doanvien_thanhnien.*')
        ->get();

        return view('backend.phieudanhgia_chidoan.duyet_pdg_cd')
        ->with('pdg_cd', $phieudanhgia_chidoan)
        ->with('xl_cd', $xeploai_cd)
        ->with('nd', $nguoiduyet)
        ->with('ct_pdg_cd', $chitiet_pdg_cd); 
    } 



    public function ketqua_duyet_pdg_cd(Request $request, $id){
        $phieudanhgia_chidoan1 = phieudanhgia_chidoan::find($id);
        $phieudanhgia_chidoan = DB::table('phieudanhgia_chidoan')
        ->join('chidoan','phieudanhgia_chidoan.CHIDOAN_ID', '=', 'chidoan.ID')
        ->join('xeploai_cd', 'phieudanhgia_chidoan.XEPLOAI_CD_ID', '=', 'xeploai_cd.ID')
        // ->join('xeploai_dv', 'phieudanhgia_doanvien.CB_XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
        ->join('mauphieu', 'phieudanhgia_chidoan.MAUPHIEU_ID', '=', 'mauphieu.ID')
        ->join('namhoc', 'phieudanhgia_chidoan.NAMHOC_ID', '=', 'namhoc.ID')
        ->where('phieudanhgia_chidoan.ID','=', $phieudanhgia_chidoan1->ID)
        ->select('phieudanhgia_chidoan.*','chidoan.TEN_CD', 'mauphieu.TEN_MP', 'xeploai_cd.TEN_XLCD', 'namhoc.TEN_NH')
        ->get();
        $request->session()->put('pdg_dv',$phieudanhgia_chidoan1->ID);

        // dd($phieudanhgia_doanvien);

        $chitiet_pdg_cd = DB::table('chitiet_pdg_cd')
        ->leftjoin('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_pdg_cd.NOIDUNG_PDG_ID')
        ->leftjoin('chitiet_mauphieu','noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
        ->where('chitiet_pdg_cd.PHIEUDANHGIA_CHIDOAN_ID','=', $id)
        ->select('chitiet_pdg_cd.*', 'noidung_pdg.TEN_NDPDG', 'noidung_pdg.NOIDUNG_PDG', 'chitiet_mauphieu.THUTU_NOIDUNG')
        ->get();

        $xeploai_cd = xeploai_cd::all();
        $cb_xeploai = xeploai_cd::all();

        return view('backend.phieudanhgia_chidoan.ketqua_duyet_pdg_cd')
        ->with('pdg_cd', $phieudanhgia_chidoan)
        ->with('xl_cd', $xeploai_cd)
        ->with('cb_xl', $cb_xeploai)
        ->with('ct_pdg_cd', $chitiet_pdg_cd); 
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
        $chitiet_pdg_cd = $request->duyet_pdgcd;
        $data = $request->duyet;
        $ghichu = $request->ghichu;
        $xeploai = $request->cb_xeploai;
        $nguoiduyet = $request->nguoiduyet;
        // dd($xeploai);
        $id = $request->id;
        $i = 0;
        $danhgia = phieudanhgia_chidoan::find($id);
        $danhgia->CB_XEPLOAI_CD_ID  = $xeploai;
        $danhgia->NGUOI_DUYET_PDGCD_ID = $nguoiduyet;
        $danhgia->TRANGTHAI_DUYET = 1;
        $danhgia->save();

        foreach ($request->duyet_pdgcd as $ct_pdg_cd) {
            $chitiet_pdg_cd = chitiet_pdg_cd::find($ct_pdg_cd);
            $chitiet_pdg_cd->DUYET_PDG_CD = $data[$i];
            $chitiet_pdg_cd->GHICHU_PDGCD = $ghichu[$i];
            // dd($chitiet_pdg_dv);
            $chitiet_pdg_cd->save();
            $i++;
        }



// $id =  $request->session()->get('pdg_dv');
// dd($request->session()->get('pdg_dv'));
        // $id_chidoan_dv = $request->session()->get('session_id_chidoan_sv');
        // dd($id_chidoan_dv);
        return redirect(route('index_duyet_pdg_cd'))
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
