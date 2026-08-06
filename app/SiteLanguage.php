<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteLanguage extends Model
{
    protected $table = 'locale';

    protected $fillable = ['var','ar','en'];
}