<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiet_ktkl extends Model
{
    const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'chitiet_ktkl';
	protected $fillable     =['NOIDUNG_KTKL', 'NGAYBATDAU'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';
	public function phieudanhgia_doanvien()
	{
		return $this->belongsTo('App\phieudanhgia_doanvien', 'PHIEUDANHGIA_DOANVIEN_ID', 'ID');
	}

	public function khenthuong_kyluat()
	{
		return $this->belongsTo('App\khenthuong_kyluat', 'KHENTHUONG_KYLUAT_ID', 'ID');
	}

}
