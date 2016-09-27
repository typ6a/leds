@extends('layouts.app')

@section('content')

<form action="<?= url('product/add') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="product_title"  class="form-control" value="" placeholder="Название продукта:" />
        <select name="category_id" class="form-control">
            <option value="">Выберите категорию</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>" ><?= $category->title ?></option>
            <?php endforeach; ?>
        </select>
        
        <select name="product_property" class="form-control">
            <option value="">Выберите свойство</option>
            <?php foreach ($product_properties as $product_property): ?>
                <option value="<?= $product_property->id ?>" ><?= $product_property->name ?></option>
            <?php endforeach; ?>
        </select>
        
        <input name="product_price" value="" placeholder="Цена:" class="form-control"/>
        
        <input type="file" name="images" class="form-control"/>
        
        <button class="form-control">Добавить</button>
        <a class="close" data-dismiss="alert" href="#">&times;</a>
    </form>
@endsection

