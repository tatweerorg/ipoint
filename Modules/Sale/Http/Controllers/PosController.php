<?php

namespace Modules\Sale\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Modules\Sale\Http\Requests\StorePosSaleRequest;

class PosController extends Controller
{

    public function index() {
        Cart::instance('sale')->destroy();
   
 if (!Cache::has('products_cache')) {
        $products = Product::all();
        Cache::put('products_cache', $products, 30 * 24 * 60 * 60);
    }

    $suspendedSales = Sale::where('suspend', true)->get();
        $customers = Customer::all();
        $product_categories = Category::all();

        return view('sale::pos.index', compact('product_categories', 'customers','suspendedSales'));
    }


    public function store(StorePosSaleRequest $request) {
        DB::transaction(function () use ($request) {
            $due_amount = $request->total_amount - $request->paid_amount;

            if ($due_amount == $request->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }
            $sale_data = [
            'date' => now()->format('Y-m-d'),
            'reference' => 'PSL',
            'tax_percentage' => $request->tax_percentage,
            'discount_percentage' => $request->discount_percentage,
            'shipping_amount' => $request->shipping_amount * 100,
            'paid_amount' => $request->paid_amount * 100,
            'total_amount' => $request->total_amount * 100,
            'due_amount' => $due_amount * 100,
            'status' => 'Completed',
            'payment_status' => $payment_status,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'tax_amount' => Cart::instance('sale')->tax() * 100,
            'discount_amount' => Cart::instance('sale')->discount() * 100,
        ];

        // Add customer details if customer_id is provided
        if ($request->customer_id) {
            $sale_data['customer_id'] = $request->customer_id;
            $sale_data['customer_name'] = Customer::findOrFail($request->customer_id)->customer_name;
        }

        // Create the sale record
        $sale = Sale::create($sale_data);

            foreach (Cart::instance('sale')->content() as $cart_item) {
                SaleDetails::create([
                    'sale_id' => $sale->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    'price' => $cart_item->price * 100,
                    'unit_price' => $cart_item->options->unit_price * 100,
                    'sub_total' => $cart_item->options->sub_total * 100,
                    'product_discount_amount' => $cart_item->options->product_discount * 100,
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => $cart_item->options->product_tax * 100,
                ]);

                $product = Product::findOrFail($cart_item->id);
                $product->update([
                    'product_quantity' => $product->product_quantity - $cart_item->qty
                ]);
            }

            Cart::instance('sale')->destroy();

            if ($sale->paid_amount > 0) {
                SalePayment::create([
                    'date' => now()->format('Y-m-d'),
                    'reference' => 'INV/'.$sale->reference,
                    'amount' => $sale->paid_amount,
                    'sale_id' => $sale->id,
                    'payment_method' => $request->payment_method
                ]);
            }
        });

        toast('POS Sale Created!', 'success');

        return redirect()->back();
    }

