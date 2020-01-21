<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiet_mauphieu extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chitiet_mauphieu';
	protected $fillable     =['THUTU_NOIDUNG'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function mauphieu()
	{
		return $this->belongsTo('App\mauphieu', 'MAUPHIEU_ID', 'ID');
	}

	public function noidung_pdg()
	{
		return $this->belongsTo('App\noidung_pdg', 'NOIDUNG_PDG_ID', 'ID');
	}
}
