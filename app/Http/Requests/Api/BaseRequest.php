<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

use DateTime;

class BaseRequest extends FormRequest
{
	protected function setInternalDateFormat($field)
	{
		$this->request->set($field, DateTime::createFromFormat(config('api.apps_api.date_format.input'), $this->{$field})->format(config('api.apps_api.date_format.internal')));
	}

    protected function setInternalTimeFormat($field)
    {
        $this->request->set($field, DateTime::createFromFormat(config('api.apps_api.time_format.input'), $this->{$field})->format(config('api.apps_api.time_format.internal')));
    }

    public function setInternalDateTimeFormat($field)
    {
        $this->request->set($field, \DateTime::createFromFormat(config('api.apps_api.date_time_format.input'), $this->{$field}, new \DateTimeZone(config('api.apps_api.timezone.user')))/*->setTimezone(new \DateTimeZone(config('app.timezone')))*/->format(config('api.apps_api.date_time_format.internal')));

        // return \DateTime::createFromFormat(config('api.apps_api.date_time_format.input'), $dateTime, new \DateTimeZone(config('api.apps_api.timezone.user')))->setTimezone(new \DateTimeZone(config('app.timezone')))->format(config('api.apps_api.date_time_format.internal'));
    }
        
    public function all($keys = null)
    {
        /*
         * Fixes an issue with FormRequest-based requests not
         * containing parameters added / modified by middleware
         * due to the FormRequest copying Request parameters
         * before the middleware is run.
         *
         * See:
         * https://github.com/laravel/framework/issues/10791
         */
        $this->merge( $this->request->all() );

        return parent::all();
    }

    /**
     * Check if input is present in ParameterBag Object if it's not present in request
     *
     * @param  string|array  $key
     * @return bool
     */
    public function has($key)
    {
        if (!parent::has($key)) {

            $keys = is_array($key) ? $key : func_get_args();

            foreach ($keys as $value) {
                if ($this->isEmptyStringInBag($value)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Determine if the given input key is an empty string for "has".
     *
     * @param  string  $key
     * @return bool
     */
    protected function isEmptyStringInBag($key)
    {
        $value = $this->request->get($key);

        $boolOrArray = is_bool($value) || is_array($value);

        return ! $boolOrArray && trim((string) $value) === '';
    }
}