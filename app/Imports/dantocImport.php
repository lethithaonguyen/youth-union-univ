<?php

namespace App\Imports;

use App\dantoc;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;

class dantocImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new dantoc([
            //
             'ID' => $row['stt'],
            'TEN_DT' => $row['ten_dan_toc']
        ]);
    }
}
