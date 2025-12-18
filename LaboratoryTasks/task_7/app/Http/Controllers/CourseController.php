<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q');
        $courses = Course::query()
            ->when($q, function ($query, $q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('category', 'like', "%{$q}%");
            })
            ->latest()
            ->get();

        return view('courses.index', compact('courses', 'q'));
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $course = Course::create($request->validated());
        return redirect()->route('courses.show', $course)->with('status', 'Course created');
    }

    public function show(Course $course): View
    {
        $course->load(['feedbacks' => function ($q) {
            $q->latest();
        }]);
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());
        return redirect()->route('courses.show', $course)->with('status', 'Course updated');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect()->route('courses.index')->with('status', 'Course deleted');
    }
}
