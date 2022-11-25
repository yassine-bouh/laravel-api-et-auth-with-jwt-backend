<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_category extends Model
{
    use HasFactory;
    protected $table='category_categories';
    protected $fillable=['id_language','id_cat_one','id_cat_two','resume','detail','principal','activity','actions','quality','image'];
}
