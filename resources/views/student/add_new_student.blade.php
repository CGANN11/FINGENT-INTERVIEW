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
                <h1><strong>Add new Student</h1></strong>
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
                <form action="{{route('students.save.new')}}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="form-group ">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ isset($old_input['name']) ? $old_input['name'] : ''}}" required>
                        </div>
                        <div class="form-group ">
                            <label for="name">Age</label>
                            <input type="number" id="age" name="age" class="form-control" value="{{ isset($old_input['age']) ? $old_input['age'] : ''}}" required>
                        </div>
                        <div class="form-group ">
                            <label for="name">Gender</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="" disabled selected>Select Gender</option>
                                @foreach (config('constants.GENDER') as $key => $value )
                                    <option value="{{$key}}" {{isset($old_input['gender']) && $old_input['gender'] == $key
                                     ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="name">Reporting Teacher</label>
                            <select id="reporting_tchr_id" name="reporting_tchr_id" class="form-control" required>
                                <option value="" disabled selected>Select Teacher</option>
                                @foreach ($teachers as $id => $name)
                                    <option value="{{$id}}" {{isset($old_input['reporting_tchr_id']) && $old_input['reporting_tchr_id'] == $id ? 'selected' : '' }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
