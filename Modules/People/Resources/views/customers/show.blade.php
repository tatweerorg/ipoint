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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection