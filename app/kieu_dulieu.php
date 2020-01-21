<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kieu_dulieu extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'kieu_dulieu';
	protected $fillable     =['TEN_KIEU_DULIEU'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function noidung_pdgs()
	{
		return $this->hasMany('App\noidung_pdg', 'KIEU_DULIEU_ID', 'ID');
	}
}
