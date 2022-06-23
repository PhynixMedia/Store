@if($product->conditions == 1)
    <span class="onsale">New</span>
@elseif($product->conditions == 2)
    <span class="onsale">Sale</span>
@elseif($product->conditions == 3)
    <span class="onsale">Sold</span>
@endif