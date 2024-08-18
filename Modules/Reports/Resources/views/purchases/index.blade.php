@extends('layouts.app')

@section('title', 'Purchases Report')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.PurchasesReport')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <livewire:reports.purchases-report :suppliers="\Modules\People\Entities\Supplier::all()" />
</div>
@endsection