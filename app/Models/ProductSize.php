<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $connection = 'farah';
    protected $table      = 'product_size';
    protected $primaryKey = 'size_id';
    public $timestamps    = true;
    
    protected $fillable = [
        'product_id',
        'size_name',
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
                    'size_name' => $param['size_name'],
                    'product_id' => $param['product_id']
                ],[
                    'size_name' => $param['size_name'],
                    'product_id' => $param['product_id']
                ]);
            }
        }
    }
}