<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class xeploai_dv extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'xeploai_dv';
	protected $fillable     =['TEN_XLDV', 'DIEM_DAT_DV'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function phieudanhgia_doanviens()
	{
		return $this->hasMany('App\phieudanhgia_doanvien', 'CD_XEPLOAI_DV_ID', 'ID');
	}

}
