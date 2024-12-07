<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    function index()
    {
        $job = Job::get();
        return view('job.index', compact('job'));
    }

    function submit(Request $request)
    {
        $job = new Job();
        $job->name_job = $request->name_job;
        $job->save();

        return redirect()->route('job.index')->with('success', 'Job created successfully.');
    }

    function update(Request $request, $job_id)
    {
        $job = Job::find($job_id);
        if (!$job) {
            return redirect()->route('job.index')->with('error', 'Job not found');
        }
        $job->name_job = $request->name_job;
        $job->update();

        return redirect()->route('job.index')->with('success', 'Job updated successfully.');
    }

    function destroy($job_id)
    {
        $job = job::find($job_id);
        $job->delete();

        return redirect()->route('job.index')->with('success', 'Job deleted successfully.');
    }
}
