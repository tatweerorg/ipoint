<div>
    <div class="form-row">
        <div class="col-md-7">
            <div class="form-group">
                <label>{{__('public.ProductCategory')}}</label>
                <select wire:model.live="category" class="form-control">
                    <option value="">{{__('public.AllProducts')}}</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>{{__('public.ProductCount')}}</label>
                <select wire:model.live="showCount" class="form-control">
                    <option value="9">9 {{__('public.Products')}}</option>
                    <option value="15">15 {{__('public.Products')}}</option>
                    <option value="21">21 {{__('public.Products')}}</option>
                    <option value="30">30 {{__('public.Products')}}</option>
                    <option value="">{{__('public.AllProducts')}}</option>
                </select>
            </div>
        </div>
    </div>
</div>