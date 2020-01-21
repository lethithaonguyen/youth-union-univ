<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qd_dv_ttdoan extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'qd_dv_ttdoan';
	protected $fillable     =['DUYET_TTD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function dv_tt_doan()
	{
		return $this->belongsTo('App\dv_tt_doan', 'DV_TT_DOAN_ID', 'ID');
	}

	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}
}
