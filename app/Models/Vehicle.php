<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table      = 'vehicles';
    protected $primaryKey = 'id';
    public $timestamps    = true;

    protected $fillable = [
        'name',
        'cost',
        'image',
        'created_at',
        'updated_at',
    ];

    public static function add($params = [])
    {
        if (!empty($params)) {

            $image = "";
            if (!empty($params['image'])) {
                $file     = $params['image'];
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = 'vehicle-image';
                $file->move($destinationPath, $fileName);
                $image = $fileName;
            }

            return self::create([
                'name'  => $params['name'],
                'cost'  => $params['cost'],
                'image' => $image,
            ]);
        }
    }

    public static function updateRecords($id, $params = [])
    {
        if (!empty($params) && (int) $id > 0) {

            $image = "";
            if (!empty($params['image'])) {
                $file     = $params['image'];
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = 'vehicle-image';
                $file->move($destinationPath, $fileName);
                $image = $fileName;
            }

            $vehicle = Vehicle::where('id', $id)->first();
            if ($vehicle) {
                $vehicle->name = $params['name'];
                $vehicle->cost = $params['cost'];
                if (!empty($image)) {
                    $vehicle->image = $image;
                }
                $vehicle->save();
            }
        }
    }

}
