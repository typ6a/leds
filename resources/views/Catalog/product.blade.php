@extends('layouts.app')
@section('content')
<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong> {{ $product->title }}</strong>
        </div>
        <div class="panel-body">
        @if (count($product->images) && isset($product->images[0]))
        @foreach ($product->images->unique('filename') as $image)
        <img src="{{ url('data/images/' . $image->filename) }}" width="200" height="200" alt="{{ $image->filename}} "/>
        @endforeach
        @else
        <img src="#" width="100" height="100" alt="" />
        @endif
            <table class="table table-striped task-table">
                <thead>
                <th>Характеристики</th>
                <th>&nbsp;</th>
                </thead>
                <tbody>




                    @if (count($product->properties) > 0)
                    @foreach ($product->properties->unique('product_property_id') as $property)
                    <tr>

                        <td class="text-info">{{ $property->property->name }} : </td><td class="text-info">{{ $property->value }}</td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td class="text-info">Цена: </td><td class="text-info">{{ $product->price }} р.</td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
    </div>

    @endsection



