<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public static function escape_tags($value)
    {
        return strip_tags(rawurldecode($value) ,'<b><strong><i><em><h2><h3><h4><p><a><ul><li><ol>');
    }
}
