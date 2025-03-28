<?php
//Ahmad Mansour
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students
    public function index(Request $request)
    {
       
        $students = Student::when($request->search, function($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })
        ->when($request->min_age, function($query, $minAge) {
            return $query->where('age', '>=', $minAge);
        })
        ->when($request->max_age, function($query, $maxAge) {
            return $query->where('age', '<=', $maxAge);
        })
        ->get();

        if ($request->ajax()) {
            return view('partials.results', compact('students'));
        }

        return view('index', compact('students'));
    }

    // Show the form to create a new student
    public function create()
    {
        return view('create');
    }

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);

        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('index')->with('success', 'Student added successfully!');
    }

    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
