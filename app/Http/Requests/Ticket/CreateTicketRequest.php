<?php

namespace App\Http\Requests;

use App\Enums\Priorities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'title' => 'required|string|max:40',
            'description' => 'required|string|max:255',
            'label' => 'required',
            'priority' => ['required', new Enum(Priorities::class)],
            'category' => 'required',
            'files.*' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
            'files' => 'array|nullable',
            'status_id' => 'required|in:1,2'

        ];
    }
    public function messages()
    {


        $request = $this->instance()->all();
        $files = $request['files'];

        $messages = [];



       
        foreach (   $files as $key => $val) {
            $messages["files.$key.mimes"] = "the file NO# " .  $key + 1 . " is not a type of: pdf,txt,doc,docx";
            $messages["files.$key.max"] = "the file NO# " .  $key + 1 . " is greater than 2 MB";
        }

        return $messages;
    }
}
