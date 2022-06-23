
		@php($column = $columns ?? 2)

        @if($products = two_sort_products($products, $column))

			@foreach($products as $set)

				<div class="single-tab-slider-item">
					<!--=======  tab slider sub product  =======-->

					@foreach($set as $product)

						@include('store::products.components.items.column', ['product'=>$product])

					@endforeach

					<!--=======  End of tab slider sub product  =======-->
				</div>

			@endforeach

		@endif