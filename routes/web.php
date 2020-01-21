<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

// Route::get('/thongtin', function () {
// 	return view('backend.doanvien_thanhnien.thongtinsinhvien');
// });


Route::get('/login', function () {
	return view('auth.login');
})->name('login');

Route::get('/logout',function(){
	Auth::logout();
	Session::flush();
	return redirect('/login');
});

Route::post('post-dangnhap','LoginController@postLogin')->name('post.login');




//TON GIAO
Route::group(['middleware' => 'checklogin'], function(){
	Route::get('/app', function () {
		return view('layout.app');
	})->name('app');
	Route::resource('/tongiao','tongiaoController');
	Route::post('/tongiao/bulkDeleteTG', 'tongiaoController@bulkDeleteTG')->name('tongiao.bulkDeleteTG');	

	Route::resource('/khoa','khoaController');
	Route::post('/khoa/bulkDeleteKHOA', 'khoaController@bulkDeleteKHOA')->name('khoa.bulkDeleteKHOA');

	Route::resource('/dantoc','dantocController');
	Route::post('/dantoc/bulkDeleteDT', 'dantocController@bulkDeleteDT')->name('dantoc.bulkDeleteDT');



	Route::resource('/dv_ketnap','dv_ketnapController');
	Route::post('/dv_ketnap/bulkDeleteDV_KN', 'dv_ketnapController@bulkDeleteDV_KN')->name('dv_ketnap.bulkDeleteDV_KN');
	Route::get('/dv_ketnap/create/getchidoan', 'dv_ketnapController@getchidoan')->name('dv_ketnap.getchidoan');
	Route::get('/dv_ketnap/create/getdoanvien', 'dv_ketnapController@getdoanvien')->name('dv_ketnap.getdoanvien');




	Route::resource('/dv_tt_doan','dv_tt_doanController');
	Route::post('/dv_tt_doan/bulkDeleteDV_TT', 'dv_tt_doanController@bulkDeleteDV_TT')->name('dv_tt_doan.bulkDeleteDV_TT');

	Route::resource('/hinhthuc_ktkl','hinhthuc_ktklController');
	Route::post('/hinhthuc_ktkl/bulkDeleteHT_KTKL', 'hinhthuc_ktklController@bulkDeleteHT_KTKL')->name('hinhthuc_ktkl.bulkDeleteHT_KTKL');

	Route::resource('/kieu_dulieu','kieu_dulieuController');
	Route::post('/kieu_dulieu/bulkDeleteKDL', 'kieu_dulieuController@bulkDeleteKDL')->name('kieu_dulieu.bulkDeleteKDL');

	Route::resource('/loai_noidung_chi','loai_noidung_chiController');
	Route::post('/loai_noidung_chi/bulkDeleteLNDC', 'loai_noidung_chiController@bulkDeleteLNDC')->name('loai_noidung_chi.bulkDeleteLNDC');

	Route::resource('/loai_noidung_pdg','loai_noidung_pdgController');
	Route::post('/loai_noidung_pdg/bulkDeleteLNDPDG', 'loai_noidung_pdgController@bulkDeleteLNDPDG')->name('loai_noidung_pdg.bulkDeleteLNDPDG');

	Route::resource('/loai_pt','loai_ptController');
	Route::post('/loai_pt/bulkDeleteLPT', 'loai_ptController@bulkDeleteLPT')->name('loai_pt.bulkDeleteLPT');

	Route::resource('/mauphieu','mauphieuController');
	Route::post('/mauphieu/bulkDeleteMP', 'mauphieuController@bulkDeleteMP')->name('mauphieu.bulkDeleteMP');

	Route::resource('/namhoc','namhocController');
	Route::post('/namhoc/bulkDeleteNH', 'namhocController@bulkDeleteNH')->name('namhoc.bulkDeleteNH');

	Route::resource('/thanhtich','thanhtichController');
	Route::post('/thanhtich/bulkDeleteTT', 'thanhtichController@bulkDeleteTT')->name('thanhtich.bulkDeleteTT');

	Route::resource('/vaitro','vaitroController');
	Route::post('/vaitro/bulkDeleteVT', 'vaitroController@bulkDeleteVT')->name('vaitro.bulkDeleteVT');

	Route::resource('/xeploai_cd','xeploai_cdController');
	Route::post('/xeploai_cd/bulkDeleteXLCD', 'xeploai_cdController@bulkDeleteXLCD')->name('xeploai_cd.bulkDeleteXLCD');

	Route::resource('/xeploai_dk','xeploai_dkController');
	Route::post('/xeploai_dk/bulkDeleteXLDK', 'xeploai_dkController@bulkDeleteXLDK')->name('xeploai_dk.bulkDeleteXLDK');

	Route::resource('/xeploai_dv','xeploai_dvController');
	Route::post('/xeploai_dv/bulkDeleteXLDV', 'xeploai_dvController@bulkDeleteXLDV')->name('xeploai_dv.bulkDeleteXLDV');
//tinh_thanhpho
	Route::resource('/tinh_thanhpho','tinh_thanhphoController');
	Route::post('/tinh_thanhpho/bulkDeleteTP', 'tinh_thanhphoController@bulkDeleteTP')->name('tinh_thanhpho.bulkDeleteTP');

//doankhoa
	Route::resource('/doankhoa','doankhoaController');
	Route::get('/doankhoa_view', 'doankhoaController@doankhoa_view')->name('doankhoa_view');
	Route::post('/doankhoa/bulkDeleteDK', 'doankhoaController@bulkDeleteDK')->name('doankhoa.bulkDeleteDK');
	Route::get('/tk_doanvien_doankhoa','thongkechidoanController@tk_doanvien_doankhoa')->name('tk_doanvien_doankhoa');


//chi doan
	Route::resource('/chidoan','chidoanController');
	Route::get('/index_doankhoa', 'chidoanController@index_doankhoa')->name('index_doankhoa');
	Route::post('/chidoan/bulkDeleteCD', 'chidoanController@bulkDeleteCD')->name('chidoan.bulkDeleteCD');
	Route::resource('/duyet_cd', 'duyet_cdController');
	Route::resource('/huyduyet_cd', 'huyduyet_cdController');
	Route::get('index_chidoan', 'chidoanController@index_chidoan')->name('index_chidoan');
	Route::get('loc_chidoan', 'chidoanController@loc_chidoan')->name('loc_chidoan');

	Route::resource('/quan_huyen','quan_huyenController');
	Route::post('/quan_huyen/bulkDeleteQH', 'quan_huyenController@bulkDeleteQH')->name('quan_huyen.bulkDeleteQH');

	Route::resource('/phuong_xa','phuong_xaController');
	Route::post('/phuong_xa/bulkDeletePX', 'phuong_xaController@bulkDeletePX')->name('phuong_xa.bulkDeletePX');

	Route::resource('/khenthuong_kyluat','khenthuong_kyluatController');
	Route::post('/khenthuong_kyluat/bulkDeleteKTKL', 'khenthuong_kyluatController@bulkDeleteKTKL')->name('khenthuong_kyluat.bulkDeleteKTKL');


	Route::resource('/loai_ktkl','loai_ktklController');
	Route::post('/loai_ktkl/bulkDeleteLKTKL', 'loai_ktklController@bulkDeleteLKTKL')->name('loai_ktkl.bulkDeleteLKTKL');

	Route::resource('/hocky','hockyController');
	Route::post('/hocky/bulkDeleteHK', 'hockyController@bulkDeleteHK')->name('hocky.bulkDeleteHK');

	Route::resource('/pt_chidoan','pt_chidoanController');
	Route::post('/pt_chidoan/bulkDeletePTCD', 'pt_chidoanController@bulkDeletePTCD')->name('pt_chidoan.bulkDeletePTCD');
	Route::get('index_get_hocky_ptcd', 'pt_chidoanController@index_get_hocky_ptcd')->name('index_get_hocky_ptcd');
	Route::get('index_get_hocky_ptcd/get_hocky_ptcd', 'pt_chidoanController@get_hocky_ptcd')->name('pt_chidoan.get_hocky_ptcd');

	Route::resource('/pt_doankhoa','pt_doankhoaController');
	Route::post('/pt_doankhoa/bulkDeletePTDK', 'pt_doankhoaController@bulkDeletePTDK')->name('pt_doankhoa.bulkDeletePTDK');
	Route::get('index_get_hocky_ptdk', 'pt_doankhoaController@index_get_hocky_ptdk')->name('index_get_hocky_ptdk');
	Route::get('index_get_hocky_ptdk/get_hocky_ptdk', 'pt_doankhoaController@get_hocky_ptdk')->name('pt_doankhoa.get_hocky_ptdk');



	Route::resource('/thongkechidoan','thongkechidoanController');
	Route::get('/bieudocot','thongkechidoanController@bieudocot')->name('bieudocot');
	Route::get('/bieudoduong','thongkechidoanController@bieudoduong')->name('bieudoduong');



	Route::resource('/khenthuong_kyluat','khenthuong_kyluatController');
	Route::post('/khenthuong_kyluat/bulkDeleteKTKL', 'khenthuong_kyluatController@bulkDeleteKTKL')->name('khenthuong_kyluat.bulkDeleteKTKL');




	Route::resource('/thangnam','thangnamController');
	Route::post('/thangnam/bulkDeleteTN', 'thangnamController@bulkDeleteTN')->name('thangnam.bulkDeleteTN');

	Route::get('/doanphi_thu_cd', 'doanphi_thu_cdController@index')->name('doanphi_thu_cd.index');
	Route::post('/doanphi_thu_cd/update', 'doanphi_thu_cdController@update')->name('doanphi_thu_cd.update');
	Route::get('/doanphi_thu_cd/getnam', 'doanphi_thu_cdController@getNam')->name('doanphi_thu_cd.getnam');


	Route::get('/doanphi_thu_dk', 'doanphi_thu_dkController@index')->name('doanphi_thu_dk.index');
	Route::post('/doanphi_thu_dk/update', 'doanphi_thu_dkController@update')->name('doanphi_thu_dk.update');
	Route::get('/doanphi_thu_dk/getnam', 'doanphi_thu_dkController@getNam')->name('doanphi_thu_dk.getnam');

	Route::get('/doanphi_thu_dv1', 'doanphi_thu_dv1Controller@index')->name('doanphi_thu_dv1.index');
	Route::post('/doanphi_thu_dv1/update', 'doanphi_thu_dv1Controller@update')->name('doanphi_thu_dv1.update');
	Route::get('/doanphi_thu_dv1/getnam', 'doanphi_thu_dv1Controller@getNam')->name('doanphi_thu_dv1.getnam');
	Route::get('/doanphi_thu_dv1/index_getchidoan', 'doanphi_thu_dv1Controller@index_getchidoan')->name('index.getchidoan');

	Route::get('/doanphi_thu_dv1/index_getchidoan/getchidoan', 'doanphi_thu_dv1Controller@getchidoan')->name('getchidoan');

	Route::get('/doanphi_thu_dv1/index_getdoanvien', 'doanphi_thu_dv1Controller@index_getdoanvien')->name('index.getdoanvien');

	Route::get('doanphi_thu_dv1/index_getdoanvien/getdoanvien', 'doanphi_thu_dv1Controller@getdoanvien')->name('getdoanvien');





	Route::resource('/chucvu_dv','chucvu_dvController');
	Route::post('/chucvu_dv/bulkDeleteCVDV', 'chucvu_dvController@bulkDeleteCVDV')->name('chucvu_dv.bulkDeleteCVDV');

	Route::resource('/phieubau_uutu','phieubau_uutuController');
	Route::post('/phieubau_uutu/bulkDeletePBUT', 'phieubau_uutuController@bulkDeletePBUT')->name('phieubau_uutu.bulkDeletePBUT');

	Route::resource('/quan_huyen','quan_huyenController');
	Route::post('/quan_huyen/bulkDeleteQH', 'quan_huyenController@bulkDeleteQH')->name('quan_huyen.bulkDeleteQH');

	Route::resource('/phuong_xa','phuong_xaController');
	Route::post('/phuong_xa/bulkDeletePX', 'phuong_xaController@bulkDeletePX')->name('phuong_xa.bulkDeletePX');


//Lọc doanvien_thanhnien theo doankhoa, khoa, chidoan với vai trò là admin doantruong
	Route::get('/doanvien_thanhnien/index_getchidoan', 'doanvien_thanhnienController@index_getchidoan')->name('doanvien_thanhnien.index_getchidoan');

	Route::get('/doanvien_thanhnien/index_getchidoan/getchidoan', 'doanvien_thanhnienController@getchidoan')->name('doanvien_thanhnien.getchidoan');

	Route::get('/doanvien_thanhnien/index_getdoanvien/getdoanvien', 'doanvien_thanhnienController@getdoanvien')->name('doanvien_thanhnien.getdoanvien');

//Lọc doanvien_thanhnien theo chidoan với vai trò là admin doankhoa
	Route::get('/doanvien_thanhnien/doankhoa_index_getchidoan', 'doanvien_thanhnienController@doankhoa_index_getchidoan')->name('doanvien_thanhnien.doankhoa_index_getchidoan');

	Route::get('/doanvien_thanhnien/doankhoa_index_getchidoan/doankhoa_getchidoan', 'doanvien_thanhnienController@doankhoa_getchidoan')->name('doanvien_thanhnien.doankhoa_getchidoan');

	Route::get('/doanvien_thanhnien/doankhoa_index_getchidoan/doankhoa_getdoanvien', 'doanvien_thanhnienController@doankhoa_getdoanvien')->name('doanvien_thanhnien.doankhoa_getdoanvien');


//xem thong tin doanvien_thanhnien voi vai tro chi doan
	Route::get('/doanvien_thanhnien/index_chidoan', 'doanvien_thanhnienController@index_chidoan')->name('doanvien_thanhnien.index_chidoan');

//xem thong tin doanvien_thanhnien voi vai tro doan khoa
	Route::get('/doanvien_thanhnien/doankhoa_getdoanvien', 'doanvien_thanhnienController@doankhoa_getdoanvien')->name('doanvien_thanhnien.doankhoa_getdoanvien');



//Loc phuong xa cho doanvien_thanhnien
	Route::get('/doanvien_thanhnien/index_get_quanhuyen', 'doanvien_thanhnienController@index_get_quanhuyen')->name('index_get_quanhuyen');

	Route::get('/doanvien_thanhnien/index_get_quanhuyen/get_quanhuyen', 'doanvien_thanhnienController@get_quanhuyen')->name('get_quanhuyen');

	Route::get('/doanvien_thanhnien/index_get_phuongxa/get_phuongxa', 'doanvien_thanhnienController@get_phuongxa')->name('get_phuongxa');

	Route::resource('/doanvien_thanhnien','doanvien_thanhnienController');
	Route::post('/doanvien_thanhnien/bulkDeleteDVTN', 'doanvien_thanhnienController@bulkDeleteDVTN')->name('doanvien_thanhnien.bulkDeleteDVTN');

	//Thong tin doan vien_thanhnien
	Route::get('/thongtinsinhvien', 'doanvien_thanhnienController@thongtinsinhvien')->name('thongtinsinhvien');


	Route::resource('/phieubau_uutu','phieubau_uutuController');
	Route::post('/phieubau_uutu/bulkDeletePBUT', 'phieubau_uutuController@bulkDeletePBUT')->name('phieubau_uutu.bulkDeletePBUT');




	Route::resource('/thongkechidoan','thongkechidoanController');


	Route::get('export', 'MyController@export')->name('export');
	Route::get('importExportView', 'MyController@importExportView');
	Route::post('import', 'MyController@import')->name('import');
	Route::get('mau', 'MyController@mau')->name('mau');

	Route::get('exportdt', 'MyController@exportdt')->name('exportdt');
	Route::get('importExportViewdt', 'MyController@importExportViewdt');
	Route::post('importdt', 'MyController@importdt')->name('importdt');
	Route::get('maudt', 'MyController@maudt')->name('maudt');

	Route::get('exportdv', 'MyController@exportdv')->name('exportdv');
	Route::get('importExportViewdv', 'MyController@importExportViewdv');
	Route::post('importdv', 'MyController@importdv')->name('importdv');
	Route::get('maudv', 'MyController@maudv')->name('maudv');


	Route::resource('/thanhtich_thamgia','thanhtich_thamgiaController');
	Route::post('/thanhtich_thamgia/bulkDeleteTTTG', 'thanhtich_thamgiaController@bulkDeleteTTTG')->name('thanhtich_thamgia.bulkDeleteTTTG');
	Route::get('/index_getchidoan_tttg', 'thanhtich_thamgiaController@index_getchidoan_tttg')->name('thanhtich_thamgia.index_getchidoan_tttg');

	Route::get('index_getchidoan_tttg/getchidoan_tttg', 'thanhtich_thamgiaController@getchidoan_tttg')->name('thanhtich_thamgia.getchidoan_tttg');

	Route::get('/index_getdoanvien_tttg', 'thanhtich_thamgiaController@index_getdoanvien_tttg')->name('thanhtich_thamgia.index_getdoanvien_tttg');

	Route::get('index_getdoanvien_tttg/getdoanvien_tttg', 'thanhtich_thamgiaController@getdoanvien_tttg')->name('thanhtich_thamgia.getdoanvien_tttg');





	Route::group(['prefix'=>'ajax'], function(){
		Route::get('quan_huyen/{idtentp}','ajaxController@gettenquan_huyen');
	});





	Route::resource('/users','usersController');
	Route::post('/users/bulkDeleteU', 'usersController@bulkDeleteU')->name('users.bulkDeleteU');
		//Lọc user

	Route::get('/index_getchidoan_users', 'usersController@index_getchidoan')->name('users.index_getchidoan');

	Route::get('/index_getchidoan_users/getchidoan', 'usersController@getchidoan')->name('users.getchidoan');

	Route::get('/index_getchidoan_users/getdoanvien', 'usersController@getdoanvien')->name('users.getdoanvien');


	Route::resource('/noidung_pdg','noidung_pdgController');
	Route::post('/noidung_pdg/bulkDeleteNDPDG', 'noidung_pdgController@bulkDeleteNDPDG')->name('noidung_pdg.bulkDeleteNDPDG');

	Route::resource('/ct_chucvu_dv','ct_chucvu_dvController');
	Route::post('/ct_chucvu_dv/bulkDeleteCT_CV_DV', 'ct_chucvu_dvController@bulkDeleteCT_CV_DV')->name('ct_chucvu_dv.bulkDeleteCT_CV_DV');
	Route::get('/index_getchidoan_cv', 'ct_chucvu_dvController@index_getchidoan')->name('ct_chucvu_dv.index_getchidoan_cv');
	Route::get('/ct_chucvu_dv/index_getchidoan/getchidoan', 'ct_chucvu_dvController@getchidoan')->name('ct_chucvu_dv.getchidoan');
	Route::get('/ct_chucvu_dv/index_getdoanvien/getdoanvien', 'ct_chucvu_dvController@getdoanvien')->name('ct_chucvu_dv.getdoanvien');



	Route::resource('/dv_ketnap','dv_ketnapController');
	Route::post('/dv_ketnap/bulkDeleteDV_KN', 'dv_ketnapController@bulkDeleteDV_KN')->name('dv_ketnap.bulkDeleteDV_KN');


	Route::resource('/dv_tt_doan','dv_tt_doanController');
	Route::post('/dv_tt_doan/bulkDeleteDV_TT', 'dv_tt_doanController@bulkDeleteDV_TT')->name('dv_tt_doan.bulkDeleteDV_TT');


	Route::resource('/qd_dv_ketnap','qd_dv_ketnapController');
	Route::resource('/duyet', 'duyetController');
	Route::resource('/huyduyet', 'huyduyetController');
	Route::get('/index_getchidoan_kn', 'qd_dv_ketnapController@index_getchidoan_kn')->name('qd_dv_ketnap.index_getchidoan_kn');
	Route::get('/index_getchidoan_kn/getchidoan_kn', 'qd_dv_ketnapController@getchidoan_kn')->name('qd_dv_ketnap.getchidoan_kn');
	Route::get('/index_getdoanvien_kn/getdoanvien_kn', 'qd_dv_ketnapController@getdoanvien_kn')->name('qd_dv_ketnap.getdoanvien_kn');
	Route::get('loc_ketnap', 'qd_dv_ketnapController@loc_ketnap')->name('loc_ketnap');

	Route::resource('/qd_dv_ttdoan','qd_dv_ttdoanController');
	Route::resource('/duyet_tt', 'duyet_ttController');
	Route::resource('/huyduyet_tt', 'huyduyet_ttController');
	Route::get('/index_getchidoan_tt', 'qd_dv_ttdoanController@index_getchidoan_tt')->name('qd_dv_ttdoan.index_getchidoan_tt');
	Route::get('/index_getchidoan_tt/getchidoan_tt', 'qd_dv_ttdoanController@getchidoan_tt')->name('qd_dv_ttdoan.getchidoan_tt');
	Route::get('/index_getdoanvien_tt/getdoanvien_tt', 'qd_dv_ttdoanController@getdoanvien_tt')->name('qd_dv_ttdoan.getdoanvien_tt');
	Route::get('loc_ttdoan', 'qd_dv_ttdoanController@loc_ttdoan')->name('loc_ttdoan');


	Route::resource('/chitiet_ktkl','chitiet_ktklController');
	Route::resource('/duyet_ktkl', 'duyet_ktklController');
	Route::resource('/huyduyet_ktkl', 'huyduyet_ktklController');



	//chi doan duyet phieu danh gia dv
	Route::get('index_duyet_pdg_dv', 'chitiet_pdg_dvController@index_duyet_pdg_dv')->name('index_duyet_pdg_dv');
	Route::get('ds_duyet_pdg_dv/{id}', 'chitiet_pdg_dvController@ds_duyet_pdg_dv')->name('ds_duyet_pdg_dv');
	Route::get('duyet_pdg_dv/{id}', 'chitiet_pdg_dvController@duyet_pdg_dv')->name('duyet_pdg_dv');
	Route::post('update_duyet_pdg_dv', 'chitiet_pdg_dvController@update')->name('update_duyet_pdg_dv');


	//Route chinh khong the bo

	// Route::get('/index_getchidoan_pdg_dv', 'phieudanhgia_doanvienController@index_getchidoan')->name('phieudanhgia_doanvien.index.getchidoan');

	// Route::get('phieudanhgia_doanvien/index_getchidoan_pdg_dv/getchidoan', 'phieudanhgia_doanvienController@getchidoan')->name('phieudanhgia_doanvien.getchidoan');

	// Route::get('phieudanhgia_doanvien/index_getdoanvien_pdg_dv/getdoanvien', 'phieudanhgia_doanvienController@getdoanvien')->name('phieudanhgia_doanvien.getdoanvien');

//Doan vien tao phieu danh gia
	Route::get('index_create_pdg_dv', 'phieudanhgia_doanvienController@index_create_pdg_dv')->name('index_create_pdg_dv');
	Route::get('ds_pdg_dv', 'phieudanhgia_doanvienController@ds_pdg_dv')->name('ds_pdg_dv');

	Route::get('add_pdg_dv/create/{id}', 'phieudanhgia_doanvienController@create')->name('phieudanhgia_doanvien.create') ;

	Route::post('add_pdg_dv/store/{id}', 'phieudanhgia_doanvienController@store')->name('phieudanhgia_doanvien.store') ;

	Route::get('danhgiadoanvien/{id}', 'phieudanhgia_doanvienController@danhgia')->name('danhgiadoanvien') ;

	Route::post('chitiet_pdg_dv/store/{id}', 'chitiet_pdg_dvController@store')->name('chitiet_pdg_dv.store') ;

	Route::get('ketqua_duyet_pdg_dv/{id}', 'chitiet_pdg_dvController@ketqua_duyet_pdg_dv')->name('ketqua_duyet_pdg_dv');

	//Chi doan tao phieu danh gia
	Route::get('index_create_pdg_cd', 'phieudanhgia_chidoanController@index_create_pdg_cd')->name('index_create_pdg_cd');
	Route::get('ds_pdg_cd', 'phieudanhgia_chidoanController@ds_pdg_cd')->name('ds_pdg_cd');

	Route::get('add_pdg_cd/create/{id}', 'phieudanhgia_chidoanController@create')->name('phieudanhgia_chidoan.create') ;

	Route::post('add_pdg_cd/store/{id}', 'phieudanhgia_chidoanController@store')->name('phieudanhgia_chidoan.store') ;

	Route::get('danhgiachidoan/{id}', 'phieudanhgia_chidoanController@danhgia')->name('danhgiachidoan') ;

	Route::post('chitiet_pdg_cd/store/{id}', 'chitiet_pdg_cdController@store')->name('chitiet_pdg_cd.store') ;
	Route::get('ketqua_duyet_pdg_cd/{id}', 'chitiet_pdg_cdController@ketqua_duyet_pdg_cd')->name('ketqua_duyet_pdg_cd');

	//doan khoa duyet phieu danh gia cd
	Route::get('index_duyet_pdg_cd', 'chitiet_pdg_cdController@index_duyet_pdg_cd')->name('index_duyet_pdg_cd');
	Route::get('ds_duyet_pdg_cd/{id}', 'chitiet_pdg_cdController@ds_duyet_pdg_cd')->name('ds_duyet_pdg_cd');
	Route::get('duyet_pdg_cd/{id}', 'chitiet_pdg_cdController@duyet_pdg_cd')->name('duyet_pdg_cd');
	Route::post('update_duyet_pdg_cd', 'chitiet_pdg_cdController@update')->name('update_duyet_pdg_cd');


		//Doan khoa tao phieu danh gia
	Route::get('index_create_pdg_dk', 'phieudanhgia_doankhoaController@index_create_pdg_dk')->name('index_create_pdg_dk');
	Route::get('ds_pdg_dk', 'phieudanhgia_doankhoaController@ds_pdg_dk')->name('ds_pdg_dk');

	Route::get('add_pdg_dk/create/{id}', 'phieudanhgia_doankhoaController@create')->name('phieudanhgia_doankhoa.create') ;

	Route::post('add_pdg_dk/store/{id}', 'phieudanhgia_doankhoaController@store')->name('phieudanhgia_doankhoa.store') ;

	Route::get('danhgiadoankhoa/{id}', 'phieudanhgia_doankhoaController@danhgia')->name('danhgiadoankhoa') ;

	Route::post('chitiet_pdg_dk/store/{id}', 'chitiet_pdg_dkController@store')->name('chitiet_pdg_dk.store') ;
	Route::get('ketqua_duyet_pdg_dk/{id}', 'chitiet_pdg_dkController@ketqua_duyet_pdg_dk')->name('ketqua_duyet_pdg_dk');

	//doan truong duyet phieu danh gia dk
	Route::get('index_duyet_pdg_dk', 'chitiet_pdg_dkController@index_duyet_pdg_dk')->name('index_duyet_pdg_dk');
	Route::get('ds_duyet_pdg_dk/{id}', 'chitiet_pdg_dkController@ds_duyet_pdg_dk')->name('ds_duyet_pdg_dk');
	Route::get('duyet_pdg_dk/{id}', 'chitiet_pdg_dkController@duyet_pdg_dk')->name('duyet_pdg_dk');
	Route::post('update_duyet_pdg_dk', 'chitiet_pdg_dkController@update')->name('update_duyet_pdg_dk');


	// //Quan ly user
	// Route::resource('users', 'usersController');
	// 	// Route::post('/users/bulkDeleteU', 'usersController@bulkDeleteU')->name('users.bulkDeleteU');
	// Route::get('/index_getchidoan_users', 'usersController@index_getchidoan')->name('users.index_getchidoan');

	// Route::get('/index_getchidoan_users/getchidoan', 'usersController@getchidoan')->name('users.getchidoan');

	// Route::get('/index_getchidoan_users/getdoanvien', 'usersController@getdoanvien')->name('users.getdoanvien');

//Thong ke doan phi da dong theo nam cua doan khoa, chi doan, doan vien
	Route::get('tong_tien_theonam','doanphi_thu_dkController@tong_tien_theonam')->name('tong_tien_theonam');
	Route::get('/tong_tien_theonam/tong_tien_loc_theonam','doanphi_thu_dkController@tong_tien_loc_theonam')->name('tong_tien_loc_theonam');


	Route::get('tong_tien_theonam_cd','doanphi_thu_cdController@tong_tien_theonam_cd')->name('tong_tien_theonam_cd');
	Route::get('/tong_tien_theonam_cd/tong_tien_loc_theonam_cd','doanphi_thu_cdController@tong_tien_loc_theonam_cd')->name('tong_tien_loc_theonam_cd');



	Route::get('tong_tien_theonam_dv','doanphi_thu_dv1Controller@tong_tien_theonam_dv')->name('tong_tien_theonam_dv');
	Route::get('/tong_tien_theonam_dv/tong_tien_loc_theonam_dv','doanphi_thu_dv1Controller@tong_tien_loc_theonam_dv')->name('tong_tien_loc_theonam_dv');


//bieu do cot chong doan phi thu doan khoa, chi doan, doan vien
	Route::get('bieudocotchong_dk','doanphi_thu_dkController@bieudocotchong_dk')->name('bieudocotchong_dk');
	Route::get('/bieudocotchong_dk/bieudocotchong_theonam_dk','doanphi_thu_dkController@bieudocotchong_theonam_dk')->name('bieudocotchong_theonam_dk');



	Route::get('bieudocotchong_cd','doanphi_thu_cdController@bieudocotchong_cd')->name('bieudocotchong_cd');
	Route::get('/bieudocotchong_cd/bieudocotchong_theonam_cd','doanphi_thu_cdController@bieudocotchong_theonam_cd')->name('bieudocotchong_theonam_cd');



	Route::get('bieudocotchong_dv','doanphi_thu_dv1Controller@bieudocotchong_dv')->name('bieudocotchong_dv');
	Route::get('/bieudocotchong_dv/bieudocotchong_theonam_dv','doanphi_thu_dv1Controller@bieudocotchong_theonam_dv')->name('bieudocotchong_theonam_dv');
//phieu chi


	Route::resource('/phieuchi_chi_cd','phieuchi_chi_cdController');
	Route::resource('/index_cd','phieuchi_chi_cdController_2');
	Route::resource('/duyet_pccd', 'duyet_pccdController');
	Route::resource('/huyduyet_pccd', 'huyduyet_pccdController');
	Route::resource('/khongduyet_pccd', 'khongduyet_pccdController');
	Route::get('/index_gethocky_pccd', 'phieuchi_chi_cdController@index_gethocky_pccd')->name('phieuchi_chi_cd.index_gethocky_pccd');
	Route::get('/index_gethocky_pccd/gethocky_pccd', 'phieuchi_chi_cdController@gethocky_pccd')->name('phieuchi_chi_cd.gethocky_pccd');
	Route::get('/index_gethocky_pccd/getpt_pccd', 'phieuchi_chi_cdController@getpt_pccd')->name('phieuchi_chi_cd.getpt_pccd');


	Route::resource('/phieuchi_dk','phieuchi_dkController');
	Route::resource('/index_dk','phieuchi_dkController_2');
	Route::resource('/duyet_pcdk', 'duyet_pcdkController');
	Route::resource('/huyduyet_pcdk', 'huyduyet_pcdkController');
	Route::resource('/khongduyet_pcdk', 'khongduyet_pcdkController');
	Route::get('/index_gethocky_pcdk', 'phieuchi_dkController@index_gethocky_pcdk')->name('phieuchi_dk.index_gethocky_pcdk');
	Route::get('/index_gethocky_pcdk/gethocky_pcdk', 'phieuchi_dkController@gethocky_pcdk')->name('phieuchi_dk.gethocky_pcdk');
	Route::get('/index_gethocky_pcdk/getpt_pcdk', 'phieuchi_dkController@getpt_pcdk')->name('phieuchi_dk.getpt_pcdk');
Route::get('loc_phieuchi_dk','phieuchi_dkController@loc_phieuchi_dk')->name('loc_phieuchi_dk');



//bau doan vien uu tu
	Route::resource('/chitiet_bau_ut','chitiet_bau_utController');
	Route::resource('/duyet_bau', 'duyet_bauController');
	Route::resource('/huyduyet_bau', 'huyduyet_bauController');
	Route::get('/getnam_ctbau', 'chitiet_bau_utController@getnam_ctbau')->name('chitiet_bau_ut.getnam_ctbau');
	Route::get('/doankhoa_index_getchidoan_ctbau', 'chitiet_bau_utController@doankhoa_index_getchidoan_ctbau')->name('doankhoa_index_getchidoan_ctbau');
	Route::get('/doankhoa_getchidoan_ctbau', 'chitiet_bau_utController@doankhoa_getchidoan_ctbau')->name('doankhoa_getchidoan_ctbau');
	Route::get('/doankhoa_getctbau', 'chitiet_bau_utController@doankhoa_getctbau')->name('doankhoa_getctbau');


//chi tiet mau phieu
	Route::resource('ct_mp','ct_mpController');
	Route::post('bulkDeleteCTMP', 'ct_mpController@bulkDeleteCTMP')->name('ct_mp.bulkDeleteCTMP');
	Route::get('/index_get_noidung_ctmp', 'ct_mpController@index_get_noidung_ctmp')->name('index_get_noidung_ctmp');
	Route::get('/get_noidung_ctmp', 'ct_mpController@get_noidung_ctmp')->name('get_noidung_ctmp');

	
//thong ke so luong sinh vien doan vien cua khoa
	Route::get('/tk_doanvien_doankhoa','thongkechidoanController@tk_doanvien_doankhoa')->name('tk_doanvien_doankhoa');

	Route::get('/tk_sinhvien_doankhoa','thongkechidoanController@tk_sinhvien_doankhoa')->name('tk_sinhvien_doankhoa');

//Thong ke doan vien sinh vien theo que quan, noi sinh, dan toc, ton giao
	Route::get('/thongke_quequan','doanvien_thanhnienController@thongke_quequan')->name('thongke_quequan');
	Route::get('/thongke_noisinh','doanvien_thanhnienController@thongke_noisinh')->name('thongke_noisinh');
	Route::get('/thongke_dantoc','doanvien_thanhnienController@thongke_dantoc')->name('thongke_dantoc');
	Route::get('/thongke_tongiao','doanvien_thanhnienController@thongke_tongiao')->name('thongke_tongiao');

	Route::get('/thongke_quequan_dv','doanvien_thanhnienController@thongke_quequan_dv')->name('thongke_quequan_dv');
	Route::get('/thongke_noisinh_dv','doanvien_thanhnienController@thongke_noisinh_dv')->name('thongke_noisinh_dv');
	Route::get('/thongke_dantoc_dv','doanvien_thanhnienController@thongke_dantoc_dv')->name('thongke_dantoc_dv');
	Route::get('/thongke_tongiao_dv','doanvien_thanhnienController@thongke_tongiao_dv')->name('thongke_tongiao_dv');


//Thong ke xep loai doan vien
	Route::get('thongke_xeploai_dv','phieudanhgia_doanvienController@thongke_xeploai_dv')->name('thongke_xeploai_dv');
	Route::get('/thongke_xeploai_dv/thongke_xeploai_theonam_dv','phieudanhgia_doanvienController@thongke_xeploai_theonam_dv')->name('thongke_xeploai_theonam_dv');

//Thong ke xep loai chi doan
	Route::get('thongke_xeploai_cd','phieudanhgia_chidoanController@thongke_xeploai_cd')->name('thongke_xeploai_cd');
	Route::get('/thongke_xeploai_cd/thongke_xeploai_theonam_cd','phieudanhgia_chidoanController@thongke_xeploai_theonam_cd')->name('thongke_xeploai_theonam_cd');

//Thong ke xep loai doan khoa
	Route::get('thongke_xeploai_dk','phieudanhgia_doankhoaController@thongke_xeploai_dk')->name('thongke_xeploai_dk');
	Route::get('/thongke_xeploai_dk/thongke_xeploai_theonam_dk','phieudanhgia_doankhoaController@thongke_xeploai_theonam_dk')->name('thongke_xeploai_theonam_dk');

//Thong ke thuchi chi doan, doan khoa
	Route::get('thongke_thuchi_cd','doanphi_thu_cdController@thongke_thuchi_cd')->name('thongke_thuchi_cd');
	Route::get('/thongke_thuchi_cd/thongke_thuchi_theonam_cd','doanphi_thu_cdController@thongke_thuchi_theonam_cd')->name('thongke_thuchi_theonam_cd');

	Route::get('thongke_thuchi_dk','doanphi_thu_dkController@thongke_thuchi_dk')->name('thongke_thuchi_dk');
	Route::get('/thongke_thuchi_dk/thongke_thuchi_theonam_dk','doanphi_thu_dkController@thongke_thuchi_theonam_dk')->name('thongke_thuchi_theonam_dk');

	// Route::resource('tim_kiem','tim_kiemController');
	Route::get('/home', function () {
		return view('layout.home');
	})->name('home');
	Route::get('trangchu','trangchuController@index')->name('trangchu');
	Route::get('/trangchu/thongke_ptcd_loc_theonam','trangchuController@thongke_ptcd_loc_theonam')->name('thongke_ptcd_loc_theonam');
	Route::get('/trangchu/thongke_ptdk_loc_theonam','trangchuController@thongke_ptdk_loc_theonam')->name('thongke_ptdk_loc_theonam');

	
	Route::get('tim_kiem','tim_kiemController@index')->name('tim_kiem');
	Route::post('get_timkiem','tim_kiemController@get_timkiem')->name('get_timkiem');
	Route::post('get_timkiem_dk','tim_kiemController@get_timkiem_dk')->name('get_timkiem_dk');


	// Route::get('thongkephongtrao','thongkephongtraoController@index')->name('thongkephongtrao');
	// Route::get('/thongkephongtrao/thongke_ptcd_loc_theonam','thongkephongtraoController@thongke_ptcd_loc_theonam')->name('thongke_ptcd_loc_theonam');
	// Route::get('/thongkephongtrao/thongke_ptdk_loc_theonam','thongkephongtraoController@thongke_ptdk_loc_theonam')->name('thongke_ptdk_loc_theonam');
	// Route::get('fulltim','fulltimController@index')->name('fulltim');
	// Route::post('get_fulltim','fulltimController@get_fulltim')->name('get_fulltim');
});

// Route::get('tim_kiem', function () {
// 	return view('layout.tim_kiem');
// });


// Route::get('timkiem','timkiemController@index')->name('timkiem');
	// Route::post('timkiem/gettimkiem','timkiemController@gettimkiem')->name('gettimkiem');
route::get('luu', 'ct_mpController@luu')->name('luu');
