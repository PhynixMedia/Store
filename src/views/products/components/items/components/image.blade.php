


@if($product->images??'')

    @if(isset($product->images))

        <a href="{{ route('store.product.details', ['id'=>$product->id,'name'=>strip_chars($product->namex ?? '')]) }}">
            <img class="_image" src="{{ env('APP_ADMIN_URL') }}/{{ $product->images[0]->small ?? str_replace('products', 'products/__raw', $product->images[0]->image_path??'') }}" alt="{{ $product->namex??'' }}">
        </a>    

    @endif

@endif