
@forelse($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->age }}</td>
    </tr>
@empty
    <tr>
        <td colspan="3" style="text-align: center;">No students found</td>
    </tr>
@endforelse