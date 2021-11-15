<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Sale;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\excel\concerns\WithCustomStartCell;

class SalesExport implements FromCollection, WithHeadings, WithCustomStartCell,
                             WithTitle, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $userId, $dateFrom, $dateTo, $reportType;

    function __construct($userId, $reportType, $f1, $f2)
    {
        $this->userId = $userId;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
        $this->reportType = $reportType;
    }

    public function collection()
    {
        /* return Sale::all(); */
        $data = [];

        if($this->reportType == 1){
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';

            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';

            $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->userId == 0){
            $data = Sale::join('users as us','us.id','sales.user_id')
            ->select('sales.id','sales.total','sales.items',
                    'sales.status','us.name as user','sales.created_at')
            ->whereBetween('sales.created_at',[$from,$to])
            ->get();
        }else{
            $data = Sale::join('users as us','us.id','sales.user_id')
            ->select('sales.id','sales.total','sales.items',
                    'sales.status','us.name as user','sales.created_at')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id',$this->userId)
            ->get();
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "Folio",
            "Importe",
            "Items",
            "Estatus",
            "Usuario",
            "Fecha"
        ];
    }

    public function starCell() : string
    {
        # code...
        return 'A2';
    }

    public function styles(Worksheet $sheet)
    {
        # code...
        return [
            2 => [
                'font' => [
                    'bold' => true
                ]
            ],
        ];
    }

    public function title(): string
    {
        return 'Reporte de Ventas';
    }

    public function reportExcel(
        $userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        # code...
        $reportName = 'Reporte de Ventas_' . uniqid() . '.xlsx';

        return Excel::download(new SalesExport(
            $userId, $reportType, $dateFrom, $dateTo),
            $reportName);
    }
}
