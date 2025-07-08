@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3 class="mb-4">Course Earnings Report</h3>
    <a href="{{ route('teacher.finance') }}" class="btn btn-secondary mb-3">Back to Financial Overview</a>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Total Earnings</th>
                            <th>Number of Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseEarnings as $row)
                            <tr>
                                <td>{{ $row['course'] }}</td>
                                <td>${{ number_format($row['earnings'], 2) }}</td>
                                <td>{{ $row['students'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 