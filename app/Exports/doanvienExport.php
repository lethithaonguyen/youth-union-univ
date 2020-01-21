<?php

namespace App\Exports;

use App\doanvien_thanhnien;
use Excel;
use DB;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class doanvienExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return doanvien_thanhnien::all();

        // $id = Auth::user()->id;
        $now = Carbon::now();
        $order[] = [];
        $dsdoanvien =DB::table('doanvien_thanhnien')
        ->join('phuong_xa', 'phuong_xa.ID', '=', 'doanvien_thanhnien.PHUONG_XA_ID_QQ')
        ->join('quan_huyen','quan_huyen.ID','=','phuong_xa.QUAN_HUYEN_ID')
        ->join('tinh_thanhpho','tinh_thanhpho.ID','=','quan_huyen.TINH_THANHPHO_ID')
        ->join('chidoan', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
        ->join('tongiao', 'tongiao.ID', '=', 'doanvien_thanhnien.TONGIAO_ID')
        ->join('dantoc', 'dantoc.ID', '=', 'doanvien_thanhnien.DANTOC_ID')
        ->select('doanvien_thanhnien.*', 'phuong_xa.TEN_PX', 'quan_huyen.TEN_QH','tinh_thanhpho.TEN_TP','chidoan.TEN_CD','tongiao.TEN_TG','dantoc.TEN_DT')
        ->get();


        $index = 0;
        foreach ($dsdoanvien as $key => $row) {
            $index++;
            $order[]  = array(
                '0' =>$index ,
                '1' => $row->MSSV,
                '2' => $row->TEN_SV,
                '3' => \Carbon\Carbon::parse($row->NGAYSINH_SV)->format('d/m/Y'),
                '4' => $row->DIACHI_SV,
                '5' => $row->PHAI_SV,
                '6' => $row->SDT_SV,
                '7' => $row->EMAIL_SV,
                '8' => \Carbon\Carbon::parse($row->NGAYVAODOAN_SV)->format('d/m/Y'),
                '9' => $row->NOIVAODOAN_SV,
                '10' => $row->TEN_PX .'-'.$row->TEN_QH .'-'. $row->TEN_TP,
                '11' => $row->TEN_CD,
                '12' => $row->TEN_TG,
                '13' => $row->TEN_PX .'-'.$row->TEN_QH .'-'. $row->TEN_TP,
                '14' => $row->TEN_DT,
            );
        }
        return (collect($order));
    }

    public function headings(): array
    {
    	return [
            'STT',
            'MSSV',
            'Họ tên',
            'Ngày sinh',
            'Địa chỉ',
            'Phái',
            'Sồ điện thoại',
            'Email',
            'Ngày vào đoàn',
            'Nơi vào đoàn',
            'Quê quán',
            'Chi Đoàn',
            'Tôn giáo',
            'Nơi sinh',
            'Dân tộc'
        ];

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:P1'; // All headers
                $styleArray = ['borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '#FF0000'],
                        'align' => 'center',
                        'cellpadding'=>'5',
                        'border'=>'1'
                    ],
                ],
            ];

            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->applyFromArray($styleArray);
        },
    ];
}
}
