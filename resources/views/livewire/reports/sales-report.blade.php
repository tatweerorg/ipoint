 <style>
        @media print {
            /* Hide all content except the invoice section */
            body * {
                visibility: hidden;
            }
            
            .invoice, .invoice * {
                visibility: visible;
            }
            
            .invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                border: none;
                padding: 0;
                margin: 0;
            }
            
            /* Adjust the layout for printing if needed */
            .invoice {
                page-break-after: always;
            }
        }
    </style>

<div>
 
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>{{__('public.StartDate')}} <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>{{__('public.EndDate')}} <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>{{__('public.Customer')}}</label>
                                    <select wire:model="customer_id" class="form-control" name="customer_id">
                                        <option value="">{{__('public.SelectCustomer')}}</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('public.Status')}}</label>
                                    <select wire:model="sale_status" class="form-control" name="sale_status">
                                        <option value="">{{__('public.SelectStatus')}}</option>
                                        <option value="Pending">{{__('public.Pending')}}</option>
                                        <option value="Shipped">{{__('public.Shipped')}}</option>
                                        <option value="Completed">{{__('public.Completed')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('public.PaymentStatus')}}</label>
                                    <select wire:model="payment_status" class="form-control" name="payment_status">
                                        <option value="">{{__('public.SelectPaymentStatus')}}</option>
                                        <option value="Paid">{{__('public.Paid')}}</option>
                                        <option value="Unpaid">{{__('public.Unpaid')}}</option>
                                        <option value="Partial">{{__('public.Partial')}}</option>
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

    <div class="row invoice">
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
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                              @php
                                        $total =0;
                                        @endphp
                            @forelse($sales as $sale)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</td>
                                <td>{{ $sale->reference }}</td>
                                <td>{{ $sale->customer_name }}</td>
                                <td>
                                    @if ($sale->status == 'Pending')
                                    <span class="badge badge-info">
                                        {{ $sale->status }}
                                    </span>
                                    @elseif ($sale->status == 'Shipped')
                                    <span class="badge badge-primary">
                                        {{ $sale->status }}
                                    </span>
                                    @else
                                    <span class="badge badge-success">
                                        {{ $sale->status }}
                                    </span>
                                    @endif
                                </td>
                                <td>{{ format_currency($sale->total_amount) }}</td>
                                   @php
                                       
                                $total += $sale->total_amount;

                                        @endphp
                                <td>{{ format_currency($sale->paid_amount) }}</td>
                                <td>{{ format_currency($sale->due_amount) }}</td>
                                <td>
                                    @if ($sale->payment_status == 'Partial')
                                    <span class="badge badge-warning">
                                        {{ $sale->payment_status }}
                                    </span>
                                    @elseif ($sale->payment_status == 'Paid')
                                    <span class="badge badge-success">
                                        {{ $sale->payment_status }}
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        {{ $sale->payment_status }}
                                    </span>
                                    @endif

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <span class="text-danger">No Sales Data Available!</span>
                                </td>
                            </tr>
                                     
                            @endforelse
                        </tbody>
                    </table>
                
      <div class="row">
                         <tr class="col-6">
                        <td colspan="8 " ><strong>Total:</strong></td>
                         <td colspan="8">{{ format_currency($total) }}</td>
                            </tr>
                   
                    </div>
                </div>
                  
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-12 d-print-none d-flex justify-content-center align-items-center">
            <div class=" w-25 text-white bg-primary p-1 mfe-3 rounded d-flex justify-content-center align-items-center" onclick="window.print()">
    <i class="bi bi-printer font-2xl"></i> 
</div>

        </div>
    </div>
</div>
