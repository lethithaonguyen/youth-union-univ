<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class v_phuongxa extends Model
{
    const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'phuong_xa';
	protected $fillable     =['TEN_PX'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


}
