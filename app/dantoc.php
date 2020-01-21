<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dantoc extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'dantoc';
	protected $fillable     =['TEN_DT'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function doanvien_thanhniens()
	{
		return $this->hasMany('App\doanvien_thanhnien', 'DANTOC_ID', 'ID');
	}

}
