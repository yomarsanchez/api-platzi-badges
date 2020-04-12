<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Badge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'job_title',
        'twitter',
        'avatar_url',
        'state'
    ];

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $camelArray = [];

        foreach ($array as $name => $value) {
            $camel = Str::camel($name);
            switch ($name) {
                case 'id':
                    $camelArray[$camel] = encrypt($value);
                    break;
                case 'avatar_url':
                    $camelArray[$camel] = $value
                        ? $value
                        : \App\Helpers\Helper::getAvatar(
                            $value,
                            $array['email']
                        );
                    break;
                default:
                    $camelArray[$camel] = $value;
                    break;
            }
        }

        return $camelArray;
    }
}
