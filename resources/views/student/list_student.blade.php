@extends('layout')
@section('pageTitle','Students')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="text-align: center;margin-bottom: 10px;">
                <h1><strong>Students</h1></strong>
            </div>
            <hr style="width:100%;size:3;color:black;background-color:black;">
            <div class="col-sm-12" style="text-align: right;margin-bottom: 10px;">
                <a href="{{route('students.add')}}" class="btn btn-primary">Add Student</a>
            </div>
            {{-- error alert --}}
            @if (session('commonSuccess'))
                <div class="col-sm-3" style="float: right;margin-left:75%;">
                    <div class="alert alert-success">
                        {{ session('commonSuccess') }}
                    </div>
                </div>
            @endif

            <div class="col-sm-12" style="text-align: center;">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Reporting Teacher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                            $totalRaw = 6;
                        @endphp
                        @if(count($students))
                            @php $i=1; @endphp
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$student['name']}}</td>
                                    <td>{{$student['age']}}</td>
                                    <td>{{$student['gender']}}</td>
                                    <td>{{$student['reporting_teacher']['name']}}</td>
                                    <td><a href="{{route('students.edit',['student_id' => $student['id']])}}">Edit</a> / <a onclick="return confirm('Are you sure?')" href="{{route('students.delete',['student_id' => $student['id']])}}">Delete</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{$totalRaw}}">No records found!</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{asset('/vendor/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    // When the user clicks on <div>, open the popup
    function myFunction() {
        Swal.fire(
        'Techsolutionstuff!',
        'You clicked the button!',
        'success'
        )
    }
    </script>

    @endpush
