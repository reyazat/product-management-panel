<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route($breadcrumbs[1][0]) }}">
                                <i class="mdi mdi-home-outline"></i></a></li>
                        @foreach ($breadcrumbs[0] as $key=>$value)
                            @if ($loop->first)
                                @continue
                            @endif
                            @if ($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">{{ $value }}</li>
                            @else
                                <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ route($breadcrumbs[1][$key]) }}">{{ $value }}</a></li>
                            @endif
                        @endforeach

                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>
