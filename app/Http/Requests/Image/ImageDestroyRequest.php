<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\AdminRequest;

class ImageDestroyRequest extends AdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:images,id'
        ];
    }
}
