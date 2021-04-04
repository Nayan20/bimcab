<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table      = 'countries';
    protected $primaryKey = 'id';
    public $timestamps    = true;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public static function add($params = [])
    {
        if (!empty($params)) {

            return self::create([
                'name'  => $params['name']
            ]);
        }
    }

    public static function updateRecords($id, $params = [])
    {
        if (!empty($params) && (int) $id > 0) {

            $country = Country::where('id', $id)->first();
            if ($country) {
                $country->name = $params['name'];
                $country->save();
            }
        }
    }

}