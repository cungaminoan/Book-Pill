@if($paginator->hasPages() && $paginator->total() > 0)
    @php($check = 0)
    @php($checkMiddleLast = 0)
    @php($checkMiddleFirst = 0)
    <section class="pager">
        <ul class="flex flex-row">
            @if(!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}">
                    <li>
                        <span>
                            &lt;
                        </span>
                    </li>
                </a>
            @endif

            @foreach($elements as $element)
                @if(is_array($element))
                    @if($paginator->lastPage() <= 12)
                        @foreach($element as $page => $url)
                            @if($page == $paginator->currentPage())
                                <a class="active_choice">
                                    <li>
                                        <span>
                                            {{$page}}
                                        </span>
                                    </li>
                                </a>
                            @else
                                <a href="{{ $url }}">
                                    <li>
                                        <span>
                                            {{ $page }}
                                        </span>
                                    </li>
                                </a>
                            @endif
                        @endforeach
                    @else
                        @foreach($element as $page => $url)
                            @if($paginator->currentPage() >= $paginator->lastPage() - 6)
                                @if($page == 1 || $page == 2)
                                    <a href="{{$url}}">
                                        <li>
                                            <span>{{$page}}</span>
                                        </li>
                                    </a>
                                    @if($check == 0 && $page == 2)
                                        <a>
                                            <li>
                                                ...
                                            </li>
                                        </a>
                                        @php($check = 1)
                                    @endif
                                @elseif($page >= $paginator->lastPage() - 9)
                                    @if($page == $paginator->currentPage())
                                        <a class="active_choice">
                                            <li>
                                                <span>
                                                    {{$page}}
                                                </span>
                                            </li>
                                        </a>
                                    @else
                                        <a href="{{ $url }}">
                                            <li>
                                                <span>
                                                    {{$page}}
                                                </span>
                                            </li>
                                        </a>
                                    @endif
                                @endif
                            @elseif($paginator->currentPage() <= 6)
                                @if($page <= 10)
                                    @if($page == $paginator->currentPage())
                                        <a class="active_choice">
                                            <li>
                                                <span>
                                                    {{$page}}
                                                </span>
                                            </li>
                                        </a>
                                    @else
                                        <a href="{{$url}}">
                                            <li>
                                                <span>{{$page}}</span>
                                            </li>
                                        </a>
                                    @endif
                                @elseif($page > 10)
                                    @if($check == 0)
                                        <a>
                                            <li>
                                                ...
                                            </li>
                                        </a>
                                        @php($check = 1)
                                    @endif
                                    @if($page == $paginator->lastPage() - 1 || $page == $paginator->lastPage())
                                        <a href="{{ $url }}">
                                            <li>
                                                <span>
                                                    {{$page}}
                                                </span>
                                            </li>
                                        </a>
                                    @endif
                                @endif

                            @else
                                @if($page <= 2 || $page >= $paginator->lastPage() - 1 )
                                    <a href="{{ $url }}">
                                        <li>
                                            <span>
                                                {{$page}}
                                            </span>
                                        </li>
                                    </a>
                                @elseif( $page <= $paginator->currentPage() + 3 && $page >= $paginator->currentPage() - 3)
                                    @if($checkMiddleFirst == 0)
                                        <a>
                                            <li>
                                                <span>
                                                    ...
                                                </span>
                                            </li>
                                            @php($checkMiddleFirst = 1)
                                        </a>
                                    @endif
                                    @if($page == $paginator->currentPage())
                                        <a class="active_choice">
                                            <li>
                                                <span>
                                                    {{$page}}
                                                </span>
                                            </li>
                                        </a>
                                    @else
                                        <a href="{{$url}}">
                                            <li>
                                                <span>
                                                    {{$page}}
                                                </span>
                                            </li>
                                        </a>
                                    @endif
                                    @if($checkMiddleLast == 0 && $page == $paginator->currentPage() + 3)
                                        <a>
                                            <li>
                                                <span>
                                                    ...
                                                </span>
                                            </li>
                                        </a>
                                        @php($checkMiddleLast = 1)
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif

            @endforeach

            @if(!$paginator->onLastPage())
                <a href="{{ $paginator->nextPageUrl() }}">
                    <li>
                        <span>
                            &gt;
                        </span>
                    </li>
                </a>
            @endif
        </ul>
    </section>

@endif
