@if($size_price ?? '')

@php($class = 'product-hover-icons')
@if($grid ?? '')
    @php($class = 'list-product-icons')
@endif

    <div class="{{ $class }}">
        @if(_value($product, 'conditions', 3) != 3)
            <a href="javascript:;" data-tooltip="Add to cart"> <span class="icon_cart_alt add-to-cart add_to_cart"></span></a>
        @endif
        <a href="javascript:;" style="display:none" data-tooltip="Quick view" class="data-quick-view" data-view-url='{{ route('store.get.product.quick.view', ["id"=>_value($product, "id")]) }}' data-view-id='{{ _value($product, "id")  }}' data-toggle="modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
    </div>

@endif


