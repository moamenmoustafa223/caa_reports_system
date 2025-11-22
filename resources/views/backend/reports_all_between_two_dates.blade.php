@extends('backend.layouts.master')

@section('page_title')
    {{ trans('back.All_report_between_two_dates') }}
@endsection

@section('content')
    <style>
        @media print {

            .btn,
            .no-print {
                display: none !important;
            }
        }

        .report-label {
            font-size: 14px;
            color: #6c757d;
        }

        .report-value {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .report-table td,
        .report-table th {
            vertical-align: middle;
            border: 1px solid #343a40 !important;
            /* Darker border */
        }

        .report-table {
            border-color: #343a40 !important;
        }
    </style>

    <div class="row">
        <div class="col-md-12 mb-2">
            <form action="{{ route('reports_all_between_two_dates_post') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    {{-- Start Date --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">{{ trans('PaymentsPurchases.start_date') }}</label>
                        <input type="date" name="start_date" class="form-control form-control-sm"
                            value="{{ $start_date ?? '' }}">
                    </div>

                    {{-- End Date --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">{{ trans('PaymentsPurchases.end_date') }}</label>
                        <input type="date" name="end_date" class="form-control form-control-sm"
                            value="{{ $end_date ?? '' }}">
                    </div>

                    {{-- Buttons --}}
                    <div class="col-md-6 d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-search me-1"></i> {{ trans('PaymentsPurchases.Search') }}
                        </button>

                        <a href="{{ route('reports_all_between_two_dates') }}" class="btn btn-sm btn-success"
                            title="{{ trans('global.reset') }}">
                            <i class="fas fa-sync-alt"></i>
                        </a>

                        <button type="button" id="btnPrint" onclick="printthispage();"
                            class="btn btn-sm btn-info no-print" title="{{ trans('global.print') }}">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Report Data Table -->
    <div class="card card-body shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover report-table table-sm text-center align-middle">
                <tbody>
                    <tr>
                        <td>
                            <div class="report-label">{{ trans('back.employee_count') }}</div>
                            <div class="report-value">{{ $employee_count }}</div>
                        </td>
                        <td>
                            <div class="report-label">{{ trans('back.trainees_count') }}</div>
                            <div class="report-value">{{ $trainees_count }}</div>
                        </td>
                        <td>
                            <div class="report-label">{{ trans('back.contracts_count') }}</div>
                            <div class="report-value">{{ $contracts_count }}</div>
                        </td>
                        <td>
                            <div class="report-label">{{ trans('back.total_Salary_amount') }}</div>
                            <div class="report-value">{{ $total_Salary_amount }}</div>
                        </td>
                    </tr>

                    {{-- صف 7 --}}
                    <tr>

                        <td>
                            <div class="report-label">{{ trans('back.total_allowance_amount') }}</div>
                            <div class="report-value">{{ $total_allowance_amount }}</div>
                        </td>
                        <td>
                            <div class="report-label">{{ trans('back.total_discount_amount') }}</div>
                            <div class="report-value text-danger fw-bold">{{ number_format($total_discount_amount, 3) }}
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>



                    {{-- صف 8 --}}
                    <tr>
                        <td colspan="4">
                            <div class="report-label mb-2">{{ trans('back.payment_methods_current_balances') }}</div>
                            <div class="report-value">
                                <div class="row g-2 px-2">
                                    @foreach ($payment_method_balances as $method)
                                        <div class="col-md-6 col-lg-4">
                                            <div
                                                class="d-flex justify-content-between align-items-center bg-light rounded px-3 py-2 border">
                                                <span class="text-dark small">
                                                    {{ app()->getLocale() == 'ar' ? $method->name_ar : $method->name_en }}
                                                </span>
                                                <span class="badge bg-warning rounded-pill fs-6 text-dark">
                                                    {{ number_format($method->current_balance, 3) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Total --}}
                                    <div class="col-12 mt-3">
                                        <div
                                            class="d-flex justify-content-between align-items-center bg-success bg-opacity-25 border border-success rounded px-3 py-2">
                                            <span class="fw-bold fs-5">{{ trans('back.total_current_balance') }}</span>
                                            <span class="fw-bold text-dark fs-4">
                                                {{ number_format($total_current_balances, 3) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <style>
            .report-value .badge {
                font-size: 1rem;
                padding: 0.4em 0.8em;
            }
        </style>
    </div>
@endsection

@section('js')
    <script>
        function printthispage() {
            document.getElementById('btnPrint').style.display = 'none';
            window.print();
            document.getElementById('btnPrint').style.display = 'inline-block';
        }
    </script>
@endsection
