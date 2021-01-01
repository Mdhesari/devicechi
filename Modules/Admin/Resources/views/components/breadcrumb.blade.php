<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $title }}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">

            <x-breadcrumb-item :url="route('dashboard')">خانه</x-breadcrumb-item>

            @if(empty($slot->toHtml()))
            <x-breadcrumb-item>{{ $title }}</x-breadcrumb-item>

            @else
            {!! $slot !!}

            @endif

        </ol>
    </div><!-- /.col -->
</div>