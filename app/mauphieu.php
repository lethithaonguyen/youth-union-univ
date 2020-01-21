<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mauphieu extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'mauphieu';
	protected $fillable     =['TEN_MP'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

	public function chitiet_mauphieus()
	{
		return $this->hasMany('App\chitiet_mauphieu', 'MAUPHIEU_ID', 'ID');
	}

	public function phieudanhgia_doanviens()
	{
		return $this->hasMany('App\phieudanhgia_doanvien', 'MAUPHIEU_ID', 'ID');
	}

		public function phieudanhgia_doankhoas()
	{
		return $this->hasMany('App\phieudanhgia_doankhoa', 'MAUPHIEU_ID', 'ID');
	}

	public function phieudanhgia_chidoans()
	{
		return $this->hasMany('App\phieudanhgia_chidoan', 'MAUPHIEU_ID', 'ID');
	}
}
