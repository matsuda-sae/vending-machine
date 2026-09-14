<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::getProducts($request->search, $request->company_id);
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            Product::createProduct($request);
            DB::commit();
            return redirect()->route('products.create')->with('success', '商品を登録しました');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput()->with('error', '登録処理に失敗しました');
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->updateProduct($request);
            DB::commit();
            return redirect()->route('products.edit', $product->id)->with('success', '商品を更新しました');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput()->with('error', '更新処理に失敗しました');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->deleteProduct();
            DB::commit();
            return redirect()->route('products.index')->with('success', '商品を削除しました');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', '削除処理に失敗しました');
        }
    }
}