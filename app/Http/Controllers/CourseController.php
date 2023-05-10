<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index');

    }
    public function create()
    {
        return view('courses.create');
    }
    public function edit($id)
    {
        $course = Course::find($id);
        return view('courses.edit',compact('course'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            'instructor' => 'required',
            'instructor_image' => 'required',
            'level' => 'required',
            'price' => 'required',
        ]);
        if ($request->file('instructor_image')) {
            $file = $request->file('instructor_image');
            $ext = $file->extension();
            $imageName = uniqid() . "." . $ext;
            $file->move("courses/", $imageName);
            $input['instructor_image'] = $imageName;
        }
        Course::create($input);
        return redirect(route('courses.index'))->with(['success' => 'New Course Created Successfully']);
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $course = Course::find($id);
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            'instructor' => 'required',
            'instructor_image' => 'nullable',
            'level' => 'required',
            'price' => 'required',
        ]);
        if ($request->file('instructor_image')) {
            $file = $request->file('instructor_image');
            $ext = $file->extension();
            $imageName = $course->instructor_image;
            $file->move("courses/", $imageName);
            $input['instructor_image'] = $imageName;
        }else{
            $input['instructor_image'] = $course->instructor_image;
        }
        $course->update($input);
        return redirect(route('courses.index'))->with(['success' => 'Course Updated Successfully']);
    }
    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show',compact('course'));
    }
}
