<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieuchi_dk extends Model
{
    const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieuchi_dk';
	protected $fillable     =['NOIDUNG_PC_DK', 'SOTIEN_CHI_DK', 'NGAY_CHI_DK'];
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


	public function pt_doankhoa()
	{
		return $this->belongsTo('App\pt_doankhoa', 'PT_DOANKHOA_ID', 'ID');
	}


	public function doankhoa()
	{
		return $this->belongsTo('App\doankhoa', 'DOANKHOA_ID', 'ID');
	}
}
