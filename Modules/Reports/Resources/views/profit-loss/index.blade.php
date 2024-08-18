@extends('layouts.app')

@section('title', 'Profit / Loss Report')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('public.Home')}}</a></li>
    <li class="breadcrumb-item active">{{__('public.ProfitLossReport')}}</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <livewire:reports.profit-loss-report />
</div>
@endsection