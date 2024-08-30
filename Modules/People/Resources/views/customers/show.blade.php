@extends('layouts.app')

@section('title', 'Customer Details')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">{{__('public.Customers')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.Details')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Customer Details Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{__('public.CustomerName')}}</th>
                                <td>{{ $customer->customer_name }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.CustomerEmail')}}</th>
                                <td>{{ $customer->customer_email }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.CustomerPhone')}}</th>
                                <td>{{ $customer->customer_phone }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.City')}}</th>
                                <td>{{ $customer->city }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.Country')}}</th>
                                <td>{{ $customer->country }}</td>
                            </tr>
                            <tr>
                                <th>{{__('public.Address')}}</th>
                                <td>{{ $customer->address }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Sales Details Table -->
                    <h4>{{__('public.SalesDetails')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('public.Date')}}</th>
                                    <th>{{__('public.Reference')}}</th>
                                    <th>{{__('public.TotalAmount')}}</th>
                                    <th>{{__('public.ReceivedAmount')}}</th>
                                    <th>{{__('public.DueAmount')}}</th>
                                    <th>{{__('public.Status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->date }}</td>
                                    <td>{{ $sale->reference }}</td>
                                    <td>{{ $sale->total_amount }}</td>
                                    <td>{{ $sale->paid_amount }}</td>
                                    <td>{{ $sale->due_amount }}</td>
                                    <td>{{ $sale->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center align-items-center w-100">

                        <button onclick="printPage()" class="btn btn-primary mb-3">
                                                    <i class="bi bi-printer"></i>  {{__('public.Print')}}
</button>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function printPage() {
        window.print();
    }
</script>
@endsection
