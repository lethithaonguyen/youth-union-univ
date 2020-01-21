<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class v_soluong_cd extends Model
{
    const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'v_soluong_cd';
	protected $fillable     =['ID','TEN_DK', 'TEN_CD', 'soluong_cd'];
	// protected $guarded      ='ID';

	// protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


}
