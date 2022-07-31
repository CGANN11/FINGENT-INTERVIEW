@extends('layout')
@section('pageTitle','Edit Student Mark')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="text-align: left;">
                <h1><strong>Edit Student Mark</h1></strong>
            </div>
            {{-- error alert --}}
            @if (session('commonError'))
                <div class="col-sm-3" style="float: right;margin-left:75%;">
                    <div class="alert alert-danger">
                        {{ session('commonError') }}
                    </div>
                </div>
            @endif
            <div class="col-sm-6">
                <form action="{{route('students.mark.save')}}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="form-group ">
                            <label for="name">Student Name</label>
                            <select id="student_id" name="student_id" class="form-control" readonly disabled>
                                <option value="" disabled selected>Select Student</option>
                                @foreach ($students as $id => $name)
                                    <option value="{{$id}}" {{($studentMarks['student_id'] == $id) ? 'selected' : '' }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Term</label>
                            <input type="text" id="term" name="term" class="form-control" value="{{ $studentMarks['term'] }}"  readonly disabled>
                        </div>
                        @foreach ($studentMarks['subjects_and_marks'] as $sub_id => $value)
                            <hr>
                            <h3>{{$value['subject']}}</h3>
                            <div class="form-group ">
                                <label for="name">Mark</label>
                                <input type="text" id="mark" name="mark[{{$value['mark_id']}}]" class="form-control" value="{{ $value['mark'] }}" required>
                            </div>
                            <input type="hidden" value="{{$value['mark_id']}}" name="student_mark_id[]" id="student_mark_id"/>
                        @endforeach

                    </fieldset>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
