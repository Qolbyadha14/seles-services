<?php

namespace App\Http\Controllers\api\v1\sales\dto;

use App\Exceptions\ValidationException;
use Illuminate\Validation\Validator;

class StockCreateDto
{
    public $vehicle_id;
    public $total_stock;

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
        $this->total_stock = $data['total_stock'];
    }

    protected function validate(array $data): Validator
    {
        $rules = [
            'vehicle_id' => 'required|string',
            'total_stock' => 'required|numeric',
        ];

        return app('validator')->make($data, $rules);
    }
}
