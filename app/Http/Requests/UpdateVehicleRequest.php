<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidSriLankanVehicleNumber;
class UpdateVehicleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'vehicle_no' => ['required', 'string', 'max:255', new ValidSriLankanVehicleNumber],
            'model' => 'required|string|max:255',
            'chassis_no' => 'required|string|max:255',
            'engine_no' => 'required|string|max:255',
            'yom' => 'required|date',
            'v_status' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}