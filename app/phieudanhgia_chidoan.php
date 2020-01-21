<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieudanhgia_chidoan extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieudanhgia_chidoan';
	protected $fillable     =['TEN_PDGCD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function xeploai_cd()
	{
		return $this->belongsTo('App\xeploai_cd', 'XEPLOAI_CD', 'ID');
	}

	public function chidoan()
	{
		return $this->belongsTo('App\chidoan', ' CHIDOAN_ID', 'ID');
	}


	public function namhoc()
	{
		return $this->belongsTo('App\namhoc', ' NAMHOC_ID', 'ID');
	}


	public function mauphieu()
	{
		return $this->belongsTo('App\mauphieu', 'MAUPHIEU_ID', 'ID');
	}


	public function chitiet_pdg_cds()
	{
		return $this->hasMany('App\chitiet_pdg_cd', 'PHIEUDANHGIA_CHIDOAN_ID', 'ID');
	}
}
