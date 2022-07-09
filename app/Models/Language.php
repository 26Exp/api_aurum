<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Mod;

class Language extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['code', 'name'];
    public const LOCALE_RU = 'ru';
    public const LOCALE_RO = 'ro';

    public function getLocaleAttribute()
    {
        return $this->code;
    }

    /**
     * @param array $parameters
     * @param array $rules
     * @return array
     */
    static public function generateRules(array $parameters, array $rules): array
    {
        foreach (Language::all() as $language) {
            foreach ($parameters as $key => $value) {
                $rules[$key . '_' . $language->code] = $value;
            }
        }

        return $rules;
    }
}
