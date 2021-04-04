<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table      = 'state';
    protected $primaryKey = 'id';
    public $timestamps    = true;

    protected $fillable = [
        'name',
        'country_id',
        'created_at',
        'updated_at',
    ];

    public function country()
    {
        return $this->belongsTo("App\Models\Country", "country_id", "id");
    }

    public static function add($params = [])
    {
        if (!empty($params)) {

            return self::create([
                'name'       => $params['name'],
                'country_id' => $params['country_id'],
            ]);
        }
    }

    public static function updateRecords($id, $params = [])
    {
        if (!empty($params) && (int) $id > 0) {

            $state = State::where('id', $id)->first();
            if ($state) {
                $state->name       = $params['name'];
                $state->country_id = $params['country_id'];
                $state->save();
            }
        }
    }

}
