<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doankhoa extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'doankhoa';
	protected $fillable     =['TEN_DK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function chidoans()
	{
		return $this->hasMany('App\chidoan', 'DOANKHOA_ID', 'ID');
	}

	public function pt_doankhoas()
	{
		return $this->hasMany('App\pt_doankhoa', 'DOANKHOA_ID', 'ID');
	}

	public function phieuchi_dks()
	{
		return $this->hasMany('App\phieuchi_dk', 'DOANKHOA_ID', 'ID');
	}

	public function doanphi_thu_dks()
	{
		return $this->hasMany('App\doanphi_thu_dk', 'DOANKHOA_ID', 'ID');
	}

		public function phieudanhgia_doankhoas()
	{
		return $this->hasMany('App\phieudanhgia_doankhoa', 'DOANKHOA_ID', 'ID');
	}


}
