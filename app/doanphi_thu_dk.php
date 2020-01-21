<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doanphi_thu_dk extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'doanphi_thu_dk';
	protected $fillable     =['NGAY_DONG_DK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function doankhoa()
	{
		return $this->belongsTo('App\doankhoa', 'DOANKHOA_ID', 'ID');
	}

	public function thangnam()
	{
		return $this->belongsTo('App\thangnam', 'THANGNAM_ID', 'ID');
	}
}
