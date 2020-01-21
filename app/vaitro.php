<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vaitro extends Model
{
	const   CREATED_AT      = 'TAOMOI';
	const   UPDATED_AT      = 'CAPNHAT';

	protected $table        = 'vaitro';
	protected $fillable     =['TEN_VT'];
	protected $guarded      ='ID';

	protected $primaryKey   ='ID';

	protected $dates        =['TAOMOI', 'CAPNHAT'];
	protected $dateFormat   ='Y-m-d H:i:s';


	// public function co_vaitros()
	// {
	// 	return $this->hasMany('App\co_vaitro', 'VAITRO_ID', 'ID');
	// }

	    public function users()
    {
        return $this->hasMany('App\User', 'VAITRO_ID', 'ID');
    }
}
