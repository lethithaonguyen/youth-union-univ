<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khenthuong_kyluat extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'khenthuong_kyluat';
	protected $fillable     =['TEN_KTKL'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function chitiet_ktkls()
	{
		return $this->hasMany('App\chitiet_ktkl', 'KHENTHUONG_KYLUAT_ID', 'ID');
	}

	public function hinhthuc_ktkl()
	{
		return $this->belongsTo('App\hinhthuc_ktkl', 'HINHTHUC_KTKL_ID', 'ID');
	}

	public function loai_ktkl()
	{
		return $this->belongsTo('App\loai_ktkl', 'LOAI_KTKL_ID', 'ID');
	}


	public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}

}
