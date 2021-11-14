{{-- Extends layout --}}
@extends('default')

@section('content')


<section class="section py-5 bg-light">
    <div class="container">
        <div class="card">
            <div class="text-center py-4">
                <h1 class="fw-light">Poll Result</h1>
            </div>


            <div class="card-body">

                <div class="winners mx-auto mb-3">
                    <h5 class="mb-2">Winners</h5>

                    @php
                        $sl = 1;
                    @endphp
                    <table class="table table-bordered">
                        @foreach ($winners as $winner)
                            <tr>
                                <td class="w-25">{{ $sl }}</td>
                                <td class="w-75">{{ $winner->candidate_name }}</td>
                            </tr>
                            @php
                            $sl++;
                            @endphp
                        @endforeach
                    </table>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Candidate Name</th>
                            <th>Votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $rnk = 1;
                        @endphp
                        @foreach ($candidates as $c)
                        <tr>
                            <td>{{ $rnk }}</td>
                            <td>{{ $c->candidate_name }}</td>
                            <td>{{ $c->votes }}</td>
                        </tr>
                        @php
                            $rnk++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
