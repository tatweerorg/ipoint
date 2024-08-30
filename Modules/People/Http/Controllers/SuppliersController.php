<?php

namespace Modules\People\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Modules\People\Entities\Supplier;
use Illuminate\Contracts\Support\Renderable;
use Modules\People\DataTables\SuppliersDataTable;

class SuppliersController extends Controller
{

    public function index(SuppliersDataTable $dataTable) {
        abort_if(Gate::denies('access_suppliers'), 403);

        return $dataTable->render('people::suppliers.index');
    }


    public function create() {
        abort_if(Gate::denies('create_suppliers'), 403);

        return view('people::suppliers.create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create_suppliers'), 403);

        $request->validate([
            'supplier_name'  => 'required|string|max:255',
            'supplier_phone' => 'required|max:255',
            'supplier_email' => 'required|email|max:255',
            'city'           => 'required|string|max:255',
            'country'        => 'required|string|max:255',
            'address'        => 'required|string|max:500',
        ]);

        Supplier::create([
            'supplier_name'  => $request->supplier_name,
            'supplier_phone' => $request->supplier_phone,
            'supplier_email' => $request->supplier_email,
            'city'           => $request->city,
            'country'        => $request->country,
            'address'        => $request->address
        ]);

        toast('Supplier Created!', 'success');

        return redirect()->route('suppliers.index');
    }


    public function show(Supplier $supplier)
{
    abort_if(Gate::denies('show_suppliers'), 403);

    $cacheKey = 'supplier_show_' . $supplier->id;

    $cachedView = Cache::remember($cacheKey, 60, function () use ($supplier) {
        return view('people::suppliers.show', compact('supplier'))->render();
    });

    return $cachedView;
}



    public function edit(Supplier $supplier) {
        abort_if(Gate::denies('edit_suppliers'), 403);

        return view('people::suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, Supplier $supplier) {
        abort_if(Gate::denies('edit_suppliers'), 403);

        $request->validate([
            'supplier_name'  => 'required|string|max:255',
            'supplier_phone' => 'required|max:255',
            'supplier_email' => 'required|email|max:255',
            'city'           => 'required|string|max:255',
            'country'        => 'required|string|max:255',
            'address'        => 'required|string|max:500',
        ]);

        $supplier->update([
            'supplier_name'  => $request->supplier_name,
            'supplier_phone' => $request->supplier_phone,
            'supplier_email' => $request->supplier_email,
            'city'           => $request->city,
            'country'        => $request->country,
            'address'        => $request->address
        ]);

        toast('Supplier Updated!', 'info');

        return redirect()->route('suppliers.index');
    }


    public function destroy(Supplier $supplier) {
        abort_if(Gate::denies('delete_suppliers'), 403);

        $supplier->delete();

        toast('Supplier Deleted!', 'warning');

        return redirect()->route('suppliers.index');
    }
}
