                    
                            <!-- THIS WAS USED TO PREVENT PRICE ASSIGN ERROR -->

                            @php  $size_price = '';  @endphp
                            @if($product->sizes??'')
                                @foreach($product->sizes as $index => $size)
                                    @if($size->status==1 && isset($size->prices))

                                        @php $size_price = $size; @endphp

                                    @break
                                    @endif 
                                @endforeach
                            @endif

                            <!-- SIZE SETTINGS ENDS HERE -->

                            @if($product ?? '')

                                <div class="gf-product shop-grid-view-product wrap-items"
                                    id="{{ $size_price->products_id??'0' }}|{{ $size_price->size_id??'0' }}"
                                    data-size="{{ $size_price->size_in_kg??env('APP_SHIPPING_DEFAULT_SIZE') }}">

                                    <div class="image" style="padding:20px">
                                        @include('store-app::products.components.items.components.image')
                                    </div>

                                    @include('store-app::products.components.items.components.add-to-cart-btn')

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

                            @endif