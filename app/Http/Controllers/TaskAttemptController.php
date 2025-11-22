<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskAttemptController extends Controller
{
    /**
     * Store a newly created task attempt.
     */
    public function store(Request $request, $task)
    {
        try {
            // Get task by ID (route parameter is numeric)
            $task = Task::findOrFail($task);

            // Verify the task is assigned to the current developer
            if ($task->developer_id !== Auth::id()) {
                return redirect()->route('developer.tasks')
                    ->with('error', 'You are not assigned to this task.');
            }

            // Validate the request
            $validated = $request->validate([
                'submission_notes' => 'required|string',
                'file' => 'nullable|file|max:10240', // 10MB max
            ], [
                'submission_notes.required' => 'Submission notes are required.',
                'file.max' => 'File size must not exceed 10MB.',
            ]);

            // Get the next attempt number
            $attemptNumber = $task->attempts()->count() + 1;

            // Handle file upload
            $filePath = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('task_attempts', $fileName, 'public');
            }

            // Create the attempt
            $attempt = TaskAttempt::create([
                'task_id' => $task->id,
                'developer_id' => Auth::id(),
                'attempt_number' => $attemptNumber,
                'submission_notes' => $validated['submission_notes'],
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]);

            // Update task status to "submitted"
            $task->update(['status' => 'submitted']);

            return redirect()->route('developer.tasks')
                ->with('success', 'Task submitted successfully! Waiting for tester review.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('developer.tasks')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('developer.tasks')
                ->with('error', 'Task not found.');
        } catch (\Exception $e) {
            \Log::error('Task submission error: ' . $e->getMessage(), [
                'task_id' => is_numeric($task) ? $task : ($task->id ?? null),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('developer.tasks')
                ->with('error', 'An error occurred while submitting the task. Please try again.')
                ->withInput();
        }
    }
}
