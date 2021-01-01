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
                        اطلاعات پرداخت کاربر
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
        </div>
        <!-- ./col -->
    </div>
</section>
@endsection