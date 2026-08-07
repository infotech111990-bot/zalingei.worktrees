<?php

namespace App\Http\Middleware;

use Closure;
use App\Period;
use App\Student;

class CheckPeriod
{
    /**
     * Handle an incoming request.
     * Usage in route: ->middleware('period:results') or 'period:registration'
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type = 'results')
    {
        $collegeId = null;

        // Try to detect college from route parameters or request inputs
        if($request->route('college')){
            $collegeId = $request->route('college');
        }

        // If route has an 'id' and it looks like a student id, try to load student
        if(!$collegeId && $request->route('id')){
            $id = $request->route('id');
            $student = Student::find($id);
            if($student){
                $collegeId = $student->college_id;
            }
        }

        // If request has college_id explicitly
        if(!$collegeId && $request->input('college_id')){
            $collegeId = $request->input('college_id');
        }

        // Check period
        if(!Period::isOpen($type, $collegeId)){
            // Not open -> abort or redirect with message
            if($request->expectsJson()){
                return response()->json(['message' => 'This '.$type.' period is currently closed.'], 403);
            }
            return redirect()->back()->with('error', 'This '.$type.' period is currently closed.');
        }

        return $next($request);
    }
}
