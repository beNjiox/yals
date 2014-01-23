<?php namespace Yals\Services\Validation;

use Validator;

class CompanyValidator {

    public static $rules = [
        'name'        => 'required|unique:companies,name',
        'website_url' => 'required|url|unique:companies,website_url',
        'description' => 'required|between:5,150'
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
            static::$rules['name']        .= ",{$id}";
            static::$rules['website_url'] .= ",{$id}";
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


