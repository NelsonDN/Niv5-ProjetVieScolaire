<?php

namespace App\Rules;
use App\Models\User;


use Illuminate\Contracts\Validation\Rule;

class email_unique_user implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $etablissement_id = auth()->user()->etablissement_id;

        $user = User::select('email')->where('email' , $value)->where('etablissement_id', $etablissement_id)->get();
        
        if ($user->isEmpty()){
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'L\'Email existe deja';
    }
}
