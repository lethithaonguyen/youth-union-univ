<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
   	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'users';
	protected $fillable     =['DOANVIEN_THANHNIEN_ID', 'VAITRO_ID', 'email', 'password'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

	public function vaitro()
	{
		return $this->belongsTo('App\vaitro', 'VAITRO_ID', 'ID');
	}
}
