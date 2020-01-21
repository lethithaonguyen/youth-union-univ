<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class phieudanhgia_doanvien extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieudanhgia_doanvien';
	protected $fillable     =['TEN_PDGDV', 'DIEMRENLUYEN_HK1', 'DIEMRENLUYEN_HK2', 'DIEMTRUNGBINH_HK1', 'DIEMTRUNGBINH_HK2'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN', 'ID');
	}

	public function xeploai_dv()
	{
		return $this->belongsTo('App\xeploai_dv', ' XEPLOAI_DV_ID', 'ID');
	}


	public function namhoc()
	{
		return $this->belongsTo('App\namhoc', ' NAMHOC_ID', 'ID');
	}


	public function mauphieu()
	{
		return $this->belongsTo('App\mauphieu', 'MAUPHIEU_ID', 'ID');
	}


	public function chitiet_pdg_dvs()
	{
		return $this->hasMany('App\chitiet_pdg_dv', 'PHIEUDANHGIA_DOANVIEN_ID', 'ID');
	}

	public function chitiet_bau_uts()
	{
		return $this->hasMany('App\chitiet_bau_ut', 'PHIEUDANHGIA_DOANVIEN_ID', 'ID');
	}
}
