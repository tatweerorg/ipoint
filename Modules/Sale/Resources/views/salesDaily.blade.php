@extends('layouts.app')

@section('title', 'مبيعات اليوم')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active">مبيعات اليوم</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">مبيعات اليوم</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاريخ البيع</th>
                                    <th>العميل</th>
                                    <th>المبلغ الإجمالي</th>
                                    <th>المبلغ المدفوع</th>
                                    <th>المبلغ المستحق</th>
                                    <th>حالة الدفع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todaySales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->date }}</td>
                                    <td>{{ $sale->customer_name }}</td>
                                    <td>{{ $sale->total_amount }}</td>
                                    <td>{{ $sale->paid_amount }}</td>
                                    <td>{{ $sale->due_amount }}</td>
                                    <td>{{ $sale->payment_status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="row">
        <div class="col-12 d-print-none d-flex justify-content-center align-items-center">
            <div class=" w-25 text-white bg-primary p-1 mfe-3 rounded d-flex justify-content-center align-items-center" onclick="window.print()">
    <i class="bi bi-printer font-2xl"></i> 
</div>
@endsection
