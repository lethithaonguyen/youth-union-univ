<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class v_so_tien_phai_dong extends Model
{
    const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phieuchi_dk';
	protected $fillable     =['ID', 'TEN_DK','TEN_NH','so_tien_phai_dong'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';

}
