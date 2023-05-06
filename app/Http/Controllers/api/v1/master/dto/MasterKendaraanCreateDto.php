<?php

namespace App\Http\Controllers\api\v1\master\dto;

use App\Exceptions\ValidationException;
use Illuminate\Validation\Validator;

class MasterKendaraanCreateDto
{
    public $year;
    public $color;
    public $price;
    public $type_vehicle;
    public $vehicle;

    /**
     * @throws ValidationException
     */
    public function __construct($data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException("Bad Request", 400, $validator->errors()->all());
        }

        $this->year = $data['year'];
        $this->color = $data['color'];
        $this->price = $data['price'];
        $this->type_vehicle = $data['type_vehicle'];
        $this->vehicle = $data['vehicle'];
    }

    protected function validate(array $data): Validator
    {
        $rules = [
            'year' => 'required|numeric',
            'color' => 'required|string',
            'price' => 'required|string',
            'type_vehicle' => 'required|in:car,motorcycle',
        ];

        if ($data['type_vehicle'] == 'car'){
            $rules['vehicle.machine'] = 'required|string';
            $rules['vehicle.passenger_capacity'] ='required|numeric';
            $rules['vehicle.type'] ='required|string';
        }elseif ($data['type_vehicle'] == 'motorcycle'){
            $rules['vehicle.machine'] = 'required|string';
            $rules['vehicle.suspension_type'] ='required|string';
            $rules['vehicle.transmission_type'] ='required|string';
        }

        return app('validator')->make($data, $rules);
    }
}
