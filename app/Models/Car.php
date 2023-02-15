<?php

namespace App\Models;

class Car extends Model
{

    /**
     * @var string
     */
    protected string $table = "cars";

    /**
     * @var string
     */
    protected string $primaryKey = "id";

    /**
     * @var array|string[]
     */
    protected array $fillable = [
        'manufacturer',
        'vehicle',
        'description',
        'year',
        'is_sold',
    ];

}