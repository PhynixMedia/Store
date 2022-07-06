
                                    @php  $size_price = '';  @endphp
                                        @if(isset($product->sizes))
                                            @foreach($product->sizes as $index => $size)
                                                @if($size->status==1 && isset($size->prices))

                                                    @php $size_price = $size; @endphp

                                                    @break
                                                @endif 
                                            @endforeach
                                        @endif

                                   
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
								<!--=======  Grid view product  =======-->
								
								<div class="gf-product shop-grid-view-product  wrap-items" 
                                    id="{{ $size_price->products_id??'0' }}|{{ $size_price->size_id??'0' }}" 
                                    data-size="{{ $size_price->size_in_kg??env('APP_SHIPPING_DEFAULT_SIZE') }}">

									<div class="image">
                                        
                                        @include('store-app::products.components.items.components.image')

										@include('store-app::products.components.items.components.add-to-cart-btn')
                                        
									</div>
									<div class="product-content">
										<div class="product-categories">
                                            <a href="#">{{ _value2($product, 'category', 'namex') }}</a>
										</div>
										@include('store-app::products.components.items.components.item-name')
										<div class="price-box">
                                            @include('store-app::products.components.items.components.price')
										</div>
									</div>
									
								</div>
								<!-- <span class="onsale">Sale!</span> -->
								<!--=======  End of Grid view product  =======-->
	
								<!--=======  Shop list view product  =======-->
								
								<div class="gf-product shop-list-view-product  wrap-items" 
                                    id="{{ $size_price->products_id??'0' }}|{{ $size_price->size_id??'0' }}" 
                                    data-size="{{ $size_price->size_in_kg??env('APP_SHIPPING_DEFAULT_SIZE') }}">

									<div class="image">

                                        @include('store-app::products.components.items.components.image')
                                        
									</div>
									<div class="product-content">
										<div class="product-categories">
                                            <a href="#">{{ _value2($product, 'category', 'namex') }}</a>
										</div>
										@include('store-app::products.components.items.components.item-name')
										<div class="price-box mb-20">
                                            @include('store-app::products.components.items.components.price')
										</div>
										<p class="product-description">
                                            {{ $product->description ?? ""}}
                                        </p>
                                        
                                        @include('store-app::products.components.items.components.add-to-cart-btn', ["grid"=>true])
										
									</div>
									
								</div>
							
							<!--=======  End of Shop list view product  =======-->
							</div>