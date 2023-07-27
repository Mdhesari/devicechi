@if($grid->wantsPagination() && !$grid->gridNeedsSimplePagination())
    <div class="pull-{{ $direction }}">
        <b>
            @if($grid->getData()->total() <= $grid->getData()->perpage())
                @if(!isset($atFooter))
                    @lang(' Showing :current to :current_total of :total entires ', [
                        'current' => ($grid->getData()->currentpage() - 1 ) * $grid->getData()->perpage() + 1,
                        'current_total' => $grid->getData()->total(),
                        'total' => $grid->getData()->total() 
                    ])
                @endif
            @else
                @lang(' Showing :current to :current_total of :total entires ', [
                    'current' => ($grid->getData()->currentpage() - 1 ) * $grid->getData()->perpage() + 1,
                    'current_total' => $grid->getData()->currentpage() * $grid->getData()->perpage(),
                    'total' => $grid->getData()->total()
                ])
            @endif
        </b>
    </div>
@else
    @if(isset($atFooter))
        @if($grid->getData()->count() >= $grid->getData()->perpage())
            <div class="pull-{{ $direction }}">
                <b>
                    @lang(' Showing :count records for this page. ', [
                        'count' => $grid->getData()->count()
                    ])
                </b>
            </div>
        @endif
    @else
        <div class="pull-{{ $direction }}">
            <b>
                @lang(' Showing :count records for this page. ', [
                        'count' => $grid->getData()->count()
                ])
            </b>
        </div>
    @endif
@endif