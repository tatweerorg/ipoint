@extends('layouts.app')

@section('title', 'Create Customer')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">{{__('public.Customers')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.Add')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                @include('utils.alerts')
                <div class="form-group">
                    <button class="btn btn-primary">{{__('public.CreateCustomer')}} <i class="bi bi-check"></i></button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="customer_name">{{__('public.CustomerName')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="customer_email">{{__('public.Email')}} <span class="text-danger"></span></label>
                                    <input type="email" class="form-control" name="customer_email" >
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="customer_phone">{{__('public.Phone')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_phone" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="city">{{__('public.City')}} <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="city" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="country">{{__('public.Country')}} <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="country" >
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="address">{{__('public.Address')}} <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="address" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection