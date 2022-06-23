<style>
    .product-title a{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width:100%;
        padding: 0 10px;
    }
</style>
<h3 class="product-title">
    <a class="link" href="{{ route('store.product.details', ['id'=>$product->id,'name'=>strip_chars($product->namex ?? '')]) }}"> 
        <span class="namex"> {{ _value($product, 'namex') }} </span>
    </a>
</h3>