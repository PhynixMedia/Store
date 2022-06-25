                            
                            
                                    @if($products ?? '')

                                        @foreach($products as $product)

                                            @include('store::products.components.items.shop-item', ['product'=>$product])

                                        @endforeach

                                    @endif
                                        

                               