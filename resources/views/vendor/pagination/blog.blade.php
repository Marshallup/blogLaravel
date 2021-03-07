@if ($paginator->hasPages())
    <div class="row">
        <div class="col-lg-12">
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    @php
                        function setFormatNumber($number)
                        {
                          return sprintf('%02d', $number);
                        }
                    @endphp
                    {{-- Prev Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item">
                            <span class="page-link" aria-label="@lang('pagination.previous')">
                                      <span aria-hidden="true">
                                          <span class="ti-arrow-left"></span>
                                      </span>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="@lang('pagination.previous')">
                                      <span aria-hidden="true">
                                          <span class="ti-arrow-left"></span>
                                      </span>
                            </a>
                        </li>
                    @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ setFormatNumber($page) }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ setFormatNumber($page) }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="@lang('pagination.next')">
                                      <span aria-hidden="true">
                                          <span class="ti-arrow-right"></span>
                                      </span>
                            </a>
                        </li>
                        @else
                        <li class="page-item">
                            <span class="page-link" aria-label="@lang('pagination.next')">
                                          <span aria-hidden="true">
                                              <span class="ti-arrow-right"></span>
                                          </span>
                            </span>
                        </li>
                        @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
