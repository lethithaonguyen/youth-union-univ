<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    public function postLogin(request $request)
    {
    	$email = $request->email;
    	$password = $request->password;
    	if(Auth::guard('web')->attempt(['email' => $email, 'password' => $password]))
    	{
    		Session::put('session_ngay', Auth::user()->TAOMOI );
    		Session::put('session_vt',Auth::user()->vaitro()->get()[0]->ID);
            Session::put('session_ten_vt',Auth::user()->vaitro()->get()[0]->TEN_VT);
            Session::put('session_ten_sv',Auth::user()->doanvien_thanhnien()->get()[0]->TEN_SV);
            Session::put('session_mssv_sv',Auth::user()->doanvien_thanhnien()->get()[0]->MSSV);
            Session::put('session_id_sv',Auth::user()->doanvien_thanhnien()->get()[0]->ID);
            Session::put('session_phai_sv',Auth::user()->doanvien_thanhnien()->get()[0]->PHAI_SV);
            Session::put('session_id_chidoan_sv',Auth::user()->doanvien_thanhnien()->get()[0]->CHIDOAN_ID);
            Session::put('session_ten_chidoan_sv',Auth::user()->doanvien_thanhnien()->get()[0]->chidoan()->get()[0]->TEN_CD);
            Session::put('session_id_khoa_sv',Auth::user()->doanvien_thanhnien()->get()[0]->chidoan()->get()[0]->KHOA_ID);
            Session::put('session_ten_khoa_sv',Auth::user()->doanvien_thanhnien()->get()[0]->chidoan()->get()[0]->khoa()->get()[0]->TEN_KHOA);

            Session::put('session_id_doankhoa',Auth::user()->doanvien_thanhnien()->get()[0]->chidoan()->get()[0]->DOANKHOA_ID);
            Session::put('session_ten_doankhoa',Auth::user()->doanvien_thanhnien()->get()[0]->chidoan()->get()[0]->doankhoa()->get()[0]->TEN_DK);
            // Session::put('session_ten_chidoan',Auth::user()->doanvien_thanhnien()->get()[0]->chidoan()->get()[1]->TEN_CD);
            Session::put('email', $email);
            
            return redirect('/trangchu');

        }
        else{


            echo "error";
            $notification = array(
                'message' => 'Mật khẩu hoặc email!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
