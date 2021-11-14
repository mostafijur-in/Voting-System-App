<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Voter;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();
        return view('home', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request)
    {
        $errors = [];

        $mobile = intval($request->mobile);
        $candidate1 = intval($request->candidateOne);
        $candidate2 = intval($request->candidateTwo);

        $voter  = false;
        if(empty($mobile)) {
            $errors["mobile"]   = "Mobile No is required.";
        } else {
            $voter  = Voter::where('mobile', $mobile)->first();
            if(!$voter) {
                $errors["mobile"]   = "Unknow voter (This mobile no is not registered).";
            }
        }

        if(empty($candidate1)) {
            $errors["candidateOne"]   = "Select a candidate.";
        }
        if(empty($candidate2)) {
            $errors["candidateTwo"]   = "Select a candidate.";
        }
        if(!empty($candidate2) && ($candidate1 === $candidate2)) {
            $errors["candidateTwo"]   = "You can not vote for same candidate.";
        }

        if(!empty($errors)) {
            return response()->json([
                'message' => 'Fix the errors and try again.',
                'errors' => $errors,
            ], 422);
        }

        try {
            $vote1  = Vote::updateOrCreate(
                [
                    'voter_id'  => $voter->voter_id,
                    'preference'  => 1,
                ],
                ['candidate_id' => $candidate1]
            );

            $vote2  = Vote::updateOrCreate(
                [
                    'voter_id'  => $voter->voter_id,
                    'preference'  => 2,
                ],
                ['candidate_id' => $candidate2]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'You have cast your vote successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to process your request.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Voter list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function voter_list()
    {
        $voters = Voter::all();
        return view('voter-list', compact('voters'));
    }

    /**
     * Poll result
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function poll_result()
    {
        $candidatesQ = Candidate::selectRaw('candidates.candidate_name, count(votes.candidate_id) as votes')
            ->leftJoin('votes', 'candidates.candidate_id', '=', 'votes.candidate_id')
            ->groupBy('candidates.candidate_name')
            ->orderBy('votes', 'desc');

        $candidates = $candidatesQ->get();
        $winners    = $candidatesQ->limit(2)->get();

        return view('poll-result', compact('candidates', 'winners'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
