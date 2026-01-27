<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image_url'
    ];

    // DB에 없는 가상 칼럼을 JSON 응답에 자동으로 추가
    // {
    //   'image_url': '',
    //   'image_url_full': ''
    // }
    protected $appends = ['image_url_full'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // laravel accesssor
    // 라라벨은 메서드 이름 규칙보고 자동으로 연결
    
    // 규칙
    // get{StudlyName}Attribute
    
    // db칼럼은 아니지만 모델에 가짜 속성을 만들어주는 함수
    // image_url_full이라는 가상속성 생성
    // $product->getImageUrlFullAttribute() 이렇게 안 씀
    // $product->image_url_full; 이렇게 쓰면 자동 실행됨
    public function getImageUrlFullAttribute()
    {
        return $this->image_url ? asset($this->image_url) : null;
    }

    // asset()
    // 자동으로 http://localhost:8000/storage/products/xxx.avif로 변환됨
}