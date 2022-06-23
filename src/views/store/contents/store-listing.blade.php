                            
                            
                                    @if($products ?? '')

                                        @foreach($products as $product)

                                            <!-- <div class="custom-col-5"> -->

                                                @include('store::products.components.items.shop-item', ['product'=>$product])

                                            <!-- </div> -->
                                            
                                        @endforeach

                                    @endif
                                        

                               