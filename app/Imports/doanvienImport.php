<?php

namespace App\Imports;

use App\doanvien_thanhnien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\phuong_xa;
use App\chidoan;
use App\tongiao;
use App\dantoc;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class doanvienImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new doanvien_thanhnien([
            //
            'ID' => $row['stt'],
            'MSSV' => $row['mssv'],
            'TEN_SV' => $row['ho_ten'],
            'NGAYSINH_SV' => \PhpOffice\Phpspreadsheet\Shared\Date::excelToDateTimeObject ($row['ngay_sinh']),
            'DIACHI_SV' => $row['dia_chi'],
            'PHAI_SV' => $row['phai'],
            'SDT_SV' => $row['so_dien_thoai'],
            'EMAIL_SV' => $row['email'],
            'NGAYVAODOAN_SV' => \PhpOffice\Phpspreadsheet\Shared\Date::excelToDateTimeObject ($row['ngay_vao_doan']),
            'NOIVAODOAN_SV' => $row['noi_vao_doan'],
             'NGAYCHUYENSH_SV' => null,
            // 'NGAYCHUYENSH_SV' => \PhpOffice\Phpspreadsheet\Shared\Date::excelToDateTimeObject ($row['ngay_chuyen_sinh_hoat']),
            // 'NGAYCHUYENSH_SV' => if( $row['ngay_chuyen_sinh_hoat'] == ''){
            //     echo 'NGAYCHUYENSH_SV' => $row['ngay_chuyen_sinh_hoat'] == null;
            //    //  echo "'NGAYCHUYENSH_SV' =>'k'";
            // }else
            // {
            //     //echo "'NGAYCHUYENSH_SV' =>'c'";
            //     echo 'NGAYCHUYENSH_SV' => \PhpOffice\Phpspreadsheet\Shared\Date::excelToDateTimeObject ($row['ngay_chuyen_sinh_hoat']);

            // },
            // 'NGAYCHUYENSH_SV' => if(!strlen($row['ngay_chuyen_sinh_hoat'])){
            //     return null;
            // } 
            // else{
            //      return 'NGAYCHUYENSH_SV' => \PhpOffice\Phpspreadsheet\Shared\Date::excelToDateTimeObject ($row['ngay_chuyen_sinh_hoat']);
            //  } ,
            'PHUONG_XA_ID_QQ' => $row['que_quan'],
            'CHIDOAN_ID' => $row['chi_doan'],
            'TONGIAO_ID' => $row['ton_giao'],
            'PHUONG_XA_ID_NS' => $row['noi_sinh'],
            'DANTOC_ID' => $row['dan_toc'],
        ]);
    }
     public function rules(): array
    {
        return [
            'EMAIL_SV' => Rule::in(['patrick@maatwebsite.nl']),

             // Above is alias for as it always validates in batches
             '*.EMAIL_SV' => Rule::in(['patrick@maatwebsite.nl']),
        ];
    }
}
