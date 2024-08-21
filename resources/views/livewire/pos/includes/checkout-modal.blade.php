<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">
                    <i class="bi bi-cart-check text-primary"></i>{{__('public.ConfirmSale')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="checkout-form" action="{{ route('app.pos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if (session()->has('checkout_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            <span>{{ session('checkout_message') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-7">
                            <input type="hidden" value="{{ $customer_id }}" name="customer_id">
                            <input type="hidden" value="{{ $global_tax }}" name="tax_percentage">
                            <input type="hidden" value="{{ $global_discount }}" name="discount_percentage">
                            <input type="hidden" value="{{ $shipping }}" name="shipping_amount">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="total_amount">{{__('public.TotalAmount')}} <span class="text-danger">*</span></label>
                                        <input id="total_amount" type="text" class="form-control" name="total_amount" value="{{ $total_amount }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="paid_amount">{{__('public.ReceivedAmount')}} <span class="text-danger">*</span></label>
                                        <input id="paid_amount" type="text" class="form-control" name="paid_amount" value="{{ $total_amount }}" required>
                                    </div>
                                </div>
                            </div>
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
                            <div class="form-group">
                                <label for="note">{{__('public.Note')}} (If Needed)</label>
                                <textarea name="note" id="note" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>{{__('public.TotalProducts')}}</th>
                                        <td>
                                            <span class="badge badge-success">
                                                {{ Cart::instance($cart_instance)->count() }}
                                            </span>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th>{{__('public.Discount')}} ({{ $global_discount }}%)</th>
                                        <td>(-) {{ format_currency(Cart::instance($cart_instance)->discount()) }}</td>
                                    </tr>
                                  
                                    <tr class="text-primary">
                                        <th>{{__('public.GrandTotal')}}</th>
                                        @php
                                        $total_with_shipping = Cart::instance($cart_instance)->total() + (float) $shipping
                                        @endphp
                                        <th>
                                            (=) {{ format_currency($total_with_shipping) }}
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg  btn-secondary" data-dismiss="modal">{{__('public.Close')}}</button>
                    <button class="btn btn-lg  btn-primary">تأكيد وطباعة</button>
                    <button type="submit" class="btn btn-lg  btn-success">{{__('public.Submit')}}</button>

                </div>
            </form>
        </div>
    </div>
</div>