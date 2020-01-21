<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieuchi_chi_cd extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieuchi_chi_cd';
	protected $fillable     =['NOIDUNG_PC_CD', 'SOTIEN_CHI_CD', 'NGAY_CHI_CD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function loai_noidung_chi()
	{
		return $this->belongsTo('App\loai_noidung_chi', 'LOAI_NOIDUNG_CHI_ID', 'ID');
	}

	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', ' DOANVIEN_THANHNIEN_ID_NHAN', 'ID');
	}


	// public function doanvien_thanhnien()
	// {
	// 	return $this->belongsTo('App\doanvien_thanhnien', ' DOANVIEN_THANHNIEN_ID_TAO', 'ID');
	// }


	public function pt_chidoan()
	{
		return $this->belongsTo('App\pt_chidoan', 'PT_CHIDOAN_ID', 'ID');
	}


	public function chidoan()
	{
		return $this->belongsTo('App\chidoan', 'CHIDOAN_ID', 'ID');
	}

}
