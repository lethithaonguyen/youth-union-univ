<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tinh_thanhpho extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'tinh_thanhpho';
	protected $fillable     =['TEN_TP'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function quan_huyens()
	{
		return $this->hasMany('App\quan_huyen', 'TINH_THANHPHO_ID', 'ID');
	}
	
}
