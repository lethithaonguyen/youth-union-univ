<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dv_tt_doan extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'dv_tt_doan';
	protected $fillable     =['NGAYTTDOAN'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function qd_dv_ttdoans()
	{
		return $this->hasMany('App\qd_dv_ttdoan', 'DV_TT_DOAN_ID', 'ID');
	}

	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

}
