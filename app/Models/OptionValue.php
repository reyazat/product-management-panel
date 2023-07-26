<?php

namespace App\Models;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'option_id',
        'value',
        'sorted',
    ];
    public function option()
    {
      return $this->belongsTo(Option::class);
    }
}
