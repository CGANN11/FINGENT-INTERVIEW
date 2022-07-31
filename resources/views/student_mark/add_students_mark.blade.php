@extends('layout')
@section('pageTitle','Add Student')
@push('css')
<style>
    form button {
        margin-left: 50%;
        margin-bottom: 10px;
    }

    .alert {
        padding: 10px;
        background-color: #f44336;
        color: white;
    }


</style>
@endpush
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="text-align: left;">
                <h1><strong>Add Student Mark</h1></strong>
            </div>
            @if (session('commonError') || session('commonSuccess'))
                @php
                    $old_input = session()->getOldInput();
                @endphp
            @endif
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
                            <select id="student_id" name="student_id" class="form-control" required>
                                <option value="" disabled selected>Select Student</option>
                                @foreach ($students as $id => $name)
                                    <option value="{{$id}}" {{isset($old_input['student_id']) && $old_input['student_id'] == $id ? 'selected' : '' }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="name">Subject</label>
                            <select id="subject_id" name="subject_id" class="form-control" required>
                                <option value="" disabled selected>Select Subject</option>
                                @foreach ($subjects as $id => $name)
                                    <option value="{{$id}}" {{isset($old_input['subject_id']) && $old_input['subject_id'] == $id ? 'selected' : '' }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="name">Mark</label>
                            <input type="text" id="mark" name="mark" class="form-control" value="{{ isset($old_input['mark']) ? $old_input['mark'] : ''}}" required>
                        </div>
                        <div class="form-group ">
                            <label for="name">Term</label>
                            <input type="text" id="term" name="term" class="form-control" value="{{ isset($old_input['term']) ? $old_input['term'] : ''}}" required>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
