<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAvailability;
use App\Models\ProductSize;
use App\Models\ProductColor;

class Product extends Model
{
    protected $connection = 'farah';
    protected $table      = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps    = true;
    
    protected $fillable = [
        'product_name',
        'product_name_ar',
        'address',
        'address_ar',
        'latitude',
        'longitude',
        'description',
        'description_ar',
        'rate',
        'is_active',
        'created_at',
        'updated_at',
        'service_id',
        'service_list_id',
        'sub_service_id'
    ];

    public function service()
    {
        return $this->hasOne("App\Models\Service", "service_id", "service_id");
    }

    public function serviceList()
    {
        return $this->belongsTo("App\Models\ServiceList", "service_list_id", "service_list_id");
    }

    public function subServiceList()
    {
        return $this->belongsTo("App\Models\SubService", "sub_service_id", "sub_service_id");
    }

    public function productAvailability()
    {
        return $this->hasMany("App\Models\ProductAvailability", "product_id", "product_id");
    }

    public function productSize()
    {
        return $this->hasMany("App\Models\ProductSize", "product_id", "product_id");
    }

    public function productColor()
    {
        return $this->hasMany("App\Models\ProductColor", "product_id", "product_id");
    }

    public static function add($params=[])
    {
        if(!empty($params)) {
            
            $product =  self::create([
                'product_name'      => $params['product_name'],
                'product_name_ar'   => $params['product_name_ar'],
                'address'           => $params['address'],
                'address_ar'        => $params['address_ar'],
                'latitude'          => $params['latitude'],
                'longitude'         => $params['longitude'],
                'description'       => $params['description'],
                'description_ar'    => $params['description_ar'],
                'rate'              => $params['rate'],
                'is_active'         => !empty($params['is_active']) ? 1 : 0,
                'is_ecommerce'      => !empty($params['is_ecommerce']) ? 1 : 0,
                'service_list_id'   => $params['service_list_id'],
                'sub_service_id'    => $params['sub_service_id'],
                'service_id'        => $params['service_id']
            ]);

            ProductSize::where('product_id',$product->product_id)->delete();
            ProductColor::where('product_id',$product->product_id)->delete();
            ProductAvailability::where('product_id',$product->product_id)->delete();

            // add records in product availability
            if(empty($params['is_ecommerce']) && !empty($params['items'])) {
                $availabilityParams = [];
                foreach ($params['items'] as $key => $item) {
                    $availabilityParams[] = [
                        'product_id' => $product->product_id,
                        'date'       => $item['date'],
                        'time'       => $item['time'],
                        'is_active'  => !empty($item['is_active']) ? 1 : 0,
                    ];
                }
                ProductAvailability::add($availabilityParams);
            }

            // add product size
            if (!empty($params['is_ecommerce']) && !empty($params['size'])) {
                $sizeParams = [];
                foreach ($params['size'] as $key => $value) {
                    $sizeParams[] = [
                        'size_name'  => $value,
                        'product_id' => $product->product_id
                    ];
                }
                ProductSize::add($sizeParams);
            }

            // add product color
            if (!empty($params['is_ecommerce']) && !empty($params['colors'])) {
                $colorParams = [];
                foreach ($params['colors'] as $key => $value) {
                    $colorParams[] = [
                        'color_name'  => $value,
                        'product_id'  => $product->product_id
                    ];
                }
                ProductColor::add($colorParams);
            }

            return $product;
        }
    }

    public static function updateRecords($id, $params=[])
    {
        if(!empty($params) && (int)$id > 0) {
            
            $product = Product::where('product_id',$id)->first();
            if($product) {
                $product->product_name      = $params['product_name'];
                $product->product_name_ar   = $params['product_name_ar'];
                $product->address           = $params['address'];
                $product->address_ar        = $params['address_ar'];
                $product->latitude          = $params['latitude'];
                $product->longitude         = $params['longitude'];
                $product->description       = $params['description'];
                $product->description_ar    = $params['description_ar'];
                $product->rate              = $params['rate'];
                $product->is_active         = !empty($params['is_active']) ? 1 : 0;
                $product->is_ecommerce      = !empty($params['is_ecommerce']) ? 1 : 0;
                $product->service_list_id   = $params['service_list_id'];
                $product->sub_service_id    = $params['sub_service_id'];
                $product->service_id        = $params['service_id'];
                $product->save();
            }

            if (!empty($params['is_ecommerce'])) {
                ProductAvailability::where('product_id',$product->product_id)->delete();
            } else {
                ProductSize::where('product_id',$product->product_id)->delete();
                ProductColor::where('product_id',$product->product_id)->delete();
            }

            // add records in product availability
            if(empty($params['is_ecommerce']) && !empty($params['items'])) {
                $availabilityParams = [];
                foreach ($params['items'] as $key => $item) {
                    $availabilityParams[] = [
                        'id'         => !empty($item['id']) ? $item['id'] : 0,
                        'product_id' => $product->product_id,
                        'date'       => $item['date'],
                        'time'       => $item['time'],
                        'is_active'  => !empty($item['is_active']) ? 1 : 0,
                    ];
                }
                ProductAvailability::updateRecords($availabilityParams);
            }

            // add product size
            if (!empty($params['is_ecommerce']) && !empty($params['size'])) {
                $sizeParams = [];
                foreach ($params['size'] as $key => $value) {
                    $sizeParams[] = [
                        'size_name'  => $value,
                        'product_id' => $product->product_id
                    ];
                }
                ProductSize::add($sizeParams);
            }

            // add product color
            if (!empty($params['is_ecommerce']) && !empty($params['colors'])) {
                $colorParams = [];
                foreach ($params['colors'] as $key => $value) {
                    $colorParams[] = [
                        'color_name'  => $value,
                        'product_id'  => $product->product_id
                    ];
                }
                ProductColor::add($colorParams);
            }
        }
    }
    
}