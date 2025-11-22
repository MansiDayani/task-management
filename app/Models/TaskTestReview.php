<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskTestReview extends Model
{
    protected $fillable = ['attempt_id','tester_id','remarks','status','tested_at'];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(TaskAttempt::class, 'attempt_id');
    }

    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tester_id');
    }
}
