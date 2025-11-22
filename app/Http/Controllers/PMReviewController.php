<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\PMReview;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PMReviewController extends Controller
{
    /**
     * Store a new PM review for a task.
     */
    public function store(Request $request, $task)
    {
        try {
            // Get task by ID (route parameter is numeric) - eager load developer
            $task = Task::with('developer')->findOrFail($task);

            // Verify the task is assigned to the current PM
            if ($task->pm_id !== Auth::id()) {
                return redirect()->route('pm.tasks')
                    ->with('error', 'You are not assigned as PM for this task.');
            }

            // Verify task is in pm_review status
            if ($task->status !== 'pm_review') {
                return redirect()->route('pm.tasks')
                    ->with('error', 'This task is not pending PM review.');
            }

            // Verify task has a developer assigned
            if (!$task->developer_id || !$task->developer) {
                return redirect()->route('pm.tasks')
                    ->with('error', 'This task does not have a developer assigned.');
            }

            // Validate the request
            $validated = $request->validate([
                'status' => 'required|in:correct,issue',
                'remarks' => 'required|string|min:10',
            ], [
                'status.required' => 'Review status is required.',
                'status.in' => 'Status must be either correct or issue.',
                'remarks.required' => 'Remarks are required.',
                'remarks.min' => 'Remarks must be at least 10 characters.',
            ]);

            // Create the review
            $review = PMReview::create([
                'task_id' => $task->id,
                'pm_id' => Auth::id(),
                'status' => $validated['status'],
                'remarks' => $validated['remarks'],
            ]);

            $developer = $task->developer;
            
            // Check if developer exists
            if (!$developer) {
                return redirect()->route('pm.tasks')
                    ->with('error', 'Developer not found for this task.');
            }

            if ($validated['status'] === 'correct') {
                // CORRECT: Add +10 points
                Point::create([
                    'user_id' => $developer->id,
                    'task_id' => $task->id,
                    'points' => 10,
                    'reason' => 'PM final approval - correct',
                ]);

                // Update task status to "final_completed"
                $task->update(['status' => 'final_completed']);

                return redirect()->route('pm.tasks')
                    ->with('success', 'Task approved! Points awarded: +10');

            } else {
                // ISSUE: Deduct -5 points
                Point::create([
                    'user_id' => $developer->id,
                    'task_id' => $task->id,
                    'points' => -5,
                    'reason' => 'PM found issues - sent back to developer',
                ]);

                // Update task status back to "pending" (goes back to developer)
                $task->update(['status' => 'pending']);

                return redirect()->route('pm.tasks')
                    ->with('warning', 'Issues found. Task sent back to developer. Points deducted: -5');
            }
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('pm.tasks')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('pm.tasks')
                ->with('error', 'Task not found.');
        } catch (\Exception $e) {
            \Log::error('PM review error: ' . $e->getMessage(), [
                'task_id' => is_numeric($task) ? $task : ($task->id ?? null),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Show actual error in development, generic message in production
            $errorMessage = config('app.debug') 
                ? 'Error: ' . $e->getMessage() 
                : 'An error occurred while submitting the review. Please try again.';
            
            return redirect()->route('pm.tasks')
                ->with('error', $errorMessage)
                ->withInput();
        }
    }
}
