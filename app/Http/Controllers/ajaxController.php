<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tinh_thanhpho;
use App\quan_huyen;

class ajaxController extends Controller
{
    //
    public function gettenquan_huyen($idtentp)
    {
    	$quan_huyen = quan_huyen::where('TINH_THANHPHO_ID',$idtentp)->get();
    	foreach ($quan_huyen as $q_h) 
    	{
    		 echo "<option value='".$q_h->ID."'>".$q_h->TEN_QH."</option>";

    	}
    } 
}
