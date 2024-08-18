@extends('layouts.app')

@section('title', 'Sales Return Report')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.SalesReturnReport')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <livewire:reports.sales-return-report :customers="\Modules\People\Entities\Customer::all()" />
</div>
@endsection