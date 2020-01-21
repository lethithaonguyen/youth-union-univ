<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chucvu_dv extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chucvu_dv';
	protected $fillable     =['TEN_CHUCVU'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function ct_chucvu_dvs()
	{
		return $this->hasMany('App\ct_chucvu_dv', 'CHUCVU_DV_ID', 'ID');
	}


}
