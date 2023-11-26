<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Twxt extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
      
    ];

    //relationship with user model
    public function user(): BelongsTo{
        //twxt->user-><props>
        return $this->belongsTo(User::class);
    }
}
