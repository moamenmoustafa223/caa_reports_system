<?php
namespace App\Exports;

use App\Models\PaymentMethodTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PaymentMethodTransactionExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $startDate, $endDate, $type, $sourceType, $paymentMethodId;

    public function __construct($startDate, $endDate, $type, $sourceType, $paymentMethodId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = $type;
        $this->sourceType = $sourceType;
        $this->paymentMethodId = $paymentMethodId;
    }

    public function view(): View
    {
        $query = PaymentMethodTransaction::with('payment_method');
    
        if ($this->startDate) {
            $query->whereDate('transaction_date', '>=', $this->startDate);
        }
        if ($this->endDate) {
            $query->whereDate('transaction_date', '<=', $this->endDate);
        }
        if ($this->type) {
            $query->where('type', $this->type);
        }
        if ($this->sourceType) {
            $query->where('source_type', $this->sourceType);
        }
        if ($this->paymentMethodId) {
            $query->where('payment_method_id', $this->paymentMethodId);
        }
    
        $transactions = $query->get();
    
        $totalCredit = $transactions->where('type', 'credit')->sum('amount');
        $totalDebit  = $transactions->where('type', 'debit')->sum('amount');
    
        return view('backend.pages.paymentMethods.export_excel', compact(
            'transactions', 'totalCredit', 'totalDebit'
        ));
    }
    

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getStyle('A1:G1000')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:G1000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('A1:G1000')->getFont()->setName('Tahoma')->setSize(12);
                $sheet->setRightToLeft(true);
            },
        ];
    }
}
