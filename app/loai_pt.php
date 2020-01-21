<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai_pt extends Model
{
    	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'loai_pt';
	protected $fillable     =['TEN_LOAI_PT'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function pt_chidoans()
	{
		return $this->hasMany('App\pt_chidoan', 'LOAI_PT_ID', 'ID');
	}

		public function pt_doankhoas()
	{
		return $this->hasMany('App\pt_doankhoa', 'LOAI_PT_ID', 'ID');
	}
}
