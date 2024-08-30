@extends('layouts.app')

@section('title', 'POS')

@section('third_party_stylesheets')

@endsection

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.POS')}}</li>
</ol>
   <div class="form-group row breadcrumb">
        <label for="suspended_invoice" class="col ">اختيار فاتورة معلقة</label>
        <select id="suspended_invoice" name="suspended_invoice" class="form-control col">
            <option  value="">اختر فاتورة</option>
            @foreach($suspendedSales as $sale)
                <option  value="{{ $sale->id }}">{{ $sale->reference }} - {{ $sale->total_amount }}</option>
            @endforeach
        </select>
    </div>@endsection

@section('content')
<div class="container-fluid">
    <livewire:search-product />
    <div class="row ">
        <div class="col-12">
            @include('utils.alerts')
        </div>
        <div class="col-lg-2">
            <livewire:pos.product-list :categories="$product_categories" />
        </div>
        <div class="col ">
            <livewire:pos.checkout :cart-instance="'sale'" :customers="$customers" />
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script src="{{ asset('js/jquery-mask-money.js') }}"></script>
<script>
    $(document).ready(function() {
        window.addEventListener('showCheckoutModal', event => {
            $('#checkoutModal').modal('show');

            $('#paid_amount').maskMoney({
                prefix: '{{ settings()->currency->symbol }}',
                thousands: '{{ settings()->currency->thousand_separator }}',
                decimal: '{{ settings()->currency->decimal_separator }}',
                allowZero: false,
            });

            $('#total_amount').maskMoney({
                prefix: '{{ settings()->currency->symbol }}',
                thousands: '{{ settings()->currency->thousand_separator }}',
                decimal: '{{ settings()->currency->decimal_separator }}',
                allowZero: true,
            });

            $('#paid_amount').maskMoney('mask');
            $('#total_amount').maskMoney('mask');

            $('#checkout-form').submit(function() {
                var paid_amount = $('#paid_amount').maskMoney('unmasked')[0];
                $('#paid_amount').val(paid_amount);
                var total_amount = $('#total_amount').maskMoney('unmasked')[0];
                $('#total_amount').val(total_amount);
            });
        });
    });
</script>

@endpush