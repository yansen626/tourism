<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 14/09/2017
 * Time: 14:00
 */

namespace App;


use App\Models\Category;

class CategoryHeader
{
    public static function allCategory(){
        return Category::all();
    }
}