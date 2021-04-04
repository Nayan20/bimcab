<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $connection = 'farah';
    protected $table      = 'product_color';
    protected $primaryKey = 'size_id';
    public $timestamps    = true;
    
    protected $fillable = [
        'product_id',
        'color_name',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo("App\Models\Product", "product_id", "product_id");
    }

    public static function add($params=[])
    {
        if(!empty($params)) {
            foreach ($params as $key => $param) {
                self::updateOrCreate([
                    'color_name' => $param['color_name'],
                    'product_id' => $param['product_id']
                ],[
                    'color_name' => $param['color_name'],
                    'product_id' => $param['product_id']
                ]);
            }
        }
    }
}