<div>
    <style>
    .large-text {
        font-size: 1.5rem; /* Adjust as needed */
    }
</style>

    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <div>
                @if (session()->has('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                        <span>{{ session('message') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                @endif

              

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th class="align-middle">{{__('public.Product')}}</th>
                                <th class="align-middle">{{__('public.Price')}}</th>
                                <th class="align-middle">{{__('public.Quantity')}}</th>
                                <th class="align-middle">{{__('public.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cart_items->isNotEmpty())
                            @foreach($cart_items as $cart_item)
                            <tr>
                                <td class="align-middle">
                                    {{ $cart_item->name }} <br>
                                    <span class="badge badge-success">
                                        {{ $cart_item->options->code }}
                                    </span>
                                    @include('livewire.includes.product-cart-modal')
                                </td>

                                <td class="align-middle">
                                    {{ format_currency($cart_item->price) }}
                                </td>

                                <td class="align-middle">
                                    @include('livewire.includes.product-cart-quantity')
                                </td>

                                <td class="align-middle text-center">
                                    <a href="#" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                        <i class="bi bi-x-circle font-2xl text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    <span class="text-danger">
                                        {{__('public.Pleasesearch&selectproducts')}} !
                                    </span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          
                            <tr>
                                <th>{{__('public.Discount')}} ({{ $global_discount }}%)</th>
                                <td>(-) {{ format_currency(Cart::instance($cart_instance)->discount()) }}</td>
                            </tr>
                           
                            <tr class="text-white bg-success large-text ">
                                <th>{{__('public.GrandTotal')}}</th>
                                @php
                                $total_with_shipping = Cart::instance($cart_instance)->total() + (float) $shipping
                                @endphp
                                <th >
                                    (=) {{ format_currency($total_with_shipping) }}
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-row">
              
                <div class="col">
                    <div class="form-group">
                        <label for="discount_percentage">{{__('public.Discount')}} (%)</label>
                        <input wire:model.blur="global_discount" type="number" class="form-control" min="0" max="100" value="{{ $global_discount }}" required>
                    </div>
                </div>
                  <div class="form-group col">
                    <label for="customer_id">{{__('public.Customer')}} </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i>
                            </a>
                        </div>
                        <select wire:model.live="customer_id" id="customer_id" class="form-control">
                            <option value="" selected>{{__('public.SelectCustomer')}}</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
            </div>
            

            <div class="form-group d-flex justify-content-center flex-wrap mt-4 mb-0">
                <button wire:click="resetCart" type="button" class="btn btn-lg  btn-danger mr-3"><i class="bi bi-x"></i>{{__('public.Reset')}} </button>
               <button wire:loading.attr="disabled" wire:click="proceed" type="button" class="btn btn-lg  btn-success" {{  $total_amount == 0 ? 'disabled' : '' }}><i class="bi bi-check"></i> {{__('public.Proceed')}}</button>

            </div>
        </div>
    </div>

    {{--Checkout Modal--}}
    @include('livewire.pos.includes.checkout-modal')

</div>