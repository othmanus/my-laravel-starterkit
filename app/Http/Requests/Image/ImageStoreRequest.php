<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\ModeratorRequest;

class ImageStoreRequest extends ModeratorRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|image',
        ];
    }
}
