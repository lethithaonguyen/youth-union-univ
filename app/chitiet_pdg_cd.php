<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiet_pdg_cd extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chitiet_pdg_cd';
	protected $fillable     =['DIEM_DUYET_PDGCD', 'DIEM_CD_TUDANHGIA', 'GHICHU_PDGCD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function phieudanhgia_chidoan()
	{
		return $this->belongsTo('App\phieudanhgia_chidoan', 'PHIEUDANHGIA_CHIDOAN_ID', 'ID');
	}

	public function noidung_pdg()
	{
		return $this->belongsTo('App\noidung_pdg', 'NOIDUNG_PDG_ID', 'ID');
	}
}
