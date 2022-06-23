


                                    

                                                    @if($categories = _category())

                                                        @foreach($categories as $index => $category)

                                                            @if($category->children??'')
                                                            <li class="has-sub">
                                                                <a href="{{ url('/store/category/' . $category->id .'/ct/' . $category->url??'') }}"> 
                                                                     {{ string_limit($category->namex??'', 22) }} 
                                                                </a>
                                                                    <ul>
                                                                        @foreach($category->children as $child)

                                                                            <li><a href="{{ url('/store/category/' . $child->id .'/ct/' . $child->url??'') }}">{{ $child->namex??'' }}</a></li>

                                                                        @endforeach
                                                                    </ul>
                                                                </li>

                                                            @else

                                                                <li style="padding:5px 10px">
                                                                    <a href="{{ url('/store/category/' . $category->id .'/ct/' . $category->url??'') }}"> 
                                                                    {{ string_limit($category->namex, 22) }}
                                                                    </a>
                                                                </li>
                                                                
                                                            @endif

                                                        @endforeach

                                                    @endif

                                       