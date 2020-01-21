<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class noidung_pdg extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'noidung_pdg';
	protected $fillable     =['TEN_NDPDG', 'NOIDUNG_NDPDG', 'DIEMTOIDA_NDPDG'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function loai_noidung_pdg()
	{
		return $this->belongsTo('App\loai_noidung_pdg','LOAI_NOIDUNG_PDG_ID', 'ID');
	}
	public function noidung_pdg()
	{
		return $this->belongsTo('App\noidung_pdg', 'NOIDUNG_PDG_ID_CHA', 'ID');
	}

	public function kieu_dulieu()
	{
		return $this->belongsTo('App\kieu_dulieu', 'KIEU_DULIEU_ID', 'ID');
	}


	public function chitiet_pdg_dvs()
	{
		return $this->hasMany('App\chitiet_pdg_dv', 'NOIDUNG_PDG_ID', 'ID');
	}

	public function chitiet_pdg_cds()
	{
		return $this->hasMany('App\chitiet_pdg_cd', 'NOIDUNG_PDG_ID', 'ID');
	}

	public function chitiet_pdg_dks()
	{
		return $this->hasMany('App\chitiet_pdg_dk', 'NOIDUNG_PDG_ID', 'ID');
	}

	public function chitiet_mauphieus()
	{
		return $this->hasMany('App\chitiet_mauphieu', 'NOIDUNG_PDG_ID', 'ID');
	}
}
