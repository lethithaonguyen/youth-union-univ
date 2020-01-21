<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thangnam extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'thangnam';
	protected $fillable     =['THANGNAM', 'SOTIEN_DOANPHI'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function namhoc()
	{
		return $this->belongsTo('App\namhoc', 'NAMHOC_ID', 'ID');
	}

	public function doanphi_thu_dvs()
	{
		return $this->hasMany('App\doanphi_thu_dv', 'THANGNAM_ID', 'ID');
	}

	public function doanphi_thu_cds()
	{
		return $this->hasMany('App\doanphi_thu_cds', 'THANGNAM_ID', 'ID');
	}

	public function doanphi_thu_dks()
	{
		return $this->hasMany('App\doanphi_thu_dk', 'THANGNAM_ID', 'ID');
	}
}
