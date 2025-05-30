<?php

namespace App\Http\Controllers\FamilyMember;

use App\Models\User;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Models\EligibilityRequest;
use App\Models\EligibilityQuestion;
use App\Models\EligibilityResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\AuthUserViewSharedDataTrait;
use App\Http\Requests\EligibilityResponseRequest;

class FamilyMemberEligibilityController extends Controller
{
    use AuthUserViewSharedDataTrait;

    public function __construct()
    {
        $this->shareViewData();
    }



 
    

    // Handle eligibility request for family member
    public function EligibilityFamilyList()
    {
        $user = Auth::user();
        $familyMembers = $user->managedCareBeneficiaries()->with('careBeneficiary')->get();

        return view('familymember.pages.eligibility-family-list', compact('familyMembers'));
    }


    
    public function showEligibilityForm(Request $request, $userId)
    {
        $user = Auth::user();
    
        // Check if the authenticated user is a family member of the requested user ID
        $familyMember = FamilyMember::where('family_member_id', $user->id)->where('care_beneficiary_id', $userId)->first();
    
        if (!$familyMember) {
            return redirect()->route('familymember.dashboard')->with('error', 'You are not authorized to access this page.');
        }

        $care_beneficiary_user = User::where('id', $userId)->where('role', 'care_beneficiary')->firstOrFail();


        // get eligibility 
        $carebeneficiary_eligibility = $care_beneficiary_user->eligibility;

        // Get all trashed question IDs
        $trashedQuestions = EligibilityQuestion::onlyTrashed()->pluck('id')->toArray();

        // Get all questions
        $questions = EligibilityQuestion::all();

        // Get responses
        $responses = EligibilityResponse::where('user_id', $care_beneficiary_user->id)->get()->keyBy('question_id');

        // If eligibility status is NOT NULL and responses are EMPTY, delete the eligibility request
        if ($carebeneficiary_eligibility !== null && $responses->isEmpty()) {
            $carebeneficiary_eligibility->forceDelete();
            return redirect()->route('familymember.dashboard')->with('error', 'You need to complete the eligibility request.');
        }
    
    
        // Only check for trashed questions if responses exist
        if (!$responses->isEmpty()) {
            foreach ($responses as $questionId => $response) {
                if (in_array($questionId, $trashedQuestions)) {
                    $response->forceDelete();
                    unset($responses[$questionId]);
                }
            }
        }
    
        return view('familymember.pages.eligibility-show', compact('carebeneficiary_eligibility', 'questions', 'responses','care_beneficiary_user'));
    }
    


    // Eligibility for Family Member
    public function saveEligibilityFormResponse(EligibilityResponseRequest $request, $userId)
    {
        $user = Auth::user();

        // Check if the authenticated user is a family member of the requested user ID
        $familyMember = FamilyMember::where('family_member_id', $user->id)->where('care_beneficiary_id', $userId)->first();

        if (!$familyMember) {
            return redirect()->route('familymember.dashboard')
                ->with('error', 'You are not authorized to access this page.');
        }

        $questionId = $request->input('question_id');
        $answer = $request->input('answer');
        $answer_other = $request->input('answer_other');
        $childAnswer = $request->input('child_answer');
        
        // Fetch the question record to get child_question_required
        $question = EligibilityQuestion::find($questionId);
        
        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid question ID.'
            ], 400);
        }
        
        // Check if answer is "others" and ensure answer_other is provided

        if($question->others ==1 ){
            if (strtolower(trim($answer)) === 'others') {
                if (empty($answer_other)) {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Please provide more details when selecting "Others".'
                    ], 422);
                }
                $answer = $answer_other;
            }
        }
        
        // Validate child_answer if child_question_required is 1
        if ($question->child_question_required && empty($childAnswer)) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide an answer for the required second question.'
            ], 422);
        }
        
        
        // Convert multiple answers to JSON format
        $answer = is_array($answer) ? json_encode($answer) : $answer;

        // Save or update the eligibility response
        EligibilityResponse::updateOrCreate(
            [
                'user_id' => $userId,
                'question_id' => $questionId
            ],
            [
                'answer' => $answer,
                'child_answer' => $childAnswer,
            ]
        );

        // Check if all questions are answered
        $totalQuestions = EligibilityQuestion::count();
        $totalResponses = EligibilityResponse::where('user_id', $userId)->count();

        // If all questions are answered, update or create an eligibility request
        if ($totalQuestions > 0 && $totalQuestions === $totalResponses) {
            EligibilityRequest::updateOrCreate(
                ['user_id' => $userId],
                [
                    'status' => 'pending',
                    'note' => null,
                    'eligibility_checked_by' => null,
                    'submitted_by' => Auth::id(),  
                ]
            );
        }

        return response()->json(['success' => true, 'message' => 'Response saved successfully.']);
    }
 


}
 