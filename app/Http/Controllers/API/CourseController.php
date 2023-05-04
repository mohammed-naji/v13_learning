<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 1,
            'message' => 'All Courses',
            'data' => Course::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'image' => 'nullable|mimes:png,jpg,jpeg',
        //     'price' => 'required',
        //     'duration' => 'required',
        //     'content' => 'required',
        //     'instructor_id' => 'required',
        //     'category_id' => 'required',
        // ]);

        $val = Validator::make($request->all(),[
            'title' => 'required|unique:courses,title',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'price' => 'required',
            'duration' => 'required',
            'content' => 'required',
            'instructor_id' => 'required',
            'category_id' => 'required',
        ]);

        if($val->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $val->errors()->first(),
                'data' => []
            ], 422);
        }

        // file upload
        $courseimage = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'), $courseimage);

        // save in database
        $course = Course::create([
            'title' => $request->title,
            'price' => $request->price,
            'duration' => $request->duration,
            'content' => $request->content,
            'instructor_id' => $request->instructor_id,
            'category_id' => $request->category_id,
            'image' => $courseimage
        ]);

        if($course) {
            return response()->json([
                'status' => 1,
                'message' => 'Course Created',
                'data' => $course
            ], 201);
        }else {
            return response()->json([
                'status' => 0,
                'message' => '',
                'data' => []
            ], 404);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        if($course) {
            return response()->json([
                'status' => 1,
                'message' => 'All Courses',
                'data' => $course
            ], 200);
        }else {
            return response()->json([
                'status' => 0,
                'message' => '',
                'data' => []
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $val = Validator::make($request->all(),[
        //     'title' => 'required|unique:courses,title',
        //     'image' => 'nullable|mimes:png,jpg,jpeg',
        //     'price' => 'required',
        //     'duration' => 'required',
        //     'content' => 'required',
        //     'instructor_id' => 'required',
        //     'category_id' => 'required',
        // ]);

        // if($val->fails()) {
        //     return response()->json([
        //         'status' => 0,
        //         'message' => $val->errors()->first(),
        //         'data' => []
        //     ], 422);
        // }

        $course = Course::find($id);

        $courseimage = $course->image;

        if($request->hasFile('image')) {
            // file upload
            $courseimage = rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images'), $courseimage);
        }


        // save in database
        // $course->update([
        //     'title' => $request->title,
        //     'price' => $request->price,
        //     'duration' => $request->duration,
        //     'content' => $request->content,
        //     'instructor_id' => $request->instructor_id,
        //     'category_id' => $request->category_id,
        //     'image' => $courseimage
        // ]);

        $course->update($request->all());

        if($course) {
            return response()->json([
                'status' => 1,
                'message' => 'Course Updated',
                'data' => $course
            ], 201);
        }else {
            return response()->json([
                'status' => 0,
                'message' => '',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::destroy($id);

        if($course) {
            return response()->json([
                'status' => 1,
                'message' => 'Course Deleted',
                'data' => []
            ], 200);
        }else {
            return response()->json([
                'status' => 0,
                'message' => 'Course Not Found',
                'data' => []
            ], 404);
        }
    }
}
