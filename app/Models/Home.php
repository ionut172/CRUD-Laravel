<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = "codprodus";

    protected $fillable = [
        'nume', 'descriere', 'status', 'pret', 'poza', 'codprodus'];
        
}
