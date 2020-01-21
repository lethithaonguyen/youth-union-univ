<?php

namespace App\Exports;
use DB;
use App\dantoc;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
class dantocExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return dantoc::all();
     $now = Carbon::now();
     $order[] = [];
     $dsdantoc = DB::table('dantoc')
     ->select('dantoc.TEN_DT')
     ->get();

     $index = 0;
     foreach ($dsdantoc as $key => $row) {
        $index++;
        $order[]  = array(
            '0' =>$index ,
            '2' => $row->TEN_DT,
        );
    }
    return (collect($order));
}

public function headings(): array
{
 return [
    'STT',
    'Tên Dân Tộc',
];
}

public function registerEvents(): array
{
    return [
        AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:B1'; // All headers
                $styleArray = ['borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '#FF0000'],
                        'align' => 'center',
                        'cellpadding'=>'5',
                        'border'=>''
                    ],
                ],
            ];

            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->applyFromArray($styleArray);
        },
    ];
}
}
