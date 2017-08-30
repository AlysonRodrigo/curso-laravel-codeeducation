@extends('app')

@section('content')
    <div class="container-fluid">
        <h1>Edit product: {{ $product->name }}</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
         @endif

        {!! Form::open(['route'=> ['products.update',$product->id],'method' => 'post']) !!}


        <div class="form-group">
            {!! Form::label('category','Category:') !!}
            {!! Form::select('category_id', $categories, $product->category->id, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name', $product->name, ['class'=>'form-control','placeholder' => 'Informe o nome']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description','Description:') !!}
            {!! Form::textarea('description', $product->description, ['class'=>'form-control','placeholder' => 'Informa a descricao']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('price','Price:') !!}
            {!! Form::text('price', $product->price, ['class'=>'form-control','placeholder' => 'Informe o preço']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('featured', 'Destaque:') !!}
            {!! Form::select('featured', ['0' => 'Não', '1' => 'Sim'], $product->featured) !!}
        </div>

        <div class="form-group">
            {!! Form::label('recommend', 'Recomendado:') !!}
            {!! Form::select('recommend', ['0' => 'Não', '1' => 'Sim'], $product->recommend) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tags', 'Tags já cadastradas para este produto:') !!}
            @foreach($product->tags as $tag)
                <div class="btn btn-sm btn-default">{{ $tag->name }}</div>
            @endforeach
        </div>

        <div class="form-group">
            {!! Form::label('tags','Tags:') !!}
            {!! Form::text('tags', $tags, ['class'=>'form-control','placeholder' => 'Tags']) !!}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    {!! Form::submit('Add product',['class' => 'btn btn-primary form-control']) !!}
                </div>
                <div class="col-md-3">
                    <a href="{{ route('products') }}" class="btn btn-success form-control">Voltar</a>
                </div>


            </div>
        </div>


        {!! Form::close() !!}



    </div>


@endsection