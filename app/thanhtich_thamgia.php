<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thanhtich_thamgia extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'thanhtich_thamgia';
	protected $fillable     =['DIENGIAI'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	public function thanhtich()
	{
		return $this->belongsTo('App\thanhtich', 'THANHTICH_ID', 'ID');
	}

		public function pt_doankhoa()
	{
		return $this->belongsTo('App\pt_doankhoa', 'PT_DOANKHOA_ID', 'ID');
	}

		public function doanvien_thanhnien()
	{
		return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
	}
	
}
