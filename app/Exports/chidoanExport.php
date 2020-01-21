<?php

namespace App\Exports;

use App\chidoan;
use Excel;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
class chidoanExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return chidoan::all();
       $now = Carbon::now();
       $order[] = [];
       $dschidoan = DB::table('chidoan')
       ->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
       ->join('khoa', 'khoa.ID', '=', 'chidoan.KHOA_ID')
       ->select('chidoan.*', 'doankhoa.TEN_DK', 'khoa.TEN_KHOA')
       ->get();

       $index = 0;
       foreach ($dschidoan as $key => $row) {
        $index++;
        $order[]  = array(
            '0' =>$index ,
            '1' => $row->TEN_CD,
            '2' => $row->TEN_DK,
            '3' => $row->TEN_KHOA,
            '4' => \Carbon\Carbon::parse($row->NGAY_THANHLAP)->format('d/m/Y'),
        );
    }
    return (collect($order));
}

public function headings(): array
{
   return [
      'STT',
      'Chi Đoàn',
      'Đoàn Khoa',
      'Khóa',
      'Ngày Thành Lập'
  ];

}

public function registerEvents(): array
{
    return [
        AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
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
