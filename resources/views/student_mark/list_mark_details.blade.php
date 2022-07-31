@extends('layout')
@section('pageTitle','Students Mark')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="text-align: center;margin-bottom: 10px;">
                <h1><strong>Students Mark</h1></strong>
            </div>
            <hr style="width:100%;size:3;color:black;background-color:black;">
            <div class="col-sm-12" style="text-align: right;margin-bottom: 10px;">
                <a href="{{route('students.mark.add')}}" class="btn btn-primary">Add Student Mark</a>
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
                            @foreach ($subjects as $subject )
                                <th>{{$subject}}</th>
                            @endforeach
                            <th>Term</th>
                            <th>Total Marks</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                            $totalRaw = 6 + count($subjects);
                        @endphp
                        @if(count($studentDetails))
                            @foreach ($studentDetails as $studentTerm)
                                @foreach ($studentTerm as $student)
                                    @php $totalScore = 0; @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$student['student_name']}}</td>
                                        @foreach ($subjects as $id => $sub )
                                            @if(isset($student['subject'][$id]))
                                                @php $totalScore += $student['subject'][$id]; @endphp
                                                <td>{{$student['subject'][$id]}}</td>
                                            @else
                                                <td>0</td>
                                            @endif
                                        @endforeach
                                        <td>{{$student['term']}}</td>
                                        <td>{{$totalScore}}</td>
                                        <td>{{$student['created_on']}}</td>
                                        <td><a href="{{route('students.mark.edit',['student_id' => $student['student_id'], 'term' => $student['term']])}}">Edit</a> / <a onclick="return confirm('Are you sure?')" href="{{route('students.mark.delete',['student_id' => $student['student_id'], 'term' => $student['term']])}}">Delete</a></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{$totalRaw}}">No records found!</td>
                            </tr>
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
