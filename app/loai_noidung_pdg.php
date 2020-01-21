<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai_noidung_pdg extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'loai_noidung_pdg';
	protected $fillable     =['TEN_LOAI_NDPDG'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function noidung_pdgs()
	{
		return $this->hasMany('App\noidung_pdg', 'LOAI_NOIDUNG_PDG_ID', 'ID');
	}

}
