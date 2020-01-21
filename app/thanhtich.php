<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thanhtich extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'thanhtich';
	protected $fillable     =['TEN_TT'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';



	public function thanhtich_thamgias()
	{
		return $this->hasMany('App\thanhtich_thamgia', 'THANHTICH_ID', 'ID');
	}
}
