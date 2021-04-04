<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table      = 'cities';
    protected $primaryKey = 'id';
    public $timestamps    = true;

    protected $fillable = [
        'name',
        'country_id',
        'state_id',
        'created_at',
        'updated_at',
    ];

    public function country()
    {
        return $this->belongsTo("App\Models\Country", "country_id", "id");
    }

    public function state()
    {
        return $this->belongsTo("App\Models\State", "state_id", "id");
    }

    public static function add($params = [])
    {
        if (!empty($params)) {

            return self::create([
                'name'       => $params['name'],
                'country_id' => $params['country_id'],
                'state_id'   => $params['state_id'],
            ]);
        }
    }

    public static function updateRecords($id, $params = [])
    {
        if (!empty($params) && (int) $id > 0) {

            $state = City::where('id', $id)->first();
            if ($state) {
                $state->name       = $params['name'];
                $state->country_id = $params['country_id'];
                $state->state_id   = $params['state_id'];
                $state->save();
            }
        }
    }

}
