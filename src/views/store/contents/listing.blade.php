                            
                            
                                    @if($products ?? '')

                                        @foreach($products as $product)

                                            @include('store-app::products.components.items.shop-item', ['product'=>$product])

                                        @endforeach

                                    @endif
                                        

                               