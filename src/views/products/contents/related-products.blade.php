@if($related ?? "")

<div class="slider tab-slider mb-35">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="tab-slider-wrapper">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="featured-tab" data-toggle="tab" href="#featured" role="tab"
									aria-selected="true">Related Products</a>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
								<!--=======  tab slider container  =======-->
								
								<div class="tab-slider-container">
									<!--=======  single tab slider item  =======-->

										@include('store::products.components.items.items-tab', ['products'=>$related, "columns"=>1])
									
									<!--=======  End of single tab slider product  =======-->
								</div>
									
								<!--=======  End of tab slider container  =======-->
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endif
	
	<!--=====  End of Tab slider  ======-->

