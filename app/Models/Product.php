<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * 複数割り当て可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    /**
     * リレーション：メーカー情報 (Companyモデル)
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * 商品一覧の取得（検索条件付き）
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function getList($request = null)
    {
        $query = $this->with('company');

        // 検索キーワード
        if ($request && $request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // メーカー選択
        if ($request && $request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        return $query->get();
    }

    /**
     * 指定したIDの商品を1件取得
     *
     * @param  int  $id
     * @return \App\Models\Product
     */
    public function getProductById($id)
    {
        return $this->with('company')->findOrFail($id);
    }

    /**
     * 商品の新規登録処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $imgPath
     * @return \App\Models\Product
     */
    public function createProduct($request, $imgPath = null)
    {
        return $this->create([
            'product_name' => $request->product_name,
            'company_id'   => $request->company_id,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'comment'      => $request->comment,
            'img_path'     => $imgPath,
        ]);
    }

    /**
     * 商品の更新処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string|null  $imgPath
     * @return bool
     */
    public function updateProduct($request, $id, $imgPath = null)
    {
        $product = $this->findOrFail($id);

        $data = [
            'product_name' => $request->product_name,
            'company_id'   => $request->company_id,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'comment'      => $request->comment,
        ];

        if ($imgPath) {
            $data['img_path'] = $imgPath;
        }

        return $product->update($data);
    }

    /**
     * 商品の削除処理
     *
     * @param  int  $id
     * @return bool|null
     */
    public function deleteProduct($id)
    {
        $product = $this->findOrFail($id);
        return $product->delete();
    }
}