    public function print(StorePosSaleRequest $request)
{
    $saleId = DB::transaction(function () use ($request) {
        

        $due_amount = $request->total_amount - $request->paid_amount;

        if ($due_amount == $request->total_amount) {
            $payment_status = 'Unpaid';
        } elseif ($due_amount > 0) {
            $payment_status = 'Partial';
        } else {
            $payment_status = 'Paid';
        }

        $sale_data = [
            'date' => now()->format('Y-m-d'),
            'reference' => 'PSL',
            'tax_percentage' => $request->tax_percentage,
            'discount_percentage' => $request->discount_percentage,
            'shipping_amount' => $request->shipping_amount * 100,
            'paid_amount' => $request->paid_amount * 100,
            'total_amount' => $request->total_amount * 100,
            'due_amount' => $due_amount * 100,
            'status' => 'Completed',
            'payment_status' => $payment_status,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'tax_amount' => Cart::instance('sale')->tax() * 100,
            'discount_amount' => Cart::instance('sale')->discount() * 100,
        ];

        if ($request->customer_id) {
            $sale_data['customer_id'] = $request->customer_id;
            $sale_data['customer_name'] = Customer::findOrFail($request->customer_id)->customer_name;
        }

        $sale = Sale::create($sale_data);

        foreach (Cart::instance('sale')->content() as $cart_item) {
            SaleDetails::create([
                'sale_id' => $sale->id,
                'product_id' => $cart_item->id,
                'product_name' => $cart_item->name,
                'product_code' => $cart_item->options->code,
                'quantity' => $cart_item->qty,
                'price' => $cart_item->price * 100,
                'unit_price' => $cart_item->options->unit_price * 100,
                'sub_total' => $cart_item->options->sub_total * 100,
                'product_discount_amount' => $cart_item->options->product_discount * 100,
                'product_discount_type' => $cart_item->options->product_discount_type,
                'product_tax_amount' => $cart_item->options->product_tax * 100,
            ]);

            $product = Product::findOrFail($cart_item->id);
            $product->update([
                'product_quantity' => $product->product_quantity - $cart_item->qty
            ]);
        }

        Cart::instance('sale')->destroy();

        if ($sale->paid_amount > 0) {
            SalePayment::create([
                'date' => now()->format('Y-m-d'),
                'reference' => 'INV/' . $sale->reference,
                'amount' => $sale->paid_amount,
                'sale_id' => $sale->id,
                'payment_method' => $request->payment_method
            ]);
        }

        return $sale->id;
    });


    toast('تم حفظ الفاتورة', 'success');

    return redirect()->route('sales.pos.pdf', $saleId);
}

    public function suspend(Request $request) {
    DB::transaction(function () use ($request) {
        $due_amount = $request->total_amount - $request->paid_amount;

        if ($due_amount == $request->total_amount) {
            $payment_status = 'Unpaid';
        } elseif ($due_amount > 0) {
            $payment_status = 'Partial';
        } else {
            $payment_status = 'Paid';
        }

        $sale_data = [
           'date' => now()->format('Y-m-d'),
            'reference' => 'PSL',
            'discount_percentage' => $request->discount_percentage,
            'paid_amount' => $request->paid_amount * 100,
            'total_amount' => $request->total_amount * 100,
            'status' => 'Completed',
            'payment_status' => $payment_status,
            'note' => $request->note,
            'discount_amount' => Cart::instance('sale')->discount() * 100,
            'suspend' => 1 ,  // Handle suspension
        ];

        // Add customer details if customer_id is provided
        if ($request->customer_id) {
            $sale_data['customer_id'] = $request->customer_id;
            $sale_data['customer_name'] = Customer::findOrFail($request->customer_id)->customer_name;
        }

        // Create the sale record
        $sale = Sale::create($sale_data);

        foreach (Cart::instance('sale')->content() as $cart_item) {
            SaleDetails::create([
                'sale_id' => $sale->id,
                'product_id' => $cart_item->id,
                'product_name' => $cart_item->name,
                'product_code' => $cart_item->options->code,
                'quantity' => $cart_item->qty,
                'price' => $cart_item->price * 100,
                'unit_price' => $cart_item->options->unit_price * 100,
                'sub_total' => $cart_item->options->sub_total * 100,
                'product_discount_amount' => $cart_item->options->product_discount * 100,
                'product_discount_type' => $cart_item->options->product_discount_type,
            ]);

            $product = Product::findOrFail($cart_item->id);
            $product->update([
                'product_quantity' => $product->product_quantity - $cart_item->qty
            ]);
        }

        Cart::instance('sale')->destroy();

        if ($sale->paid_amount > 0) {
            SalePayment::create([
                'date' => now()->format('Y-m-d'),
                'reference' => 'INV/'.$sale->reference,
                'amount' => $sale->paid_amount,
                'sale_id' => $sale->id,
                'payment_method' => $request->payment_method
            ]);
        }
    });

    toast('تم تعليق الفاتورة', 'success');

    return redirect()->back();
}


}
