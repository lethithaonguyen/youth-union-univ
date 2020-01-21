<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieubau_uutu extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieubau_uutu';
	protected $fillable     =['SOPHIEU_TONG', 'NGAY_BAU'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function chitiet_bau_uts()
	{
		return $this->hasMany('App\chitiet_bau_ut', 'PHIEUBAU_UUTU_ID', 'ID');
	}

	public function chidoan()
	{
		return $this->belongsTo('App\chidoan', 'CHIDOAN_ID', 'ID');
	}


	public function doanvien_thanhnien()

	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

}
