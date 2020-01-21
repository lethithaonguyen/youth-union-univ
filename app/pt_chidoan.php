<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pt_chidoan extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'pt_chidoan';
	protected $fillable     =['TEN_PT_CD', 'NGAY_BD_PT_CD', 'NGAY_KT_PT_CD', 'GHICHU_PT_CD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function hocky()
	{
		return $this->belongsTo('App\hocky', 'HOCKY_ID', 'ID');
	}

	public function loai_pt()
	{
		return $this->belongsTo('App\loai_pt', 'LOAI_PT_ID', 'ID');
	}

	public function chidoan()
	{
		return $this->belongsTo('App\chidoan', 'CHIDOAN_ID', 'ID');
	}

	public function phieuchi_chi_cds()
	{
		return $this->hasMany('App\phieuchi_chi_cd', 'PT_CHIDOAN_ID', 'ID');
	}

}
