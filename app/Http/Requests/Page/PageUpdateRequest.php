<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\AdminRequest;

class PageUpdateRequest extends AdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "category" => "required|in:about,services,terms",
            "content" => "required",
        ];
    }
}
