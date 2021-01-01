@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- ./col -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-text-width"></i>
                        @lang(' اطلاعات آگهی ')
                    </h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">

                    <section class="row ad-pictures">
                        @foreach ($ad->pictures as $picture)

                        <div class="picture m-2">
                            <img src="{{ $picture->url }}" class="rounded" alt="@lang(' Ad Picture ')">
                        </div>

                        @endforeach
                    </section>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grid->getData() as $item)
                            @if($grid->allowsLinkableRows())
                            @php
                            $callback = call_user_func($grid->getLinkableCallback(), $grid->transformName(), $item);
                            @endphp
                            @php
                            $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(),
                            $item);
                            @endphp
                            <tr class="{{ trim("linkable " . $trClassCallback) }}" data-url="{{ $callback }}">
                                @else
                                @php
                                $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(),
                                $item);
                                @endphp
                            <tr class="{{ $trClassCallback }}">
                                @endif
                                @foreach($columns as $column)
                            <tr>
                                <th>{{ $column->name }}</th>
                                @if(is_callable($column->data))
                                @if($column->useRawFormat)
                                <td class="{{ $column->rowClass }}">
                                    {!! call_user_func($column->data, $item, $column->key) !!}
                                </td>
                                @else
                                <td class="{{ $column->rowClass }}">
                                    {{ call_user_func($column->data , $item, $column->key) }}
                                </td>
                                @endif
                                @else
                                @if($column->useRawFormat)
                                <td class="{{ $column->rowClass }}">
                                    {!! $item->{$column->key} !!}
                                </td>
                                @else
                                <td class="{{ $column->rowClass }}">
                                    {{ $item->{$column->key} }}
                                </td>
                                @endif
                                @endif
                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

            @if ($ad->isPublished())

            <div class="btn-group my-4" role="group" aria-label="Basic example">

                @if(!$ad->isAccepted())
                <form action="{{ route("admin.ads.accept", [
                    'ad' => $ad,
                ]) }}" method="POST">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-success mx-1">@lang(' Accept ')</button>
                </form>
                @endif

                @if(!$ad->isIgnored())
                <form action="{{ route("admin.ads.ignore", [
                    'ad' => $ad,
                ]) }}" method="POST">
                    @csrf
                    @method('put')
                    <textarea class="form-control" placeholder="@lang(' Description ')" name="description" cols="30"
                        rows="5"></textarea>
                    <button type="submit" class="btn btn-danger mx-1">@lang(' Ignore ')</button>
                </form>
                @endif
            </div>

            @endif

        </div>
        <!-- ./col -->
    </div>
</section>
@endsection