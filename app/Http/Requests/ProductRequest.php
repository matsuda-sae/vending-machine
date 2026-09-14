<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // 権限チェックを許可
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|max:255',
            'company_id'   => 'required|exists:companies,id',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'comment'      => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * 項目名の表示設定
     */
    public function attributes(): array
    {
        return [
            'product_name' => '商品名',
            'company_id'   => 'メーカー',
            'price'        => '価格',
            'stock'        => '在庫数',
            'comment'      => 'コメント',
            'img_path'     => '商品画像',
        ];
    }
}