@extends('layouts.app')

@section('title', 'Create Purchase')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">{{__('public.Purchases')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.Add')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid mb-4">
    <div class="row">
        <div class="col-12">
            <livewire:search-product />
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('utils.alerts')
                    <form id="purchase-form" action="{{ route('purchases.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="reference">{{__('public.Reference')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="reference" required readonly value="PR">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="from-group">
                                    <div class="form-group">
                                        <label for="supplier_id">{{__('public.Supplier')}} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="supplier_id" id="supplier_id" required>
                                            @foreach(\Modules\People\Entities\Supplier::all() as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="from-group">
                                    <div class="form-group">
                                        <label for="date">{{__('public.Date')}} <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date" required value="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <livewire:product-cart :cartInstance="'purchase'" />

                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="status">{{__('public.Status')}} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="Pending">{{__('public.Pending')}}</option>
                                        <option value="Ordered">{{__('public.Ordered')}}</option>
                                        <option value="Completed">{{__('public.Completed')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="from-group">
                                    <div class="form-group">
                                        <label for="payment_method">{{__('public.PaymentMethod')}} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="payment_method" id="payment_method" required>
                                            <option value="Cash">{{__('public.Cash')}}</option>
                                            <option value="Credit Card">{{__('public.CreditCard')}}</option>
                                            <option value="Bank Transfer">{{__('public.BankTransfer')}}</option>
                                            <option value="Cheque">{{__('public.Cheque')}}</option>
                                            <option value="Other">{{__('public.Other')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="paid_amount">{{__('public.AmountPaid')}} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="paid_amount" type="text" class="form-control" name="paid_amount" required>
                                        <div class="input-group-append">
                                            <button id="getTotalAmount" class="btn btn-primary" type="button">
                                                <i class="bi bi-check-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">{{__('public.Note')}} (If Needed)</label>
                            <textarea name="note" id="note" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{__('public.CreatePurchase')}} <i class="bi bi-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script src="{{ asset('js/jquery-mask-money.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#paid_amount').maskMoney({
            prefix: '{{ settings()->currency->symbol }}',
            thousands: '{{ settings()->currency->thousand_separator }}',
            decimal: '{{ settings()->currency->decimal_separator }}',
            allowZero: true,
        });

        $('#getTotalAmount').click(function() {
            $('#paid_amount').maskMoney('mask', {
                {
                    Cart::instance('purchase') - > total()
                }
            });
        });

        $('#purchase-form').submit(function() {
            var paid_amount = $('#paid_amount').maskMoney('unmasked')[0];
            $('#paid_amount').val(paid_amount);
        });
    });
</script>
@endpush