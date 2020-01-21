<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chidoan extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chidoan';
	protected $fillable     =['TEN_CD','DOANKHOA_ID','KHOA_ID', 'NGAY_THANHLAP'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function doankhoa()
	{
		return $this->belongsTo('App\doankhoa', 'DOANKHOA_ID', 'ID');
	}

	public function khoa()
	{
		return $this->belongsTo('App\khoa', 'KHOA_ID', 'ID');
	}

	public function phieuchi_chi_cds()
	{
		return $this->hasMany('App\phieuchi_chi_cd', 'CHIDOAN_ID', 'ID');
	}

	public function phieubau_uutus()
	{
		return $this->hasMany('App\phieubau_uutu', 'CHIDOAN_ID', 'ID');
	}

	public function pt_chidoans()
	{
		return $this->hasMany('App\pt_chidoan', 'CHIDOAN_ID', 'ID');
	}

	public function doanphi_thu_cds()
	{
		return $this->hasMany('App\doanphi_thu_cd', 'CHIDOAN_ID', 'ID');
	}

	public function phieudanhgia_chidoans()
	{
		return $this->hasMany('App\phieudanhgia_chidoan', 'CHIDOAN_ID', 'ID');
	}

	public function doanvien_thanhniens()
	{
		return $this->hasMany('App\doanvien_thanhnien', 'CHIDOAN_ID', 'ID');
	}
}
