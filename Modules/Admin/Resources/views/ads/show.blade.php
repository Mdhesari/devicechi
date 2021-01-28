@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- ./col -->
        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true"> @lang(' Ad View ')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting" role="tab"
                        aria-controls="setting" aria-selected="false">@lang(' Setting ')</a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-text-width"></i>
                                @lang(' Ad View ')
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="row ad-pictures">
                                @foreach ($ad->pictures as $picture)

                                <div class="picture m-2">
                                    <img src="{{ $picture->url }}" class="rounded" alt="@lang(' Ad Picture ')">
                                </div>

                                @endforeach
                            </div>

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
                                    $callback = call_user_func($grid->getLinkableCallback(), $grid->transformName(),
                                    $item);
                                    @endphp
                                    @php
                                    $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(),
                                    $item);
                                    @endphp
                                    <tr class="{{ trim("linkable " . $trClassCallback) }}" data-url="{{ $callback }}">
                                        @else
                                        @php
                                        $trClassCallback = call_user_func($grid->getRowCssStyle(),
                                        $grid->transformName(),
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
                </div>

                <div class="tab-pane" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-text-width"></i>
                                @lang(' Setting ')
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="toolbar">
                                <form method="POST" action="{{ route("admin.ads.export",[
                                    'ad' => $ad,
                                ]) }}">
                                    @csrf

                                    @foreach ($templates as $key => $template)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="template"
                                            id="template-{{ $key }}" value="{{ $template['url'] }}" @if($loop->first)
                                        checked @endif>
                                        <label class="form-check-label" for="template-{{ $key }}">
                                            <div class="picture bg-secondary">
                                                <img class="rounded img-fluid" src="{{ url($template['url']) }}"
                                                    alt="{{ $template['title'] }}">
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                    @error('template')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror

                                    <div class="form-group">
                                        <input type="checkbox" name="dont_overwrite">
                                        <label for="dont_overwrite">@lang(' Use existing watermark ')</label>
                                    </div>
                                    @error('dont_overwrite')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror

                                    <button type="submit" class="btn btn-outline-info mt-4">
                                        @lang(' Export Instagram Post ')
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            @if ($ad->isConfirmed())

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