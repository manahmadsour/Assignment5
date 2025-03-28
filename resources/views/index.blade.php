
@extends('layout')
@section('title', 'Students')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<h2>Students</h2>
<div>
<input type="text" id="search" placeholder="Search by name...">
        <input type="number" id="min_age" placeholder="Min age">
        <input type="number" id="max_age" placeholder="Max age">
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
        @include('partials.results', ['students' => $students])
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            function loadStudents() {
                $.ajax({
                    url: "{{ route('index') }}",
                    method: 'GET',
                    data: {
                        search: $('#search').val(),
                        min_age: $('#min_age').val(),
                        max_age: $('#max_age').val()
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }

            $('#search, #min_age, #max_age').on('input', loadStudents);
            loadStudents(); 
        });
    </script>
@endsection