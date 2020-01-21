<?php

namespace App\Imports;

use App\chidoan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\doankhoa;
use App\khoa;
use Illuminate\Http\Request;

class chidoanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new chidoan([
            //
            'ID' => $row['id'],
            'DOANKHOA_ID' => $row['doan_khoa'],
            'KHOA_ID' => $row['khoa'],
            'TEN_CD' => $row['chi_doan'],
            'NGAY_THANHLAP' => \PhpOffice\Phpspreadsheet\Shared\Date::excelToDateTimeObject ($row['ngay_thanh_lap'])
        ]);
    }
}
