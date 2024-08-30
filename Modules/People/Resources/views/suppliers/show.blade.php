@extends('layouts.app')

@section('title', 'Supplier Details')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">{{__('public.Suppliers')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.Details')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Supplier Details Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{__('public.SupplierName')}}</th>
                                <td>{{ $supplier->supplier_name }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.SupplierEmail')}}</th>
                                <td>{{ $supplier->supplier_email }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.SupplierPhone')}}</th>
                                <td>{{ $supplier->supplier_phone }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.City')}}</th>
                                <td>{{ $supplier->city }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.Country')}}</th>
                                <td>{{ $supplier->country }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.Address')}}</th>
                                <td>{{ $supplier->address }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Purchases Details Table -->
                    <h4>{{__('public.PurchaseDetails')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('public.Date')}}</th>
                                    <th>{{__('public.Reference')}}</th>
                                    <th>{{__('public.TotalAmount')}}</th>
                                    <th>{{__('public.ReceivedAmount')}}</th>
                                    <th>{{__('public.DueAmount')}}</th>
                                    <th>{{__('public.PaymentStatus')}}</th>
                                    <th>{{__('public.PaymentMethod')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->date }}</td>
                                    <td>{{ $purchase->reference }}</td>
                                    <td>{{ $purchase->total_amount }}</td>
                                    <td>{{ $purchase->paid_amount }}</td>
                                    <td>{{ $purchase->due_amount }}</td>
                                    <td>{{ $purchase->payment_status }}</td>
                                    <td>{{ $purchase->payment_method }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                   <div class="col-12 d-print-none d-flex justify-content-center align-items-center">

                      <div class=" w-25 text-white bg-primary p-1 mfe-3 rounded d-flex justify-content-center align-items-center" onclick="window.print()">
    <i class="bi bi-printer font-2xl"></i> 
</div>
</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
