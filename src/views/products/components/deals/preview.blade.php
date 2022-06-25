<div style="display:none" class="deal_items">
                                                                
    @if($deal->items??'')

       <table class="table" width="100%">
            <thead>
                <tr>
                    <th>SN</th><th>Items</th><th>Size</th><th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                                                                            
                @foreach($deal->items as $index => $item)

                    <tr>
                        <td>
                            {{ ++$index }}
                        </td>
                        <td>
                            {{ $item->products->namex??'' }}
                        </td>
                        <td>
                            {{ $item->size->size??'' }}
                        </td>
                        <td>
                            {{ $item->item_deal_qty??'' }}
                        </td>
                    </tr>
                @endforeach
                                                                            
            </tbody>
        </table>

    @endif

</div>