<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quan_huyen extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'quan_huyen';
	protected $fillable     =['TEN_QD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function tinh_thanhpho()
	{
		return $this->belongsTo('App\tinh_thanhpho', 'TINH_THANHPHO_ID', 'ID');
	}

	public function phuong_xas()
	{
		return $this->hasMany('App\phuong_xa', 'QUAN_HUYEN_ID', 'ID');
	}
}
