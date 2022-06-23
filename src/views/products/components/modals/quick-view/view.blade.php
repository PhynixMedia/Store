
@if(isset($product))
    <!-- THIS WAS USED TO PREVENT PRICE ASSIGN ERROR -->
    @php  $size_price = '';  @endphp
    @if(isset($product->sizes))
        @foreach($product->sizes as $index => $size)
            @if($size->status==1 && isset($size->prices))

                @php $size_price = $size; @endphp

                @break

            @endif
        @endforeach
    @endif

        <div class="row wrap-items"
                 id="{{ $size_price->products_id??'0' }}|{{ $size_price->size_id??'0' }}"
                 data-size="{{ $size_price->size_in_kg??env('APP_SHIPPING_DEFAULT_SIZE') }}">

            <div class="col-lg-5 col-md-6 col-xs-12">
                <!-- product quickview image gallery -->
                <div class="product-image-slider">
                    <!--Modal Tab Content Start-->
                    <a style="display: none" class="link" href="{{ url('/store/' . $product->id . '/rq/' . strip_chars($product->namex) ) }}"></a>

                    <div class="tab-content product-large-image-list" id="myTabContent">
                        <div class="tab-pane fade show active" id="single-slide1" role="tabpanel" aria-labelledby="single-slide-tab-1">
                            <!--Single Product Image Start-->

                                    @if($product->images ?? '')

                                        @foreach($product->images as $index => $image)
                                            <div class="single-small-image img-full">
                                                <img src="{{ env('APP_ADMIN_URL') }}/{{ $image->small ?? str_replace('products', 'products/__raw', $image->image_path) }}" class="img-fluid _image" alt="{{ $product->namex??'' }}">
                                            </div>
                                            @break
                                        @endforeach

                                    @endif

                            <!--Single Product Image End-->
                        </div>
                    </div>
                    <!--Modal Content End-->

                    <!--Modal Tab Menu End-->
                </div>
                <!-- end of product quickview image gallery -->
            </div>
            <div class="col-lg-7 col-md-6 col-xs-12">
                <!-- product quick view description -->
                <div class="product-feature-details">
                    <h2 class="product-title mb-15 namex">{{ $product->namex??'' }}</h2>

                    <h2 class="product-price mb-15">
                        {{ currency() }}<span class="discounted-price new-price item-price">{{ $size_price->prices->selling_price??'0.00' }}</span>
                    </h2>

                    <p class="product-description mb-20">
                        {{ $product->description ?? '' }}
                    </p>

                    {{--     SIZE SECTION OF DETAILS               --}}

                    <div class="row">
                        <div class="col-lg-12 cart-buttons mb-20">
                            <select class="nice-select product_sizes select_option">
                                @if(isset($product->sizes))

                                    @foreach($product->sizes as $index => $size)

                                        @if($size->status==1)

                                            @if(isset($size->prices))

                                                @php $size->prices->size_in_kg = $size->size_in_kg @endphp

                                                <option value="{{ json_encode($size->prices) }}">{{ $size->size??'' }}</option>

                                            @endif

                                        @endif

                                    @endforeach

                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="cart-buttons mb-20">
                        <div class="pro-qty mr-10">
                            <input name="qty" type="text" class="qty custom-qty" value="1">
                        </div>

                        <div class="add-to-cart-btn">
                            @if($size_price && $product->conditions != 3)
                                <a class="add-to-cart add_to_cart" href="javascript:;"><i class="fa fa-shopping-cart"></i> Buy Now</a>
                            @endif
                        </div>
                    </div>


                    <div class="social-share-buttons">
                        <h3>share this product</h3>
                        <ul>
                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- end of product quick view description -->
            </div>
        </div>

    <script>
        $(function(e){
            /*-----
            Quantity
            --------------------------------*/
            $('.pro-qty').append('<a href="#" class="inc qty-btn">+</a>');
            $('.pro-qty').append('<a href="#" class= "dec qty-btn">-</a>');
            $('.qty-btn').on('click', function (e) {
                e.preventDefault();
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find('input').val(newVal);
            });
        })

        /*--
        Nice Select
        ------------------------*/
        $('.nice-select').niceSelect();

    </script>
@endif

