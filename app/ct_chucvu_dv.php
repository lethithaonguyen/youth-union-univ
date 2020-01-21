<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ct_chucvu_dv extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'ct_chucvu_dv';
	protected $fillable     =['NGAYBD_CV', 'NGAYKT_CV'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function chucvu_dv()
	{
		return $this->belongsTo('App\chucvu_dv', 'CHUCVU_DV_ID', 'ID');
	}
}
