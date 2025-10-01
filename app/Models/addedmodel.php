<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class addedmodel extends Model
{
    public function ret_contents(){
        return "called ret_contents()";
    }
}
