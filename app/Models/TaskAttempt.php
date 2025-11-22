<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskAttempt extends Model
{
    protected $fillable = ['task_id','developer_id','attempt_number','submission_notes','file_path','submitted_at'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function reviews()
    {
        return $this->hasMany(TaskTestReview::class, 'attempt_id');
    }
}
