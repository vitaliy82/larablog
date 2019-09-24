<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class StopWordValidator.
 *
 * @package namespace App\Validators;
 */
class StopWordValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'word' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'word' => 'required',
        ],
    ];
}
