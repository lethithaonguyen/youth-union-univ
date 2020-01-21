<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tongiao extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'tongiao';
	protected $fillable     =['TEN_TG'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function doanvien_thanhniens()
	{
		return $this->hasMany('App\doanvien_thanhniens', 'TONGIAO_ID', 'ID');
	}
}
