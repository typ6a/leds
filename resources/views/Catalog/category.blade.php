@extends('layouts.app')

@section('content')
<div class="container">



    <!-- categories -->
    @if (count($categories) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ $category->title }}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                <th>Категории</th>
                <th>&nbsp;</th>
                
                </thead>
                <tbody>

                    @foreach ($categories as $category)
                    <tr>
                        <td><a href="{{ url('catalog/category/' . $category->id) }}">{{ $category->title }}</a></td>
                        <td align="right"><span class="badge">{{ $category->products->count() }}</span></td>
                        @if (Auth::check())
                        <td align="right">
                            <a href="/catalog/add"><button class="btn btn-primary btn-xs">удалить</button></a>
                            <a href="/catalog/change"><button class="btn btn-primary btn-xs">изменить</button></a>
                        </td>
                        @endif
                    </tr>

                    @endforeach



                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    @endif


    <div class="panel panel-default">
        <div class="panel-heading"><h3>Продукты</h3>
        </div>
        <div class="panel-body">
            @if (isset($products) && count($products) > 0)
            <table class="table table-striped task-table">
                <thead>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
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
                        @if ($product->price !=0)
                        <td align="right">{{ $product->price . '  р' }}</td>
                        @else 
                        <td align="right"> Цену уточняйте
                        </td>
                        @endif
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
