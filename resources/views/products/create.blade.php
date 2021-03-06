@extends('app')

@section('content')
    <div class="container-fluid">
        <h1>Create Product</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route'=> 'products.store']) !!}

        <div class="form-group">
            {!! Form::label('category','Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control','placeholder' => 'Informe o nome']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description','Description:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control','placeholder' => 'Informa a descricao']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('price','Price:') !!}
            {!! Form::text('price', null, ['class'=>'form-control','placeholder' => 'Informe o preço']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('featured', 'Destaque:') !!}
            {!! Form::select('featured', ['0' => 'Não', '1' => 'Sim'], '0') !!}
        </div>

        <div class="form-group">
            {!! Form::label('recommended', 'Recomendado:') !!}
            {!! Form::select('recommended', ['0' => 'Não', '1' => 'Sim'], '0') !!}
        </div>

        <div class="form-group">
            {!! Form::label('tags','Tags:') !!}
            {!! Form::text('tags', null, ['class'=>'form-control','placeholder' => 'Tags']) !!}
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