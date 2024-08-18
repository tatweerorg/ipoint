<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> {{__('public.Home')}}
    </a>
</li>

@can('access_products')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('products.*') || request()->routeIs('product-categories.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-journal-bookmark" style="line-height: 1;"></i>{{__('public.Products')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        @can('access_product_categories')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('product-categories.*') ? 'c-active' : '' }}" href="{{ route('product-categories.index') }}">
                <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i>{{__('public.Categories')}}
            </a>
        </li>
        @endcan
        @can('create_products')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('products.create') ? 'c-active' : '' }}" href="{{ route('products.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>{{__('public.CreateProduct')}}
            </a>
        </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('products.index') ? 'c-active' : '' }}" href="{{ route('products.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>{{__('public.AllProducts')}}
            </a>
        </li>
        @can('print_barcodes')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('barcode.print') ? 'c-active' : '' }}" href="{{ route('barcode.print') }}">
                <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i>{{__('public.PrintBarcode')}}
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan

@can('access_adjustments')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('adjustments.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i> {{__('public.StockAdjustments')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        @can('create_adjustments')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('adjustments.create') ? 'c-active' : '' }}" href="{{ route('adjustments.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>{{__('public.CreateAdjustment')}}
            </a>
        </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('adjustments.index') ? 'c-active' : '' }}" href="{{ route('adjustments.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> {{__('public.AllAdjustments')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_quotations')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('quotations.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-cart-check" style="line-height: 1;"></i> {{__('public.Quotations')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        @can('create_adjustments')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('quotations.create') ? 'c-active' : '' }}" href="{{ route('quotations.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> {{__('public.CreateQuotation')}}
            </a>
        </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('quotations.index') ? 'c-active' : '' }}" href="{{ route('quotations.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> {{__('public.AllQuotations')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_purchases')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('purchases.*') || request()->routeIs('purchase-payments*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-bag" style="line-height: 1;"></i> {{__('public.Purchases')}}
    </a>
    @can('create_purchase')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('purchases.create') ? 'c-active' : '' }}" href="{{ route('purchases.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>{{__('public.CreatePurchase')}}
            </a>
        </li>
    </ul>
    @endcan
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('purchases.index') ? 'c-active' : '' }}" href="{{ route('purchases.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>{{__('public.AllPurchases')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_purchase_returns')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('purchase-returns.*') || request()->routeIs('purchase-return-payments.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-arrow-return-right" style="line-height: 1;"></i> {{__('public.PurchaseReturns')}}
    </a>
    @can('create_purchase_returns')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('purchase-returns.create') ? 'c-active' : '' }}" href="{{ route('purchase-returns.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>{{__('public.CreatePurchaseReturn')}}
            </a>
        </li>
    </ul>
    @endcan
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('purchase-returns.index') ? 'c-active' : '' }}" href="{{ route('purchase-returns.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> {{__('public.AllPurchaseReturns')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_sales')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('sales.*') || request()->routeIs('sale-payments*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-receipt" style="line-height: 1;"></i> {{__('public.Sales')}}
    </a>
    @can('create_sales')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('sales.create') ? 'c-active' : '' }}" href="{{ route('sales.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> {{__('public.CreateSale')}}
            </a>
        </li>
    </ul>
    @endcan
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('sales.index') ? 'c-active' : '' }}" href="{{ route('sales.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>{{__('public.AllSales')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_sale_returns')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('sale-returns.*') || request()->routeIs('sale-return-payments.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-arrow-return-left" style="line-height: 1;"></i>{{__('public.SaleReturns')}}
    </a>
    @can('create_sale_returns')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('sale-returns.create') ? 'c-active' : '' }}" href="{{ route('sale-returns.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>{{__('public.CreateSaleReturn')}}
            </a>
        </li>
    </ul>
    @endcan
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('sale-returns.index') ? 'c-active' : '' }}" href="{{ route('sale-returns.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> {{__('public.AllSaleReturns')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_expenses')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('expenses.*') || request()->routeIs('expense-categories.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-wallet2" style="line-height: 1;"></i>{{__('public.Expenses')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        @can('access_expense_categories')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('expense-categories.*') ? 'c-active' : '' }}" href="{{ route('expense-categories.index') }}">
                <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i>{{__('public.Categories')}}
            </a>
        </li>
        @endcan
        @can('create_expenses')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('expenses.create') ? 'c-active' : '' }}" href="{{ route('expenses.create') }}">
                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>{{__('public.CreateExpense')}}
            </a>
        </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('expenses.index') ? 'c-active' : '' }}" href="{{ route('expenses.index') }}">
                <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>{{__('public.AllExpenses')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_customers|access_suppliers')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('customers.*') || request()->routeIs('suppliers.*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> {{__('public.Parties')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        @can('access_customers')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('customers.*') ? 'c-active' : '' }}" href="{{ route('customers.index') }}">
                <i class="c-sidebar-nav-icon bi bi-people-fill" style="line-height: 1;"></i> {{__('public.Customers')}}
            </a>
        </li>
        @endcan
        @can('access_suppliers')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('suppliers.*') ? 'c-active' : '' }}" href="{{ route('suppliers.index') }}">
                <i class="c-sidebar-nav-icon bi bi-people-fill" style="line-height: 1;"></i> {{__('public.Suppliers')}}
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan

@can('access_reports')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('*-report.index') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-graph-up" style="line-height: 1;"></i> {{__('public.Reports')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('profit-loss-report.index') ? 'c-active' : '' }}" href="{{ route('profit-loss-report.index') }}">
                <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>{{__('public.Profit/LossReport')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('payments-report.index') ? 'c-active' : '' }}" href="{{ route('payments-report.index') }}">
                <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>{{__('public.PaymentsReport')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('sales-report.index') ? 'c-active' : '' }}" href="{{ route('sales-report.index') }}">
                <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>{{__('public.SalesReport')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('purchases-report.index') ? 'c-active' : '' }}" href="{{ route('purchases-report.index') }}">
                <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>{{__('public.PurchasesReport')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('sales-return-report.index') ? 'c-active' : '' }}" href="{{ route('sales-return-report.index') }}">
                <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>{{__('public.SalesReturnReport')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('purchases-return-report.index') ? 'c-active' : '' }}" href="{{ route('purchases-return-report.index') }}">
                <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> {{__('public.PurchasesReturnReport')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_user_management')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i>{{__('public.UserManagement')}}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('users.create') ? 'c-active' : '' }}" href="{{ route('users.create') }}">
                <i class="c-sidebar-nav-icon bi bi-person-plus" style="line-height: 1;"></i>{{__('public.CreateUser')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('users*') ? 'c-active' : '' }}" href="{{ route('users.index') }}">
                <i class="c-sidebar-nav-icon bi bi-person-lines-fill" style="line-height: 1;"></i> {{__('public.AllUsers')}}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('roles*') ? 'c-active' : '' }}" href="{{ route('roles.index') }}">
                <i class="c-sidebar-nav-icon bi bi-key" style="line-height: 1;"></i> {{__('public.Roles&Permissions')}}
            </a>
        </li>
    </ul>
</li>
@endcan

@can('access_currencies|access_settings')
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('currencies*') || request()->routeIs('units*') ? 'c-show' : '' }}">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon bi bi-gear" style="line-height: 1;"></i>{{__('public.Settings')}}
    </a>
    @can('access_units')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('units*') ? 'c-active' : '' }}" href="{{ route('units.index') }}">
                <i class="c-sidebar-nav-icon bi bi-calculator" style="line-height: 1;"></i> {{__('public.Units')}}
            </a>
        </li>
    </ul>
    @endcan
    @can('access_currencies')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('currencies*') ? 'c-active' : '' }}" href="{{ route('currencies.index') }}">
                <i class="c-sidebar-nav-icon bi bi-cash-stack" style="line-height: 1;"></i>{{__('public.Currencies')}}
            </a>
        </li>
    </ul>
    @endcan
    @can('access_settings')
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'c-active' : '' }}" href="{{ route('settings.index') }}">
                <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i>{{__('public.SystemSettings')}} 
            </a>
        </li>
    </ul>
    @endcan
</li>
@endcan