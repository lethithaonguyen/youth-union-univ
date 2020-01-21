<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class xeploai_cd extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'xeploai_cd';
	protected $fillable     =['TEN_XLCD', 'DIEM_DAT_CD'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function phieudanhgia_chidoans()
	{
		return $this->hasMany('App\phieudanhgia_chidoan', 'XEPLOAI_CD_ID', 'ID');
	}
}
