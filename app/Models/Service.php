<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'local_id';

    protected $fillable = [
        'service_name',
        'service_desc',
        'turbo_service_id',
        'price'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
