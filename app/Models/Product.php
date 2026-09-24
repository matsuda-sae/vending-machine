<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function getProducts($search = null, $company_id = null)
    {
        $query = self::with('company');

        if ($search) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if ($company_id) {
            $query->where('company_id', $company_id);
        }

        return $query->get();
    }

   
    public static function createProduct($request)
    {
        $data = $request->only(['company_id', 'product_name', 'price', 'stock', 'comment']);

      
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('products', $filename, 'public');
            $data['img_path'] = 'storage/' . $path;
        }

        return self::create($data);
    }

   
    public function updateProduct($request)
    {
        $data = $request->only(['company_id', 'product_name', 'price', 'stock', 'comment']);

        // 画像が選択されていれば保存処理を実行
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('products', $filename, 'public');
            $data['img_path'] = 'storage/' . $path;
        }

        return $this->update($data);
    }

    public function deleteProduct()
    {
        return $this->delete();
    }
}