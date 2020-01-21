<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiet_bau_ut extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chitiet_bau_ut';
	protected $fillable     =['SOPHIEU_DONGY', 'DUYET_BAU'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function phieudanhgia_doanvien()
	{
		return $this->belongsTo('App\phieudanhgia_doanvien', 'PHIEUDANHGIA_DOANVIEN_ID', 'ID');
	}

	public function phieubau_uutu()
	{
		return $this->belongsTo('App\phieubau_uutu', 'PHIEUBAU_UUTU_ID', 'ID');
	}
}
