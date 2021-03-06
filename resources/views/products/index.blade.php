@extends('app')

@section('content')
    <div class="container-fluid">
        <h1>Products</h1>

        <br/>
        <a href="{{ route('products.create') }}" class="btn btn-success">New Product</a>
        <br/>
        <br/>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <a href="{{ route('products.edit', ['id' => $product->id ]) }}" >Edit</a> |
                    <a href="{{ route('products.images', ['id' => $product->id ]) }}" >Images</a> |
                    <a href="{{ route('products.destroy', ['id' => $product->id ]) }}" >Delete</a>
                </td>
            </tr>
            @endforeach
        </table>

        {!! $products->render() !!}
    </div>


@endsection