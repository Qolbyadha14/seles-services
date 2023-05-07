<?php

namespace App\Http\Controllers\api\v1\sales\dto;

use App\Exceptions\ValidationException;
use Illuminate\Validation\Validator;

class OrderTransactionDto
{
    public $vehicle_id;
    public $vehicle_type;
    public $vehicle_price;
    public $customers_name;
    public $customers_address;

    /**
     * @throws ValidationException
     */
    public function __construct($data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException("Bad Request", 400, $validator->errors()->all());
        }

        $this->vehicle_id = $data['vehicle_id'];
        $this->vehicle_type = $data['vehicle_type'];
        $this->vehicle_price = $data['vehicle_price'];
        $this->customers_name = $data['customers_name'];
        $this->customers_address = $data['customers_address'];
    }

    protected function validate(array $data): Validator
    {
        $rules = [
            'vehicle_id' => 'required|string',
            'vehicle_type' => 'required|string',
            'vehicle_price' => 'required|numeric',
            'customers_name' => 'required|string',
            'customers_address' => 'required|string',
        ];
        return app('validator')->make($data, $rules);
    }
}
