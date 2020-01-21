<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai_ktkl extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'loai_ktkl';
	protected $fillable     =['TEN_LOAIKTKL'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function khenthuong_kyluats()
	{
		return $this->hasMany('App\khenthuong_kyluat', 'LOAI_KTKL_ID', 'ID');
	}
}
