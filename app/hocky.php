<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocky extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'hocky';
	protected $fillable     =['TEN_HK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function pt_doankhoas()
	{
		return $this->hasMany('App\pt_doankhoa', 'HOCKY_ID', 'ID');
	}

		public function pt_chidoans()
	{
		return $this->hasMany('App\pt_chidoan', 'HOCKY_ID', 'ID');
	}

		public function namhoc()
	{
		return $this->belongsTo('App\namhoc', 'NAMHOC_ID', 'ID');
	}
}
