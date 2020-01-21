<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hinhthuc_ktkl extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'hinhthuc_ktkl';
	protected $fillable     =['TEN_HT'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function khenthuong_kyluats()
	{
		return $this->hasMany('App\khenthuong_kyluat', 'HINHTHUC_KTKL_ID', 'ID');
	}
}
