<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('public.StartDate')}} <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('public.EndDate')}} <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('public.Payments')}}</label>
                                    <select wire:model.live="payments" class="form-control" name="payments">
                                        <option value="">{{__('public.SelectPayments')}}</option>
                                        <option value="sale">{{__('public.Sales')}}</option>
                                        <option value="sale_return">{{__('public.SaleReturns')}}</option>
                                        <option value="purchase">{{__('public.Purchase')}}</option>
                                        <option value="purchase_return">{{__('public.Returns')}} </option>
                                    </select>
                                    @error('payments')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('public.PaymentMethod')}}</label>
                                    <select wire:model="payment_method" class="form-control" name="payment_method">
                                        <option value="">{{__('public.SelectPaymentMethod')}}</option>
                                        <option value="Cash">{{__('public.Cash')}}</option>
                                        <option value="Credit Card">{{__('public.CreditCard')}}</option>
                                        <option value="Bank Transfer">{{__('public.BankTransfer')}}</option>
                                        <option value="Cheque">{{__('public.Cheque')}}</option>
                                        <option value="Other">{{__('public.Other')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                {{__('public.FilterReport')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($information->isNotEmpty())
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>{{ ucwords(str_replace('_', ' ', $payments)) }}</th>
                                <th>Total</th>
                                <th>Payment Method</th>
                            </tr>
                        </thead>
                        <tbody>
                              @php
                                        $total =0;
                                        @endphp
                            @forelse($information as $data)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($data->date)->format('d M, Y') }}</td>
                                <td>{{ $data->reference }}</td>
                                <td>
                                    @if($payments == 'sale')
                                    {{ $data->sale->reference }}
                                    @elseif($payments == 'purchase')
                                    {{ $data->purchase->reference }}
                                    @elseif($payments == 'sale_return')
                                    {{ $data->saleReturn->reference }}
                                    @elseif($payments == 'purchase_return')
                                    {{ $data->purchaseReturn->reference }}
                                    @endif
                                </td>
                                <td>{{ format_currency($data->amount) }}</td>
                                  @php
                                       
                                $total += $data->amount;

                                        @endphp
                                <td>{{ $data->payment_method }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <span class="text-danger">No Data Available!</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <tr >
    <td colspan="4 " ><strong>Total:</strong></td>
    <td colspan="4">{{ format_currency($total) }}</td>
</tr>
                    <div @class(['mt-3'=> $information->hasPages()])>
                        {{ $information->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="alert alert-warning mb-0">
                        No Data Available!
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
     <div class="row">
        <div class="col-12 d-print-none d-flex justify-content-center align-items-center">
            <div class=" w-25 text-white bg-primary p-1 mfe-3 rounded d-flex justify-content-center align-items-center" onclick="window.print()">
    <i class="bi bi-printer font-2xl"></i> 
</div>

        </div>
    </div>
</div>