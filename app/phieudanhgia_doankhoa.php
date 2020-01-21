<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class phieudanhgia_doankhoa extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieudanhgia_doankhoa';
	protected $fillable     =['TEN_PDGDK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function xeploai_dk()
	{
		return $this->belongsTo('App\xeploai_dk', 'XEPLOAI_DK', 'ID');
	}

	public function doankhoa()
	{
		return $this->belongsTo('App\doankhoa', ' DOANKHOA_ID', 'ID');
	}


	public function namhoc()
	{
		return $this->belongsTo('App\namhoc', ' NAMHOC_ID', 'ID');
	}


	public function mauphieu()
	{
		return $this->belongsTo('App\mauphieu', 'MAUPHIEU_ID', 'ID');
	}


	public function chitiet_pdg_dks()
	{
		return $this->hasMany('App\chitiet_pdg_dk', 'PHIEUDANHGIA_DOANKHOA_ID', 'ID');
	}
}
