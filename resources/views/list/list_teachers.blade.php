@extends('layout')
@section('pageTitle','Teachers')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="text-align: center;margin-bottom: 10px;">
                <h1><strong>Teachers</h1></strong>
            </div>
            <hr style="width:100%;size:3;color:black;background-color:black;">

            <div class="col-sm-12" style="text-align: center;">
                <table class="table table-sm" style="width:50%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                            $totalRaw = 6;
                        @endphp
                        @if(count($teachers))
                            @php $i=1; @endphp
                            @foreach ($teachers as $name)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$name}}</td>
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
