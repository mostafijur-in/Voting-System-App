{{-- Extends layout --}}
@extends('default')

@section('content')


<section class="section py-5 bg-light">
    <div class="container">
        <div class="card">
            <div class="text-center py-4">
                <h1 class="fw-light">Voter List</h1>
            </div>


            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Voter Name</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($voters as $voter)
                        <tr>
                            <td>{{ $sl }}</td>
                            <td>{{ $voter->voter_name }}</td>
                            <td>{{ $voter->mobile }}</td>
                        </tr>
                        @php
                            $sl++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
