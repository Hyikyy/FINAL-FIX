@if ($paginator->hasPages())
    <nav aria-label="Gallery navigation">
        <ul class="pagination justify-content-center">
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">Previous</a>
                </li>
            @endif

            {{-- Numbered Page Links --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @elseif (is_array($element))
                    @foreach ($element as $key => $url)
                      @if (is_numeric($key))
                        @if ($paginator->currentPage() == $key)
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $key }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $key }}</a></li>
                        @endif
                      @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif