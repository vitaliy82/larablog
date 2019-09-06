<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PostValidator.
 *
 * @package namespace App\Validators;
 */
class PostValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required|min:5',
            'img' => 'required',
            'text' => 'required|min:10',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required|min:5',
            'text' => 'required|min:10',
        ],
    ];
}
