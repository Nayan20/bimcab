<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Driver extends Model
{
    protected $table      = 'drivers';
    protected $primaryKey = 'id';
    public $timestamps    = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'confirm_password',
        'contact_number',
        'profile_image',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'vehicle_type',
        'driver_commission',
        'account_holder_name',
        'account_number',
        'bank_name',
        'bank_location',
        'bic_swift_code',
        'payment_email',
        'status',
        'is_online',
        'created_by',
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

    public function city()
    {
        return $this->belongsTo("App\Models\City", "city_id", "id");
    }

    public static function add($params = [])
    {
        if (!empty($params)) {

            $image = "";
            if (!empty($params['profile_image'])) {
                $file     = $params['profile_image'];
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = 'driver-image';
                $file->move($destinationPath, $fileName);
                $image = $fileName;
            }

            return self::create([
                'first_name'          => !empty($params['first_name']) ? $params['first_name'] : "",
                'last_name'           => !empty($params['last_name']) ? $params['last_name'] : "",
                'email'               => !empty($params['email']) ? $params['email'] : "",
                'password'            => !empty($params['password']) ? Hash::make($params['password']) : "",
                'contact_number'      => !empty($params['contact_number']) ? $params['contact_number'] : "",
                'profile_image'       => $image,
                'country_id'          => !empty($params['country_id']) ? $params['country_id'] : "",
                'state_id'            => !empty($params['state_id']) ? $params['state_id'] : "",
                'city_id'             => !empty($params['city_id']) ? $params['city_id'] : "",
                'address'             => !empty($params['address']) ? $params['address'] : "",
                'vehicle_type'        => !empty($params['vehicle_type']) ? $params['vehicle_type'] : null,
                'driver_commission'   => !empty($params['driver_commission']) ? $params['driver_commission'] : 0,
                'account_holder_name' => !empty($params['account_holder_name']) ? $params['account_holder_name'] : "",
                'account_number'      => !empty($params['account_number']) ? $params['account_number'] : "",
                'bank_name'           => !empty($params['bank_name']) ? $params['bank_name'] : "",
                'bank_location'       => !empty($params['bank_location']) ? $params['bank_location'] : "",
                'bic_swift_code'      => !empty($params['bic_swift_code']) ? $params['bic_swift_code'] : "",
                'payment_email'       => !empty($params['payment_email']) ? $params['payment_email'] : "",
                'status'              => 0,
                'is_online'           => 0,
                'created_by'          => auth()->user()->id,
            ]);
        }
    }

    public static function updateRecords($id, $params = [])
    {
        if (!empty($params) && (int) $id > 0) {

            $image = "";
            if (!empty($params['profile_image'])) {
                $file     = $params['profile_image'];
                $fileName = uniqid() . '-' . $file->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = 'driver-image';
                $file->move($destinationPath, $fileName);
                $image = $fileName;
            }

            $driver = Driver::where('id', $id)->first();
            if ($driver) {
                $driver->first_name          = !empty($params['first_name']) ? $params['first_name'] : "";
                $driver->last_name           = !empty($params['last_name']) ? $params['last_name'] : "";
                $driver->email               = !empty($params['email']) ? $params['email'] : "";
                $driver->password            = !empty($params['password']) ? Hash::make($params['password']) : $driver->password;
                $driver->contact_number      = !empty($params['contact_number']) ? $params['contact_number'] : "";
                $driver->country_id          = !empty($params['country_id']) ? $params['country_id'] : "";
                $driver->state_id            = !empty($params['state_id']) ? $params['state_id'] : "";
                $driver->city_id             = !empty($params['city_id']) ? $params['city_id'] : "";
                $driver->address             = !empty($params['address']) ? $params['address'] : "";
                $driver->vehicle_type        = !empty($params['vehicle_type']) ? $params['vehicle_type'] : null;
                $driver->driver_commission   = !empty($params['driver_commission']) ? $params['driver_commission'] : 0;
                $driver->account_holder_name = !empty($params['account_holder_name']) ? $params['account_holder_name'] : "";
                $driver->account_number      = !empty($params['account_number']) ? $params['account_number'] : "";
                $driver->bank_name           = !empty($params['bank_name']) ? $params['bank_name'] : "";
                $driver->bank_location       = !empty($params['bank_location']) ? $params['bank_location'] : "";
                $driver->bic_swift_code      = !empty($params['bic_swift_code']) ? $params['bic_swift_code'] : "";
                $driver->payment_email       = !empty($params['payment_email']) ? $params['payment_email'] : "";
                if (!empty($image)) {
                    $driver->profile_image = $image;
                }
                $driver->save();
            }
        }
    }

}
