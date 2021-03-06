<?php

namespace App\Supports;

use Exception;
use Illuminate\Contracts\Hashing\Hasher;

class Md5Hashing implements Hasher
{
    /**
     * {@inheritdoc}
     */
    public function info($hashedValue)
    {
        throw new Exception(sprintf(
            'This password md5 does not implement info. [%s].',
            static::class
        ));
    }

    /**
     * {@inheritdoc}
     *
     * @see https://github.com/OpenSID/OpenSID/blob/e1115dfb22224687c37ac042aa32c82e51fa75a8/donjo-app/helpers/donjolib_helper.php#L492-L499
     */
    public function make($value, array $options = [])
    {
        $value = strrev($value);
        $value *= 77;
        $value .= "!#@$#%";

        return md5($value);
    }

    /**
     * {@inheritdoc}
     */
    public function check($value, $hashedValue, array $options = [])
    {
        return hash_equals($this->make($value), $hashedValue);
    }

    /**
     * {@inheritdoc}
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        throw new Exception(sprintf(
            'This password md5 does not implement needsRehash. [%s].',
            static::class
        ));
    }
}
