<div class="slider tab-slider mb-35">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="tab-slider-wrapper">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="featured-tab" data-toggle="tab" href="#featured" role="tab"
									aria-selected="true">Featured</a>
								<a class="nav-item nav-link" id="new-arrival-tab" data-toggle="tab" href="#new-arrivals" role="tab"
									aria-selected="false">New Arrival</a>
								<a class="nav-item nav-link" id="nav-onsale-tab" data-toggle="tab" href="#on-sale" role="tab"
									aria-selected="false">On Sale</a>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
								<!--=======  tab slider container  =======-->
								
								<div class="tab-slider-container">
									<!--=======  single tab slider item  =======-->

										@include('store-app::products.components.items.items-tab', ['products'=>_products()])
									
									<!--=======  End of single tab slider product  =======-->
								</div>
									
								<!--=======  End of tab slider container  =======-->
								</div>
							<div class="tab-pane fade" id="new-arrivals" role="tabpanel" aria-labelledby="new-arrival-tab">
								<!--=======  tab slider container  =======-->
																
								<div class="tab-slider-container">

										@include('store-app::products.components.items.items-tab', ['products'=>_latest()])

									<!--=======  single tab slider item  =======-->
								</div>
										
								<!--=======  End of tab slider container  =======-->
							</div>
							<div class="tab-pane fade" id="on-sale" role="tabpanel" aria-labelledby="nav-onsale-tab">
								<!--=======  tab slider container  =======-->
																
								<div class="tab-slider-container">

									@include('store-app::products.components.items.items-tab', ['products'=>_sales()])

								<!--=======  single tab slider item  =======-->
								</div>
										
								<!--=======  End of tab slider container  =======-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<!--=====  End of Tab slider  ======-->

