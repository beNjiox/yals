<?php namespace Yals\Services\Validation;

use Validator;

class UserValidator {

    public static $rules = [
        'username' => 'required|unique:users,username',
        'email'    => 'required|email|unique:users,email'
    ];

    protected $errors = [];

    /**
     * validates the user to create/update
     * @param  array        $input       Input::all
     * @param  int          $id          null if creation, entity_id if not
     * @return boolean                   true if passes
     */
    public function validates(array $input, $id = null)
    {
        if ( $id !== null )
        {
            static::$rules['username'] .= ":{$id}";
            static::$rules['email']    .= ":{$id}";
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


