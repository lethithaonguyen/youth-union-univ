<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiet_pdg_dk extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chitiet_pdg_dk';
	protected $fillable     =['DIEM_DUYET_PDGDK', 'DIEM_DK_TUDANHGIA', 'GHICHU_PDGDK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function phieudanhgia_doankhoa()
	{
		return $this->belongsTo('App\phieudanhgia_doankhoa', 'PHIEUDANHGIA_DOANKHOA_ID', 'ID');
	}

	public function noidung_pdg()
	{
		return $this->belongsTo('App\noidung_pdg', 'NOIDUNG_PDG_ID', 'ID');
	}
}
