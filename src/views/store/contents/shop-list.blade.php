@if($products??'')

        <div class="main-content-wrap shop-page section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-lg-1 order-2">
                        <!-- shop-sidebar-wrap start -->
                        <div class="shop-sidebar-wrap">
                            <div class="shop-box-area">

                                <!--sidebar-categores-box start  -->
                                <div class="sidebar-categores-box shop-sidebar mb-30">
                                    <h4 class="title">Product categories</h4>
                                    <!-- category-sub-menu start -->
                                    <div class="category-sub-menu">
                                        <ul>
                                            @include('store::category.list')
                                        </ul>
                                    </div>
                                    
                                    <!-- category-sub-menu end -->
                                </div>
                                <!--sidebar-categores-box end  -->

                                <!-- shop-sidebar start -->
                                <div class="shop-sidebar mb-30" style="display:none">
                                    <h4 class="title">Filter By Price</h4>
                                    <!-- filter-price-content start -->
                                    <div class="filter-price-content">
                                        <form action="#" method="post">
                                            <div id="price-slider" class="price-slider"></div>
                                            <div class="filter-price-wapper">

                                                <a class="add-to-cart-button" href="#">
                                                    <span>FILTER</span>
                                                </a>
                                                <div class="filter-price-cont">

                                                    <span>Price:</span>
                                                    <div class="input-type">
                                                        <input type="text" id="min-price" readonly="" />
                                                    </div>
                                                    <span>—</span>
                                                    <div class="input-type">
                                                        <input type="text" id="max-price" readonly="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- filter-price-content end -->
                                </div>
                                <!-- shop-sidebar end -->

                            </div>
                        </div>
                        <!-- shop-sidebar-wrap end -->
                    </div>
                    <div class="col-lg-9 order-lg-2 order-1">

                        <div class="shop-banner mb-30">
                            <img src="{{ asset('assets/images/category-page.jpg') }}" alt="Shop banner">
                        </div>

                        <!-- shop-product-wrapper start -->
                        <div class="shop-product-wrapper">
                            <div class="row align-itmes-center">
                                <div class="col">
                                    <!-- shop-top-bar start -->
                                    <div class="shop-top-bar">
                                        <!-- product-view-mode start -->

                                        <div class="product-mode">
                                            <!--shop-item-filter-list-->
                                            <ul class="nav shop-item-filter-list" role="tablist">
                                                <li class="active"><a class="active grid-view" data-toggle="tab" href="#grid"><i class="ion-ios-keypad-outline"></i></a></li>
                                                <li><a class="list-view" data-toggle="tab" href="#list"><i class="ion-ios-list-outline"></i></a></li>
                                            </ul>
                                            <!-- shop-item-filter-list end -->
                                        </div>
                                        <!-- product-view-mode end -->
                                        <!-- product-short start -->
                                        <div class="product-short">
                                            <p>Sort By :</p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                            </select>
                                        </div>
                                        <!-- product-short end -->
                                    </div>
                                    <!-- shop-top-bar end -->
                                </div>
                            </div>
                        
                            <!-- shop-products-wrap start -->
                            <div class="shop-products-wrap">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="grid">
                                        <div class="shop-product-wrap">
                                            <div class="row row-8">

                                            @foreach($products as $product)
                            
                                                {{-- @include('store::products.components.items.shop-item', ['product'=>$product, 'is_large'=>1]) --}}
                                    
                                            @endforeach 
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="list">

                                        @foreach($products as $product)
                                
                                            {{-- @include('store::products.components.items.shop-item', ['product'=>$product, 'is_large'=>0]) --}}
                                
                                        @endforeach
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- shop-products-wrap end -->

                            @include('store::products.paginator', ["paginator"=>$products])

                        
                        </div>
                        <!-- shop-product-wrapper end -->
                    </div>
                </div>
            </div>
        </div>

    
    
        <!-- main-content-wrap end -->

        @else

                <section class="error_area" style="padding-top:250px;padding-bottom:250px;">
                    <img class="error_shap" src="img/breadcrumb/banner_bg.png" alt="">
                    <div class="container flex">
                        <div class="error_contain text-center">
                            <div class="b_text">
                                <h1 class="f_p w_color f_700">Oh Sorry! We're out of stock</h1>
                            </div>
                            <h2 class="f_p f_400 w_color f_size_30">Please, kindly check back or contact support for assistance at {{ env('APP_ENQUIRY') }}. </h2>
                            <p class="w_color f_400">  
                            Our online team will get in touch with you without delay. Thank you for shopping with us!
                            </p>
                            <a href="{{ url('/') }}" class="about_btn btn_hover mt_40">Go Back to home Page</a>
                        </div>
                    </div>
                </section>

        @endif


        @include('web::pages.home.sales')