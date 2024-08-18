@extends('layouts.app')

@section('title', 'Create Currency')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('currencies.index') }}">{{__('public.Currencies')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.Add')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('currencies.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                @include('utils.alerts')
                <div class="form-group">
                    <button class="btn btn-primary">{{__('public.CreateCurrency')}} <i class="bi bi-check"></i></button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="currency_name">{{__('public.CurrencyName')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="currency_name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="code">{{__('public.CurrencyCode')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="symbol">{{__('public.Symbol')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="symbol" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="thousand_separator">{{__('public.ThousandSeparator')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="thousand_separator" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="decimal_separator">{{__('public.DecimalSeparator')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="decimal_separator" required>
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