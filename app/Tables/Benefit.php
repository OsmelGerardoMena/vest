<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'benefits';

    protected $fillable = [ 'name', 'product_id'];
}
