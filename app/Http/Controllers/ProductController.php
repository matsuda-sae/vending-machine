<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    /**
     * コンストラクタでProductモデルをインジェクション
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * 商品一覧画面
     */
    public function index(Request $request)
    {
        $products = $this->product->getList($request);
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    /**
     * 新規登録画面
     */
    public function create()
    {
        $companies = Company::all();

        return view('products.create', compact('companies'));
    }

    /**
     * 新規登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'company_id'   => 'required|exists:companies,id',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'comment'      => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'product_name.required' => '商品名は必須項目です。',
            'company_id.required'   => 'メーカーを選択してください。',
            'price.required'        => '価格は必須項目です。',
            'stock.required'        => '在庫数は必須項目です。',
        ]);

        $imgPath = null;
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->store('products', 'public');
            $imgPath = 'storage/' . $filename;
        }

        $this->product->createProduct($request, $imgPath);

        return redirect()->route('products.index');
    }

    /**
     * 詳細画面
     */
    public function show($id)
    {
        $product = $this->product->getProductById($id);

        return view('products.show', compact('product'));
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $product = $this->product->getProductById($id);
        $companies = Company::all();

        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'company_id'   => 'required|exists:companies,id',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'comment'      => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'product_name.required' => '商品名は必須項目です。',
            'company_id.required'   => 'メーカーを選択してください。',
            'price.required'        => '価格は必須項目です。',
            'stock.required'        => '在庫数は必須項目です。',
        ]);

        $imgPath = null;
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->store('products', 'public');
            $imgPath = 'storage/' . $filename;
        }

        $this->product->updateProduct($request, $id, $imgPath);

        return redirect()->route('products.show', $id);
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $this->product->deleteProduct($id);

        return redirect()->route('products.index');
    }
}