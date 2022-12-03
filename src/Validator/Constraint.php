<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ContainsAlphanumeric extends Constraint
{
    public string $message = 'The number "{{ string }}" contains is not complete';
    // If the constraint has configuration options, define them as public properties
    public string $mode = 'strict';
}