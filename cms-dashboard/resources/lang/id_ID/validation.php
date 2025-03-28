<?php

return [
    'required' => 'The :attribute field is required.',
    'integer' => 'The :attribute must be a valid number.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not exceed :max kilobytes.',
        'string' => 'The :attribute must not be longer than :max characters.',
    ],
    'image' => 'The :attribute must be an image file.',
    'mimes' => 'The :attribute must be a file of type: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'in' => 'The selected :attribute is not allowed.',

    // Custom messages for common validation rules
    'custom' => [
        'category_id' => [
            'integer' => ':attribute harus dipilih.'
        ],
        'status' => [
            'in' => ':attribute harus dipilih.'
        ],
        'required' => [
            'default' => ':attribute is required.',
        ],
        'integer' => [
            'default' => 'Please enter a valid number.',
        ],
    ],

];
