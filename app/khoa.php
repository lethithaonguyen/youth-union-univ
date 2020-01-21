<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khoa extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'khoa';
	protected $fillable     =['TEN_KHOA'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function chidoans()
	{
		return $this->hasMany('App\chidoan', 'KHOA_ID', 'ID');
	}
}
