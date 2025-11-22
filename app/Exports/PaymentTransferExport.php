<?php

namespace App\Exports;

use App\Models\PaymentMethodTransfer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PaymentTransferExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $transfers = PaymentMethodTransfer::with(['fromPaymentMethod', 'toPaymentMethod'])
            ->whereBetween('transfer_date', [$this->startDate, $this->endDate])
            ->orderBy('transfer_date', 'asc')
            ->get();

        return view('backend.pages.paymentMethods.transfer_export_excel', compact('transfers'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getStyle('A1:F1000')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:F1000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('A1:F1000')->getFont()->setName('Tahoma')->setSize(12);
                $sheet->setRightToLeft(true);

                // Optional column widths
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(25);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(35);
            },
        ];
    }
}
