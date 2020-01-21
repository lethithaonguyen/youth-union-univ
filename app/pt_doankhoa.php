<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pt_doankhoa extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'pt_doankhoa';
	protected $fillable     =['TEN_PT_DK', 'NGAY_BD_PT_DK', 'NGAY_KT_PT_DK', 'GHICHU_PT_DK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function doankhoa()
	{
		return $this->belongsTo('App\doankhoa', 'DOANKHOA_ID', 'ID');
	}

	public function loai_pt()
	{
		return $this->belongsTo('App\loai_pt', 'LOAI_PT_ID', 'ID');
	}

	public function hocky()
	{
		return $this->belongsTo('App\hocky', 'HOCKY_ID', 'ID');
	}

	public function phieuchi_dks()
	{
		return $this->hasMany('App\phieuchi_dk', 'PT_DOANKHOA_ID', 'ID');
	}

	public function thanhtich_thamgias()
	{
		return $this->hasMany('App\thanhtich_thamgia', 'PT_DOANKHOA_ID', 'ID');
	}
}
