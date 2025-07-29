<?php

namespace App\Models\Ungasan;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $connection = "ungasan";
    protected $primaryKey = "sid";
    protected $table = "penduduks";
}
