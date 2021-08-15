<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentStat;
use App\Models\Question;
use App\Models\Topic;
use App\Models\TopicDocument;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(['email'=>'user@example.com']);
        $admin = User::factory()->create(['email'=>'admin@example.com','role'=>'admin']);

        $topic = Topic::factory()->create();
        $topicDocument = TopicDocument::factory(2)->create(['topic_id'=>$topic->id]);

        $assessment = Assessment::factory()->create(['user_id'=>$user->id, 'isComplete'=>'yes']);

        $question1 = Question::factory()->create(['topic_id'=>$topic->id]);
        $question2 = Question::factory()->create(['topic_id'=>$topic->id]);
        $question3 = Question::factory()->create(['topic_id'=>$topic->id]);
        $answer1 = Answer::factory()->create(['question_id'=>$question1->id,'isCorrect'=>'yes']);
        $answer2 = Answer::factory()->create(['question_id'=>$question1->id,'isCorrect'=>'no']);
        $answer3 = Answer::factory()->create(['question_id'=>$question1->id,'isCorrect'=>'no']);
        $answer4 = Answer::factory()->create(['question_id'=>$question2->id,'isCorrect'=>'yes']);
        $answer5 = Answer::factory()->create(['question_id'=>$question2->id,'isCorrect'=>'no']);
        $answer6 = Answer::factory()->create(['question_id'=>$question2->id,'isCorrect'=>'no']);
        $answer7 = Answer::factory()->create(['question_id'=>$question3->id,'isCorrect'=>'yes']);
        $answer8 = Answer::factory()->create(['question_id'=>$question3->id,'isCorrect'=>'no']);
        $answer9 = Answer::factory()->create(['question_id'=>$question3->id,'isCorrect'=>'no']);
        $assessmentQuestion1 = AssessmentQuestion::factory()->create([
            'question_id'=>$question1->id,
            'assessment_id'=>$assessment->id,
            'answer_id'=>$answer1->id,
            'time_taken'=>12
        ]);
        $assessmentQuestion2 = AssessmentQuestion::factory()->create([
            'question_id'=>$question2->id,
            'assessment_id'=>$assessment->id,
            'answer_id'=>$answer2->id,
            'time_taken'=>12
        ]);
        $assessmentQuestion3 = AssessmentQuestion::factory()->create([
            'question_id'=>$question3->id,
            'assessment_id'=>$assessment->id,
            'answer_id'=>$answer3->id,
            'time_taken'=>12
        ]);

        $assessmentStat = AssessmentStat::factory()->create([
            'assessment_id'=>$assessment->id,
            'topic_id'=>$topic->id,
            'should_recap_topic'=>'yes',
            'topic_performance'=>33,
        ]);
    }
}
