

@include('store::store.contents.store-banner')


	<!--=============================================
	=            Shop page container         =
	=============================================-->
	
	<div class="shop-page-container mb-50">
		<div class="container">
			<div class="row">
				
            
            <div class="col-lg-3 order-2 order-lg-1">
					<!--=======  sidebar area  =======-->
					
					<div class="sidebar-area">
						<!--=======  single sidebar  =======-->
						
						<div class="sidebar mb-35">
							<h3 class="sidebar-title">PRODUCT CATEGORIES</h3>
							<ul class="product-categories">
                                @include('store::store.contents.store-sidebar')
							</ul>
						</div>
						
						<!--=======  End of single sidebar  =======-->

						<!--=======  single sidebar  =======-->
						
						<div class="sidebar">
							<h3 class="sidebar-title">Product Tags</h3>
							<!--=======  tag container  =======-->
							
							<ul class="tag-container">
								<li><a href="#">new</a> </li>
								<li><a href="#">bags</a> </li>
								<li><a href="#">new</a> </li>
								<li><a href="#">kids</a> </li>
								<li><a href="#">fashion</a> </li>
								<li><a href="#">Accessories</a> </li>
							</ul>
							
							<!--=======  End of tag container  =======-->
						</div>
						
						<!--=======  End of single sidebar  =======-->
					</div>
					
					<!--=======  End of sidebar area  =======-->
				</div>
				<div class="col-lg-9 order-1 order-lg-2 mb-sm-35 mb-xs-35">

					<!--=======  shop page banner  =======-->
					
					<div class="shop-page-banner mb-35">
						<a href="#">
							<img src="{{ asset('assets/images/banners/shop-banner.jpg') }}" class="img-fluid" alt="">
						</a>
					</div>
					
					<!--=======  End of shop page banner  =======-->

					<!--=======  Shop header  =======-->
					
					<div class="shop-header mb-35">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center">
								<!--=======  view mode  =======-->
								
								<div class="view-mode-icons mb-xs-10">
									<a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
									<a href="#" data-target="list"><i class="fa fa-list"></i></a>
								</div>
								
								<!--=======  End of view mode  =======-->
								
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
								<!--=======  Sort by dropdown  =======-->
								
								<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
									<p class="mr-10">Sort By: </p>
									<select name="sort-by" id="sort-by" class="nice-select">
										<option value="0">Sort By Popularity</option>
										<option value="0">Sort By Average Rating</option>
										<option value="0">Sort By Newness</option>
										<option value="0">Sort By Price: Low to High</option>
										<option value="0">Sort By Price: High to Low</option>
									</select>
								</div>
								
								<!--=======  End of Sort by dropdown  =======-->

                                @if($products ?? '')
								    <p class="result-show-message">Showing {{ $products->from() }} - {{ $products->to() }} of {{ $products->total() }} results</p>
                                @endif
							</div>
						</div>
					</div>
					
					<!--=======  End of Shop header  =======-->

					<!--=======  Grid list view  =======-->
					
					<div class="shop-product-wrap grid row no-gutters mb-35">
                        
                    @if($products ?? '')
                        @include('store::store.contents.store-listing', ['products' => $products->data()])
                    @endif 

					</div>
					
					<!--=======  End of Grid list view  =======-->

					<!--=======  Pagination container  =======-->

                    @if($products ?? '')
					
                        <div class="pagination-container">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--=======  pagination-content  =======-->
                                        
                                        <div class="pagination-content text-center">
                                            @include('store::products.components.paginator', ["paginator"=>$products])
                                            <!-- <ul>
                                                <li><a class="active" href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul> -->
                                        </div>
                                        
                                        <!--=======  End of pagination-content  =======-->
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
					
					<!--=======  End of Pagination container  =======-->

				</div>
			</div>
		</div>
	</div>
