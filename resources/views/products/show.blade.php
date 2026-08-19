@extends('layouts.app')

@section('title', '商品情報詳細画面')

@section('content')
<div class="mx-auto" style="max-width: 600px;">
    <h1 class="mb-4">商品情報詳細画面</h1>

    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tbody>
                    <tr>
                        <th class="bg-light" style="width: 30%;">ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">商品画像</th>
                        <td>
                            @if ($product->img_path)
                                <img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid" style="max-height: 150px;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">商品名</th>
                        <td>{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">メーカー</th>
                        <td>{{ $product->company->company_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">価格</th>
                        <td>¥{{ number_format($product->price) }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">在庫数</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">コメント</th>
                        <td>{{ $product->comment }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning text-white fw-bold">編集</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </div>
</div>
@endsection