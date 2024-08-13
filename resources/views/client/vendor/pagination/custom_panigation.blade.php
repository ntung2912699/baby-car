@if ($paginator->hasPages())
    <div class="col text-center">
        <div class="block-27">
            <ul>
                @if ($paginator->onFirstPage())
                    <li class="disabled">&lt;</li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li>{{ $element }}</li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <a class="disabled">{{ $page }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
                    </li>
                @else
                    <li class="disable">&gt;</li>
                @endif
            </ul>
        </div>
    </div>
@endif
