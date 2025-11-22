<?php

namespace App\Http\Controllers;

use App\Models\TaskAttempt;
use App\Models\TaskTestReview;
use App\Models\Point;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TesterReviewController extends Controller
{
    /**
     * Store a new tester review for a task attempt.
     */
    public function store(Request $request, $attempt)
    {
        try {
            // Get attempt by ID (route parameter is numeric)
            $attempt = TaskAttempt::findOrFail($attempt);

            // Verify the task is assigned to the current tester
            if ($attempt->task->tester_id !== Auth::id()) {
                return redirect()->route('tester.tasks')
                    ->with('error', 'You are not assigned to test this task.');
            }

            // Validate the request
            $validated = $request->validate([
                'status' => 'required|in:pass,fail',
                'remarks' => 'required|string',
            ], [
                'status.required' => 'Review status is required.',
                'status.in' => 'Status must be either pass or fail.',
                'remarks.required' => 'Remarks are required.',
            ]);

            // Create the review
            $review = TaskTestReview::create([
                'attempt_id' => $attempt->id,
                'tester_id' => Auth::id(),
                'status' => $validated['status'],
                'remarks' => $validated['remarks'],
                'tested_at' => now(),
            ]);

            $task = $attempt->task;
            $developer = $attempt->developer;

            if ($validated['status'] === 'pass') {
                // PASS: Add +20 points
                $points = 20;

                // Check deadline (only if deadline exists)
                if ($task->deadline && $attempt->submitted_at) {
                    $deadline = Carbon::parse($task->deadline);
                    $submittedAt = Carbon::parse($attempt->submitted_at);
                    
                    if ($submittedAt->lt($deadline)) {
                        // Early submission: +5 bonus
                        $points += 5;
                        $reason = "Task passed (early submission)";
                    } elseif ($submittedAt->gt($deadline)) {
                        // Late submission: -5 deduction
                        $points -= 5;
                        $reason = "Task passed (late submission)";
                    } else {
                        $reason = "Task passed";
                    }
                } else {
                    $reason = "Task passed";
                }

                // Record points
                Point::create([
                    'user_id' => $developer->id,
                    'task_id' => $task->id,
                    'points' => $points,
                    'reason' => $reason,
                ]);

                // Update task status to "pm_review"
                $task->update(['status' => 'pm_review']);

                return redirect()->route('tester.tasks')
                    ->with('success', 'Task passed! Points awarded: ' . $points);

            } else {
                // FAIL: Deduct -10 points
                Point::create([
                    'user_id' => $developer->id,
                    'task_id' => $task->id,
                    'points' => -10,
                    'reason' => 'Task failed testing',
                ]);

                // Increment failed attempts
                $task->increment('failed_attempts');

                // Check if failed attempts == 5
                if ($task->failed_attempts >= 5) {
                    // Allow admin/pm to reassign
                    $task->update([
                        'status' => 'failed',
                        'developer_id' => null, // Unassign developer
                    ]);

                    return redirect()->route('tester.tasks')
                        ->with('warning', 'Task failed. Developer has reached 5 failed attempts. Admin/PM can now reassign.');
                } else {
                    // Update task status to "failed" but keep developer assigned
                    $task->update(['status' => 'failed']);

                    return redirect()->route('tester.tasks')
                        ->with('error', 'Task failed. Points deducted: -10. Failed attempts: ' . $task->failed_attempts);
                }
            }
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('tester.tasks')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('tester.tasks')
                ->with('error', 'Task attempt not found.');
        } catch (\Exception $e) {
            \Log::error('Tester review error: ' . $e->getMessage(), [
                'attempt_id' => is_numeric($attempt) ? $attempt : ($attempt->id ?? null),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('tester.tasks')
                ->with('error', 'An error occurred while submitting the review. Please try again.')
                ->withInput();
        }
    }
}
