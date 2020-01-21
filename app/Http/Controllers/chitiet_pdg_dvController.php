<?php

namespace App\Http\Controllers;
use App\phieudanhgia_doanvien;
use App\doankhoa;
use App\khoa;
use App\doanvien_thanhnien;
use App\chidoan;
use App\namhoc;
use App\mauphieu;
use App\xeploai_dv;
use App\chitiet_pdg_dv;
use DB;

use Illuminate\Http\Request;

class chitiet_pdg_dvController extends Controller
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
        $chitiet_pdg_dv1 = chitiet_pdg_dv::where('PHIEUDANHGIA_DOANVIEN_ID',$id)->first();

        // dd($request->dung);
        if(!$chitiet_pdg_dv1){
// dd($chitiet_mauphieu);
            foreach ($chitiet_mauphieu as $ct_mp) {
                $chitiet_pdg_dv = new chitiet_pdg_dv() ;
                $chitiet_pdg_dv->PHIEUDANHGIA_DOANVIEN_ID = $id;
                $chitiet_pdg_dv->NOIDUNG_PDG_ID = $ct_mp;
                $chitiet_pdg_dv->NOIDUNG_TU_DANHGIA = $request->noidung;
                $chitiet_pdg_dv->save();
            }
            return redirect(route('ds_pdg_dv'))
            ->with('success_message', 'Lưu thành công ^^');
        }
        else{
            return redirect()->back()
            ->with('error_message', 'Lưu thành công ^^');
        }
        


    }



    public function index_duyet_pdg_dv(Request $request){
        $id_chidoan = $request->session()->get('session_id_chidoan_sv');
        $id_ten_chidoan = $request->session()->get('session_ten_chidoan');
        // dd($id_ten_chidoan);
        // dd($id_chidoan);
        // $chidoan = chidoan::where('ID',$id_chidoan)->get();
        // $request->session()->put('ten_chidoan',$chidoan->TEN_CD);
        // dd($request->session()->get('ten_chidoan'));
        $doanvien_thanhnien = DB::table('doanvien_thanhnien')
        ->join('phuong_xa', 'phuong_xa.ID', '=', 'doanvien_thanhnien.PHUONG_XA_ID_QQ')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('khoa','khoa.ID', '=', 'chidoan.KHOA_ID')
        ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
        ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
        ->where('doanvien_thanhnien.CHIDOAN_ID', '=', $id_chidoan)
        ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',null)
        ->select('doanvien_thanhnien.*', 'phuong_xa.TEN_PX', 'quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT','khoa.TEN_KHOA')
        ->get();

        return view('backend.phieudanhgia_doanvien.index_duyet_pdg_dv')
        // ->with('cd', $chidoan)
        ->with('i_cd', $id_chidoan)
        ->with('dv_tn', $doanvien_thanhnien);
    }


    public function ds_duyet_pdg_dv(Request $request,$id){
        $doanvien_thanhnien = doanvien_thanhnien::find($id);
        // dd($doanvien_thanhnien);
       $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
       ->join('mauphieu', 'phieudanhgia_doanvien.MAUPHIEU_ID', 'mauphieu.ID')
       ->join('namhoc', 'phieudanhgia_doanvien.NAMHOC_ID', 'namhoc.ID')
       ->join('xeploai_dv', 'phieudanhgia_doanvien.XEPLOAI_DV_ID', 'xeploai_dv.ID')
       ->join('doanvien_thanhnien', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID', 'doanvien_thanhnien.ID')
       ->where('DOANVIEN_THANHNIEN_ID','=', $doanvien_thanhnien->ID)
       ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',null)
       ->where('phieudanhgia_doanvien.TRANGTHAI_DUYET','=', null)
       ->select('phieudanhgia_doanvien.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_dv.TEN_XLDV', 'doanvien_thanhnien.TEN_SV')
       ->get();

       $phieudanhgia_doanvien1 = DB::table('phieudanhgia_doanvien')
       ->join('mauphieu', 'phieudanhgia_doanvien.MAUPHIEU_ID', 'mauphieu.ID')
       ->join('namhoc', 'phieudanhgia_doanvien.NAMHOC_ID', 'namhoc.ID')
       ->join('xeploai_dv', 'phieudanhgia_doanvien.XEPLOAI_DV_ID', 'xeploai_dv.ID')
       ->join('doanvien_thanhnien', 'phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID', 'doanvien_thanhnien.ID')
       ->join('v_nguoilap', 'phieudanhgia_doanvien.NGUOI_DUYET_PDGDV_ID', 'v_nguoilap.ID')
       ->where('DOANVIEN_THANHNIEN_ID','=', $doanvien_thanhnien->ID)
       ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',null)
       ->where('phieudanhgia_doanvien.TRANGTHAI_DUYET','=', 1)
       ->select('phieudanhgia_doanvien.*', 'mauphieu.TEN_MP', 'namhoc.TEN_NH', 'xeploai_dv.TEN_XLDV', 'doanvien_thanhnien.TEN_SV', 'v_nguoilap.TEN_LAP')
       ->get();
       $request->session()->put('id_dv_tn',$doanvien_thanhnien->ID);
       $request->session()->put('ten_dv_tn',$doanvien_thanhnien->TEN_SV);
        // dd($request->session()->get('id_dv_tn'));
       $cd_xeploai = DB::table('phieudanhgia_doanvien')
       ->join('xeploai_dv', 'phieudanhgia_doanvien.CD_XEPLOAI_DV_ID','=', 'xeploai_dv.ID')
       ->select('xeploai_dv.TEN_XLDV')
        // ->where('DOANVIEN_THANHNIEN_ID','=', $doanvien_thanhnien->ID)
       ->get();
        // $cb_xeploai = xeploai_dv::all();
       return view('backend.phieudanhgia_doanvien.ds_duyet_pdg_dv')


        // ->with('cd', $chidoan)
       ->with('cd_xl', $cd_xeploai)
       ->with('pdg_dv', $phieudanhgia_doanvien)
       ->with('pdg_dv1', $phieudanhgia_doanvien1)
       ->with('dv_tn', $doanvien_thanhnien);
   }


   public function duyet_pdg_dv(Request $request, $id){
    $phieudanhgia_doanvien1 = phieudanhgia_doanvien::find($id);
    $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
    ->join('doanvien_thanhnien','phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
    ->join('xeploai_dv', 'phieudanhgia_doanvien.XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
        // ->join('xeploai_dv', 'phieudanhgia_doanvien.CB_XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
    ->join('mauphieu', 'phieudanhgia_doanvien.MAUPHIEU_ID', '=', 'mauphieu.ID')
    ->join('namhoc', 'phieudanhgia_doanvien.NAMHOC_ID', '=', 'namhoc.ID')
    ->where('phieudanhgia_doanvien.ID','=', $phieudanhgia_doanvien1->ID)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',null)
    ->select('phieudanhgia_doanvien.*','doanvien_thanhnien.TEN_SV', 'mauphieu.TEN_MP', 'xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
    ->get();
    $request->session()->put('pdg_dv',$phieudanhgia_doanvien1->ID);
    // $request->session()->put('pdg_dv_ten',$phieudanhgia_doanvien1->TEN_PDGDV);
    // dd($request->session()->get('ten_pdg_dv'));

        // dd($phieudanhgia_doanvien);

    $chitiet_pdg_dv = DB::table('chitiet_pdg_dv')
    ->leftjoin('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_pdg_dv.NOIDUNG_PDG_ID')
    ->leftjoin('chitiet_mauphieu','noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
    ->where('chitiet_pdg_dv.PHIEUDANHGIA_DOANVIEN_ID','=', $id)
    ->select('chitiet_pdg_dv.*', 'noidung_pdg.TEN_NDPDG', 'chitiet_mauphieu.THUTU_NOIDUNG')
    ->get();
// dd($chitiet_pdg_dv);
    $xeploai_dv = xeploai_dv::all();
    $nguoiduyet = DB::table('doanvien_thanhnien')
    ->join('users', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
    ->where('users.VAITRO_ID', '=', 3)
    ->where('doanvien_thanhnien.ID', $request->session()->get('session_id_sv'))
    ->select('doanvien_thanhnien.*')
    ->get();

    return view('backend.phieudanhgia_doanvien.duyet_pdg_dv')
    ->with('pdg_dv', $phieudanhgia_doanvien)
    ->with('xl_dv', $xeploai_dv)
    ->with('nd', $nguoiduyet)
    ->with('ct_pdg_dv', $chitiet_pdg_dv); 
} 



public function ketqua_duyet_pdg_dv(Request $request, $id){
    $phieudanhgia_doanvien1 = phieudanhgia_doanvien::find($id);
    $phieudanhgia_doanvien = DB::table('phieudanhgia_doanvien')
    ->join('doanvien_thanhnien','phieudanhgia_doanvien.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
    ->join('xeploai_dv', 'phieudanhgia_doanvien.XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
        // ->join('xeploai_dv', 'phieudanhgia_doanvien.CB_XEPLOAI_DV_ID', '=', 'xeploai_dv.ID')
    ->join('mauphieu', 'phieudanhgia_doanvien.MAUPHIEU_ID', '=', 'mauphieu.ID')
    ->join('namhoc', 'phieudanhgia_doanvien.NAMHOC_ID', '=', 'namhoc.ID')
    ->where('phieudanhgia_doanvien.ID','=', $phieudanhgia_doanvien1->ID)
    ->where('doanvien_thanhnien.NGAYVAODOAN_SV','!=',null)
    ->select('phieudanhgia_doanvien.*','doanvien_thanhnien.TEN_SV', 'mauphieu.TEN_MP', 'xeploai_dv.TEN_XLDV', 'namhoc.TEN_NH')
    ->get();
    $request->session()->put('pdg_dv',$phieudanhgia_doanvien1->ID);

        // dd($phieudanhgia_doanvien);

    $chitiet_pdg_dv = DB::table('chitiet_pdg_dv')
    ->leftjoin('noidung_pdg', 'noidung_pdg.ID', '=', 'chitiet_pdg_dv.NOIDUNG_PDG_ID')
    ->leftjoin('chitiet_mauphieu','noidung_pdg.ID', '=', 'chitiet_mauphieu.NOIDUNG_PDG_ID')
    ->where('chitiet_pdg_dv.PHIEUDANHGIA_DOANVIEN_ID','=', $id)
    ->select('chitiet_pdg_dv.*', 'noidung_pdg.TEN_NDPDG', 'chitiet_mauphieu.THUTU_NOIDUNG')
    ->get();

    $xeploai_dv = xeploai_dv::all();
    $cd_xeploai = xeploai_dv::all();

    return view('backend.phieudanhgia_doanvien.ketqua_duyet_pdg_dv')
    ->with('pdg_dv', $phieudanhgia_doanvien)
    ->with('xl_dv', $xeploai_dv)
    ->with('cd_xl', $cd_xeploai)
    ->with('ct_pdg_dv', $chitiet_pdg_dv); 
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
        $chitiet_pdg_dv = $request->duyet_pdgdv;
        $data = $request->duyet;
        $ghichu = $request->ghichu;
        $xeploai = $request->cd_xeploai;
        $nguoiduyet = $request->nguoiduyet;
        // dd($xeploai);
        $id = $request->id;
        $i = 0;
        $danhgia = phieudanhgia_doanvien::find($id);
        $danhgia->CD_XEPLOAI_DV_ID  = $xeploai;
        $danhgia->NGUOI_DUYET_PDGDV_ID = $nguoiduyet;
        $danhgia->TRANGTHAI_DUYET = 1;
        $danhgia->save();

        foreach ($request->duyet_pdgdv as $ct_pdg_dv) {
            $chitiet_pdg_dv = chitiet_pdg_dv::find($ct_pdg_dv);
            $chitiet_pdg_dv->DUYET_PDG_DV = $data[$i];
            $chitiet_pdg_dv->GHICHU_PDGDV = $ghichu[$i];
            // dd($chitiet_pdg_dv);
            $chitiet_pdg_dv->save();
            $i++;
        }



// $id =  $request->session()->get('pdg_dv');
// dd($request->session()->get('pdg_dv'));
        // $id_chidoan_dv = $request->session()->get('session_id_chidoan_sv');
        // dd($id_chidoan_dv);
        return redirect(route('index_duyet_pdg_dv'))
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
