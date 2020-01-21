<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dv_ketnap extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'dv_ketnap';
	protected $fillable     =['NGAYKETNAP'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function qd_dv_ketnaps()
	{
		return $this->hasMany('App\qd_dv_ketnap', 'DV_KETNAP_ID', 'ID');
	}

		public function doanvien_thanhnien()

	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}


}
