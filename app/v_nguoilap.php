<?php

namespace App;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
// use Nicolaslopezj\Searchable\SearchableTrait;


class v_nguoilap extends Model
{

	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'v_nguoilap';
	protected $fillable     =['TEN_SV' ,'MSSV', 'NGAYSINH_SV', 'DIACHI_SV', 'PHAI_SV', 'SDT_SV','EMAIL_SV', 'NGAYVAODOAN_SV', 'NOIVAODOAN_SV','PHUONG_XA_ID_QQ','PHUONG_XA_ID_NS','DANTOC_ID','TONGIAO_ID','CHIDOAN_ID','TEN_LAP'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	
	public function phuong_xa()
	{
		return $this->belongsTo('App\phuong_xa', 'PHUONG_XA_ID_NS', 'ID');
	}

	public function chidoan()
	{
		return $this->belongsTo('App\chidoan', 'CHIDOAN_ID', 'ID');
	}

	public function tongiao()
	{
		return $this->belongsTo('App\tongiao', 'TONGIAO_ID', 'ID');
	}
	public function dantoc()
	{
		return $this->belongsTo('App\dantoc', 'DANTOC_ID', 'ID');
	}

	
	public function phieuchi_dks()
	{
		return $this->hasMany('App\phieuchi_dk', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}


	// public function phieuchi_dks()
	// {
	// 	return $this->hasMany('App\phieuchi_dk', 'DOANVIEN_THANHNIEN_ID', 'ID');
	// }

	public function ct_chucvu_cvs()
	{
		return $this->hasMany('App\ct_chucvu_cv', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function phieuchi_chi_cds()
	{
		return $this->hasMany('App\phieuchi_chi_cd', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function thanhtich_thamgias()
	{
		return $this->hasMany('App\thanhtich_thamgia', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function phieudanhgia_doanviens()
	{
		return $this->hasMany('App\phieudanhgia_doanvien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function chitiet_ktkls()
	{
		return $this->hasMany('App\chitiet_ktkl', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function doanphi_thu_dvs()
	{
		return $this->hasMany('App\doanphi_thu_dv', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function qd_dv_ttdoans()
	{
		return $this->hasMany('App\qd_dv_ttdoan', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function qd_dv_ketnaps()
	{
		return $this->hasMany('App\qd_dv_ketnap', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}
	public function co_vaitros()
	{
		return $this->hasMany('App\co_vaitro', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}


	public function phieubau_uutus()
	{
		return $this->hasMany('App\phieubau_uutu', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function khenthuong_kyluats()
	{
		return $this->hasMany('App\khenthuong_kyluat', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function dv_ketnaps()
	{
		return $this->hasMany('App\dv_ketnap', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}
	public function dv_tt_doans()
	{
		return $this->hasMany('App\dv_tt_doan', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}
}
