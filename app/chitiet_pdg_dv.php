<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiet_pdg_dv extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chitiet_pdg_dv';
	protected $fillable     =['PHIEUDANHGIA_DOANVIEN_ID','NOIDUNG_PDG_ID','DUYET_PDG_DV', 'NOIDUNG_TU_DANHGIA', 'GHICHU_PDGDV'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function phieudanhgia_doanvien()
	{
		return $this->belongsTo('App\phieudanhgia_doanvien', 'PHIEUDANHGIA_DOANVIEN_ID', 'ID');
	}

	public function noidung_pdg()
	{
		return $this->belongsTo('App\noidung_pdg', 'NOIDUNG_PDG_ID', 'ID');
	}
}
