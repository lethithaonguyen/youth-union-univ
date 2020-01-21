<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai_noidung_chi extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'loai_noidung_chi';
	protected $fillable     =['TEN_LOAI_DP'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function phieuchi_dks()
	{
		return $this->hasMany('App\phieuchi_dk', 'LOAI_NOIDUNG_CHI_ID', 'ID');
	}

		public function phieuchi_chi_cds()
	{
		return $this->hasMany('App\phieuchi_chi_cd', 'LOAI_NOIDUNG_CHI_ID', 'ID');
	}
}
