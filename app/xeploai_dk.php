<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class xeploai_dk extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'xeploai_dk';
	protected $fillable     =['TEN_XLDK', 'DIEM_DAT_DK'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function phieudanhgia_doankhoas()
	{
		return $this->hasMany('App\phieudanhgia_doankhoa', 'XEPLOAI_DK_ID', 'ID');
	}
}
