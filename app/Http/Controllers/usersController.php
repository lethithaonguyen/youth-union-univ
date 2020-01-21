<?php

namespace App\Http\Controllers;
use App\doanvien_thanhnien;
use App\vaitro;
use App\users;
use App\doankhoa;
use App\khoa;
use App\chidoan;
use Illuminate\Http\Request;
use DB;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('session_vt')==2){
            $users = DB::table('users')
            ->join('doanvien_thanhnien', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
            // ->join('chidoan', 'chidoan.ID ', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            // ->join('khoa','khoa.ID', '=', 'chidoan.KHOA_ID')
            // ->join('doankhoa','doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('vaitro', 'users.VAITRO_ID', '=', 'vaitro.ID')
            // ->where('doankhoa.ID' , '=' ,$request->session()->get('session_id_doankhoa'))
            ->select('users.*', 'doanvien_thanhnien.TEN_SV', 'vaitro.TEN_VT')
            ->get();
            // dd($users);
        }else{
            $users = DB::table('users')
            ->join('doanvien_thanhnien', 'users.DOANVIEN_THANHNIEN_ID', '=', 'doanvien_thanhnien.ID')
            // ->join('chidoan', 'chidoan.ID ', '=', 'doanvien_thanhnien.CHIDOAN_ID')
            // ->join('khoa','khoa.ID', '=', 'chidoan.KHOA_ID')
            // ->join('doankhoa','doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
            ->join('vaitro', 'users.VAITRO_ID', '=', 'vaitro.ID')
            ->select('users.*', 'doanvien_thanhnien.TEN_SV', 'vaitro.TEN_VT')
            ->get();
            // dd($users);
        }

        return view('backend.users.index')
        ->with('u', $users);
    }


    public function layvaitro(Request $request)
    {
        $layvaitro = vaitro::find($request->vaitro_id);
        $vaitro = vaitro::all();
        $users = users::where('VAITRO_ID' ,$layvaitro->vaitro_id)->get();
        return view('backend.users.index')
        ->with('lvt', $layvaitro)
        ->with('vt', $vaitro)
        ->with('u', $users);
    }



    public function index_getchidoan(Request $request){
        // $doankhoa = doankhoa::all();
        $khoa = khoa::all();
        return view('backend.users.index_getchidoan')
        // ->with('dk',$doankhoa)
        ->with('k', $khoa);

    }
    public function getchidoan(Request $request){
        // $doankhoa = doankhoa::find($request->doankhoa);
        $khoa = khoa::find($request->khoa);
        $chidoan = chidoan::where('DOANKHOA_ID',$request->session()->get('session_id_doankhoa'))
        ->where('KHOA_ID',$khoa->ID)
        ->get();
        return view('backend.users.index_getdoanvien')
        // ->with('dk',$doankhoa)
        ->with('k', $khoa)
        ->with('cd',$chidoan);
    }

    public function getdoanvien(Request $request){
        $chidoan = chidoan::find($request->chidoan);
        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID', '=', $chidoan->ID)->get();
        $request->session()->put('id_sv',$chidoan->ID);
        $vaitro = vaitro::where('ID', '!=', 1)->where('ID', '!=', 2)->get();
        return view('backend.users.create')
        ->with('dv_tn', $doanvien_thanhnien)
        ->with('cd', $chidoan)
        ->with('vt', $vaitro);
    }

    public function index_chidoan(Request $request)
    {

        $chidoan = $request->session()->get('id_sv');
        $doanvien_thanhnien = doanvien_thanhnien::where('CHIDOAN_ID', '=', $chidoan)->get();
        $vaitro = vaitro::all();
        return view('backend.users.create')
        ->with('dv_tn', $doanvien_thanhnien)
        ->with('cd', $chidoan)
        ->with('vt', $vaitro);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $chidoan = $request->session()->get('id_sv');
        $doanvien_thanhnien = doanvien_thanhnien::all();
        $vaitro = vaitro::all();
        return view('backend.users.create')
        ->with('dv_tn', $doanvien_thanhnien)
        // ->with('cd', $chidoan)
        ->with('vt', $vaitro);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = new users();
        $users->DOANVIEN_THANHNIEN_ID = $request->doanvien;
        // dd($request->doanvien);
        $users->VAITRO_ID = $request->vaitro;
        $users->email = $request->email;
        $users->password = bcrypt('123456');
        // dd($users->password);
        $users->save();
        return redirect(route('users.index'))
        ->with('success_message', 'Lưu thành công ^^');
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
    public function bulkDeleteU(Request $request)
    {
        try {
            $all_data = $request->except('_token');
            foreach($all_data['id'] as $id) {

                $users = users::find($id);
                $users->delete();
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
