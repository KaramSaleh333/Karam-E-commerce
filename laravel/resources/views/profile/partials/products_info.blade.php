<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Products Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Add your Products and Show Them.") }}
        </p>
    </header>
    <br>
    <h2><a href="{{route('products.create')}}">Add Product</a></h2> <br>
    <h2><a href="{{route('products.index')}}">My Products</a></h2><br>
    <h2><a href="{{route('payments.seller_show')}}">My orders</a></h2>

</section>
