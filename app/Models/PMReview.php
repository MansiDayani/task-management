<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PMReview extends Model
{
    protected $table = 'pm_reviews';
    
    protected $fillable = ['task_id','pm_id','remarks','status'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function pm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pm_id');
    }
}
