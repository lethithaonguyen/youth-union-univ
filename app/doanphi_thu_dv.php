<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doanphi_thu_dv extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'doanphi_thu_dv';
	protected $fillable     =['NGAY_DONG_DP_DV'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function thangnam()
	{
		return $this->belongsTo('App\thangnam', 'THANGNAM_ID', 'ID');
	}
}
