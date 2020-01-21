<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phuong_xa extends Model
{
    const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phuong_xa';
	protected $fillable     =['TEN_PX'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function quan_huyen()
	{
		return $this->belongsTo('App\quan_huyen', 'QUAN_HUYEN_ID', 'ID');
	}

	public function doanvien_thanhniens()
	{
		return $this->hasMany('App\doanvien_thanhnien', 'PHUONG_XA_ID_QQ', 'ID');
	}
}
