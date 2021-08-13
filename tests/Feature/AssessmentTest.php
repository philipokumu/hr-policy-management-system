<?php

namespace Tests\Feature;

use App\Http\Livewire\AssessmentStat as LivewireAssessmentStat;
use App\Models\Answer;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentStat;
use App\Models\Question;
use App\Models\Topic;
use App\Models\TopicDocument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Livewire\Livewire;
use Tests\TestCase;

class AssessmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_take_assessment()
    {
        // $this->withoutExceptionHandling();
        //Create a employee
        Sanctum::actingAs($employee = User::factory()->create(), ['*']);

        $response = $this->get('/assessments/create')->assertOk();

        $assessment = Assessment::first();
        // $assessmentQuestions = AssessmentQuestion::all();

        $topic = Topic::factory()->create();
        Question::factory(11)->create(['topic_id'=>$topic->id]);

        //Assertions
        $this->assertCount(1, Assessment::all());
        $this->assertEquals($employee->id, $assessment->user_id);
        $this->assertEquals($assessment->total_questions, 10);

        // $response->assertViewHasAll([
        //     'assessment_id',
        // ]);

        // $response->assertSeeText('assessment_id', $escaped = true);

    }


    public function test_employee_can_answer_questions()
    {
        $this->withoutExceptionHandling();
        //Create a employee
        Sanctum::actingAs($employee = User::factory()->create(), ['*']);

        $assessment = Assessment::factory()->create(['user_id'=>$employee->id]);
        $topic = Topic::factory()->create();
        $question = Question::factory()->create(['topic_id'=>$topic->id]);
        $answer = Answer::factory()->create(['question_id'=>$question->id]);
        $asessmentQuestion = AssessmentQuestion::factory(['assessment_id'=>$assessment->id,'question_id'=>$question->id])->create();

        $response = $this->patch('/assessments/'.$assessment->id.'/assessmentQuestions/'.$asessmentQuestion->id,[
            'answer_id'=>$answer->id,
            'time_taken'=>7,
            'isLast' => 'no'
        ])->assertOk();

        $assessmentQuestionAnswered = AssessmentQuestion::first();

        //Assertions
        $this->assertEquals($assessmentQuestionAnswered->time_taken, 7);
        $this->assertEquals($assessmentQuestionAnswered->answer_id, 1);

        $nextAssessmentQuestionId = $asessmentQuestion->id + 1;
        // $response->assertRedirect('/assessments/'.$assessment->id.'/assessmentQuestions/'.$nextAssessmentQuestionId);

    }

    public function test_employee_gets_results_after_answering_all_questions()
    {
        $this->withoutExceptionHandling();

        //Create employee
        Sanctum::actingAs($employee = User::factory()->create(), ['*']);

        $assessment = Assessment::factory()->create(['user_id'=>$employee->id,'total_questions'=>3]);
        $topic = Topic::factory()->create();
        $question1 = Question::factory()->create(['topic_id'=>$topic->id]);
        $question2 = Question::factory()->create(['topic_id'=>$topic->id]);
        $question3 = Question::factory()->create(['topic_id'=>$topic->id]);
        $answer1 = Answer::factory()->create(['question_id'=>$question1->id, 'isCorrect'=>'yes']);
        $answer2 = Answer::factory()->create(['question_id'=>$question2->id, 'isCorrect'=>'yes']);
        $answer3 = Answer::factory()->create(['question_id'=>$question3->id, 'isCorrect'=>'yes']);

        $asessmentQuestion1 = AssessmentQuestion::factory([
            'assessment_id'=>$assessment->id,
            'question_id'=>$question1->id,
            'answer_id'=>$answer1->id,
            'time_taken'=>12
        ])->create();
        $asessmentQuestion2 = AssessmentQuestion::factory([
            'assessment_id'=>$assessment->id,
            'question_id'=>$question2->id,
            'answer_id'=>$answer2->id,
            'time_taken'=>12
        ])->create();
        $asessmentQuestion3 = AssessmentQuestion::factory([
            'assessment_id'=>$assessment->id,
            'question_id'=>$question3->id,
        ])->create();

        $response = $this->patch('/assessments/'.$assessment->id.'/assessmentQuestions/'.$asessmentQuestion3->id,[
            'answer_id'=>$answer3->id,
            'time_taken'=>12,
            'isLast' => 'yes'
        ])->assertOk();

        $assessmentStat = AssessmentStat::first();

        //Assertions
        $this->assertCount(1,AssessmentStat::all());
        $this->assertNotEmpty($assessmentStat->topic_performance);
        // $this->assertEquals($assessmentStats->time_taken, 7);
        // $this->assertEquals($assessmentQuestionAnswered->answer_id, 1);

        // $nextAssessmentQuestionId = $asessmentQuestion->id + 1;
        // $response->assertRedirect('/assessments/'.$assessment->id.'/assessmentQuestions/'.$nextAssessmentQuestionId);

    }

    public function test_employee_can_view_their_latest_assessment_on_their_dashboard()
    {
        $this->withoutExceptionHandling();
        //Create a employee
        $employee = User::factory()->create();

        $latestAssessment = Assessment::factory()->create(['user_id'=>$employee->id]);
        $topic1 = Topic::factory()->create();
        $topic2 = Topic::factory()->create();

        $topicDoc1 = TopicDocument::factory()->create(['topic_id'=>$topic1->id]);
        $topicDoc2 = TopicDocument::factory()->create(['topic_id'=>$topic2->id]);

        $latestAssessmentStats1 = AssessmentStat::factory()->create([
            'assessment_id'=>$latestAssessment->id,
            'topic_id'=>$topic1->id,
        ]);

        $latestAssessmentStats2 = AssessmentStat::factory()->create([
            'assessment_id'=>$latestAssessment->id,
            'topic_id'=>$topic2->id,
        ]);

        Livewire::actingAs($employee)
            ->test(LivewireAssessmentStat::class)
            ->assertStatus(200);

    }
}
