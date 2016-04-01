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
            @endif
       
    </div>
@endsection
