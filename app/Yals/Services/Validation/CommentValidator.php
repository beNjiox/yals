<?php namespace Yals\Services\Validation;

use Validator;

class CommentValidator {

    public static $rules = [
        'type' => 'required|in:warning,info,danger',
        'text' => 'required|between:5,150'
    ];

    protected $errors = [];

    /**
     * validates the comment to create/update
     * @param  array        $input       Input::all
     * @param  int          $id          null if creation, entity_id if not
     * @return boolean                   true if passes
     */
    public function validates(array $input, $id = null)
    {
        if ( $id !== null )
        {
            // nothing special on edit
        }

        $validator = Validator::make($input, static::$rules);
        if ($validator->fails())
        {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}


