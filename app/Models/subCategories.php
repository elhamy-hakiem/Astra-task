<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategories extends Model
{
    use HasFactory;
    protected $table = "sub_categories";
    protected $fillable = ['subCatName','category_id'];
    public $timestamps = false;
}
