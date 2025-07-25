<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    #use HasFactory;

    // ✅ Allow mass assignment for these fields
    use SoftDeletes;
    protected $fillable = ['name', 'price', 'stock', 'image'];
}
