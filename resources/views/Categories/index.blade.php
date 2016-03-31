@extends('layouts.app')

@section('content')
    <div class="container">
       
            

            <!-- categories -->
            @if (count($categories) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Категории
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
                                        <td class="table-text"><div>{{ $category->title }}</div></td>

                                        
                                   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
       
    </div>
@endsection
