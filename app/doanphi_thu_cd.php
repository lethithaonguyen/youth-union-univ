<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doanphi_thu_cd extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'doanphi_thu_cd';
	protected $fillable     =['NGAY_DONG_CD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function chidoan()
	{
		return $this->belongsTo('App\chidoan', 'CHIDOAN_ID', 'ID');
	}

	public function thangnam()
	{
		return $this->belongsTo('App\thangnam', 'THANGNAM_ID', 'ID');
	}

}
