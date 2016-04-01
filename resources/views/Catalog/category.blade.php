@extends('layouts.app')

@section('content')
<div class="container">



    <!-- categories -->
    @if (count($categories) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Каталог
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                <th>Категории</th>
                <th>&nbsp;</th>
                </thead>
                <tbody>
                <h1>{{ $category->title }}</h1>
                @foreach ($categories as $category)
                <tr>
                    <td><a href="{{ url('catalog/category/' . $category->id) }}">{{ $category->title }}</a></td>
                    <td align="right"><span class="badge">{{ $category->products->count() }}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    @endif


    <div class="panel panel-default">
        <div class="panel-heading">Продукты
        </div>
        <div class="panel-body">
        @if (isset($products) && count($products) > 0)
            <table class="table table-striped task-table">
                <thead>
                <th>Продукты</th>
                <th>&nbsp;</th>
                </thead>
                <tbody>
        @foreach ($products as $product)
            <tr><td>@if (count($product->images) && isset($product->images[0]))
                <a href="{{ url('catalog/product/' . $product->id) }}">
                    <img src="{{ url('data/images/' . $product->images[0]->filename) }}" width="100" height="100" border="1" />
                </a>
            @else
            <img src="#" width="100" height="100" border="1" />
            @endif</td>
            <td><a href="{{ url('catalog/product/' . $product->id) }}">{{ $product->title }}</a></td>
            <td>
            @if ($product->price !=0)
            <p>{{ $product->price . '  р' }}</p>
            @else 
            <p>Цену уточняйте</p>
            @endif
            </td>
            </tr>
        @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="font-size: 5px">Нет продуктов. Смотри в категориях</p>
        @endif
    </div>
      



</div>







@endsection
