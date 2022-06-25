
        @php
            $category = $product->category ?? ''
        @endphp

        @php  $size_price = '';  @endphp

        @if(isset($product->sizes))
            @foreach($product->sizes as $index => $size)
                @if($size->status==1 && isset($size->prices))

                    @php $size_price = $size; @endphp
                    @break

                @endif 
            @endforeach
        @endif

        @include('store::store.contents.store-banner')


    @if($product??'')

        @php  $size_price = '';  @endphp
        @if(isset($product->sizes))
            @foreach($product->sizes as $index => $size)
                @if($size->status==1 && isset($size->prices))

                    @php $size_price = $size; @endphp
                    @break
                @endif
            @endforeach
        @endif

<!--=============================================
=            single product content         =
=============================================-->

<div class="single-product-content main-content-wrap shop-page section-ptb wrap-items mt-70 mb-70"
        id="{{ $size_price->products_id??'0' }}|{{ $size_price->size_id??'0' }}"
        data-size="{{ $size_price->size_in_kg??env('APP_SHIPPING_DEFAULT_SIZE') }}">

    <div class="container">
        <!--=======  single product content container  =======-->
        <div class="single-product-content-container mb-35">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xs-12">

                    <!-- product image gallery -->
                    <div class="product-image-slider d-flex flex-custom-xs-wrap flex-sm-nowrap align-items-center mb-sm-35">
                            <!--Modal Tab Menu Start-->
                            <div class="product-small-image-list">

                                <div class="nav small-image-slider-single-product" role="tablist">

                                @if($product->images ?? '')

                                    @foreach($product->images as $index => $image)
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-{{ $index }}" href="#single-slide{{ $index }}">
                                            <img src="{{ env('APP_ADMIN_URL') }}/{{ $image->small ?? str_replace('products', 'products/__raw', $image->image_path) }}" class="img-fluid" alt="{{ $product->namex??'' }}">
                                        </a>
                                    </div>
                                    @endforeach

                                @endif

                                </div>

                            </div>

                            <!--Modal Tab Content Start-->
                            <div class="tab-content product-large-image-list">


                            @if($product->images??'')


                                @php $active = 'show active'  @endphp

                                @foreach($product->images as $index => $image)

                                @if($index != 0)
                                    @php $active = ''  @endphp
                                @endif

                                <div class="tab-pane fade {{ $active ?? '' }}" id="single-slide{{ $index }}" role="tabpanel" aria-labelledby="single-slide-tab-{{ $index }}">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img easyzoom img-full">
                                        <img class="img-fluid _image" style="width:100%" src="{{ env('APP_ADMIN_URL') }}/{{ $image->medium ?? str_replace('products', 'products/__raw', $image->image_path) }}" alt="{{ $product->namex??'' }}">
                                        <a class="link" href="{{ env('APP_ADMIN_URL') }}/{{ $image->large ?? str_replace('products', 'products/__raw', $image->image_path) }}" class="big-image-popup"><i class="fa fa-search-plus"></i></a>
                                    </div>
                                    <!--Single Product Image End-->
                                </div>

                                @endforeach
                            @endif


                            </div>
                            <!--Modal Content End-->

                        </div>
                        <!-- end of product image gallery -->
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <!-- product quick view description -->
                    <div class="product-feature-details">
                        <h2 class="product-title mb-15 namex">{{ $product->namex??'' }}</h2>

                        <h2 class="product-price mb-15">

                            {{ currency() }}<span class="discounted-price new-price item-price">{{ $size_price->prices->selling_price??'0.00' }}</span>

                        </h2>

                        <p class="product-description mb-20">
                            {!! $product->description??'' !!}
                        </p>

                        <div class="cart-buttons mb-20">
                            <div class="add-to-cart-btn">

                                @if($size_price && $product->conditions != 3)
                                <a class="add-to-cart" href="javascript:;"><i class="fa fa-shopping-cart"></i> Buy Now</a>
                                @endif
                            </div>
                        </div>

                        <div class="cart-buttons mb-20">

                            <p class="mr-10">Product Size(s): </p>

                            <div class="sort-by-dropdown d-flex align-items-center mb-xs-10">

                                <select name="sort-by" id="sort-by" class="nice-select product_sizes select_option">

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

                        <p class="mr-10">Quantity: </p>
                        {{-- @include('cart::pages.newcart.components.quantity', ['index'=>1, 'custom'=>'custom-qty']) --}}

                        <div class="single-product-category mb-20">
                            <h3>Categories: <span> <a href="#">{{ _value2($product, 'category', 'namex') }}</a></span></h3>
                        </div>


                        <div class="social-share-buttons">
                            <h3>share this product</h3>
                            <ul>
                                <li><a class="twitter" href="https://twitter.com/share?hashtags={{ env('APP_NAME') }}&text={{ $product->namex ?? ''}}"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="pinterest" href="http://pinterest.com/pinthis?url={{ url()->current() }}"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end of product quick view description -->
                </div>
            </div>
        </div>

    <!--=======  End of single product content container  =======-->

    </div>

</div>

@endif

<!--
  Single Row Products Panes Folder:
-->
     @include('store::products.contents.related-products', ["related"=>$related ?? "", "columns"=>1])