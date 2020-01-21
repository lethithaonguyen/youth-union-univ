<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class namhoc extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'namhoc';
	protected $fillable     =['TEN_NH'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function thangnams()
	{
		return $this->hasMany('App\thangnam', 'NAMHOC_ID', 'ID');
	}

	public function hockys()
	{
		return $this->hasMany('App\hocky', 'NAMHOC_ID', 'ID');
	}

	public function phieudanhgia_doanviens()
	{
		return $this->hasMany('App\phieudanhgia_doanvien', 'NAMHOC_ID','ID');
	}

	public function phieudanhgia_doankhoas()
	{
		return $this->hasMany('App\phieudanhgia_doankhoa', 'NAMHOC_ID', 'ID');
	}

	public function phieudanhgia_chidoans()
	{
		return $this->hasMany('App\phieudanhgia_chidoan', 'NAMHOC_ID', 'ID');
	}
}
