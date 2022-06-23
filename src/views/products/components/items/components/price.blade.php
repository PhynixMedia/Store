
@if($size_price ?? '')
    <span style="font-size:14px">{{ currency() }}</span>
    <span class="discounted-price item-price">{{ $size_price->prices->selling_price??'' }}</span>
@endif