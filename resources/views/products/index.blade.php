@extends('layouts.app')

@section('title', '商品一覧画面')

@section('content')
<h1 class="mb-4">商品一覧画面</h1>

<!-- 検索フォームエリア -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('products.index') }}" method="GET" class="row g-3">
            <!-- 検索キーワード -->
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ request('search') }}">
            </div>
            <!-- メーカー選択 -->
            <div class="col-md-4">
                <select name="company_id" class="form-select">
                    <option value="">メーカー名</option>
                    @if (isset($companies))
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <!-- 検索ボタン -->
            <div class="col-md-4">
                <button type="submit" class="btn btn-outline-secondary">検索</button>
            </div>
        </form>
    </div>
</div>

<!-- 新規登録ボタン -->
<div class="mb-3 text-end">
    <a href="{{ route('products.create') }}" class="btn btn-warning text-white fw-bold">新規登録</a>
</div>

<!-- 商品一覧テーブル -->
<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($products) && count($products) > 0)
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->img_path)
                                    <img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}" style="max-height: 50px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>¥{{ number_format($product->price) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->company->company_name ?? '' }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm text-white">詳細</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center py-4">商品データがありません。</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection