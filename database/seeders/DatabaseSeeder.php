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

        $topic1 = Topic::factory()->hasTopicDocuments(2)->create(['name'=>'Tax']);
        $topic2 = Topic::factory()->hasTopicDocuments(2)->create(['name'=>'Working hours']);
        $topic3 = Topic::factory()->hasTopicDocuments(2)->create(['name'=>'Holiday policy']);

        $question1 = Question::factory()->create(['topic_id'=>$topic1->id,'question_text'=>'How many tires does a car have?']);
        $question2 = Question::factory()->create(['topic_id'=>$topic1->id,'question_text'=>'How many eyes does a human have?']);
        $question3 = Question::factory()->create(['topic_id'=>$topic1->id,'question_text'=>'How many fingers does a human have?']);
        $answer1 = Answer::factory()->create(['question_id'=>$question1->id,'isCorrect'=>'yes','answer_text'=>'4']);
        $answer2 = Answer::factory()->create(['question_id'=>$question1->id,'isCorrect'=>'no','answer_text'=>'5']);
        $answer3 = Answer::factory()->create(['question_id'=>$question1->id,'isCorrect'=>'no','answer_text'=>'3']);
        $answer4 = Answer::factory()->create(['question_id'=>$question2->id,'isCorrect'=>'yes','answer_text'=>'2']);
        $answer5 = Answer::factory()->create(['question_id'=>$question2->id,'isCorrect'=>'no','answer_text'=>'4']);
        $answer6 = Answer::factory()->create(['question_id'=>$question2->id,'isCorrect'=>'no','answer_text'=>'8']);
        $answer7 = Answer::factory()->create(['question_id'=>$question3->id,'isCorrect'=>'yes','answer_text'=>'10']);
        $answer8 = Answer::factory()->create(['question_id'=>$question3->id,'isCorrect'=>'no','answer_text'=>'5']);
        $answer9 = Answer::factory()->create(['question_id'=>$question3->id,'isCorrect'=>'no','answer_text'=>'4']);

        $question4 = Question::factory()->create(['topic_id'=>$topic2->id,'question_text'=>'How many compass directions are there?']);
        $question5 = Question::factory()->create(['topic_id'=>$topic2->id,'question_text'=>'The capital city of Kenya is?']);
        $question6 = Question::factory()->create(['topic_id'=>$topic2->id,'question_text'=>'What gives light during the day?']);
        $answer1 = Answer::factory()->create(['question_id'=>$question4->id,'isCorrect'=>'yes','answer_text'=>'4']);
        $answer2 = Answer::factory()->create(['question_id'=>$question4->id,'isCorrect'=>'no','answer_text'=>'3']);
        $answer3 = Answer::factory()->create(['question_id'=>$question4->id,'isCorrect'=>'no','answer_text'=>'2']);
        $answer4 = Answer::factory()->create(['question_id'=>$question5->id,'isCorrect'=>'yes','answer_text'=>'Nairobi']);
        $answer5 = Answer::factory()->create(['question_id'=>$question5->id,'isCorrect'=>'no','answer_text'=>'Khartoum']);
        $answer6 = Answer::factory()->create(['question_id'=>$question5->id,'isCorrect'=>'no','answer_text'=>'Mombasa']);
        $answer7 = Answer::factory()->create(['question_id'=>$question6->id,'isCorrect'=>'yes','answer_text'=>'Sun']);
        $answer8 = Answer::factory()->create(['question_id'=>$question6->id,'isCorrect'=>'no','answer_text'=>'Moon']);
        $answer9 = Answer::factory()->create(['question_id'=>$question6->id,'isCorrect'=>'no','answer_text'=>'Both']);

        $question7 = Question::factory()->create(['topic_id'=>$topic3->id,'question_text'=>'How many tires does a bicycle have?']);
        $question8 = Question::factory()->create(['topic_id'=>$topic3->id,'question_text'=>'A baby goat is called?']);
        $question9 = Question::factory()->create(['topic_id'=>$topic3->id,'question_text'=>'How many days make a week?']);
        $answer1 = Answer::factory()->create(['question_id'=>$question7->id,'isCorrect'=>'yes','answer_text'=>'2']);
        $answer2 = Answer::factory()->create(['question_id'=>$question7->id,'isCorrect'=>'no','answer_text'=>'5']);
        $answer3 = Answer::factory()->create(['question_id'=>$question7->id,'isCorrect'=>'no','answer_text'=>'3']);
        $answer4 = Answer::factory()->create(['question_id'=>$question8->id,'isCorrect'=>'yes','answer_text'=>'Kid']);
        $answer5 = Answer::factory()->create(['question_id'=>$question8->id,'isCorrect'=>'no','answer_text'=>'Lamb']);
        $answer6 = Answer::factory()->create(['question_id'=>$question8->id,'isCorrect'=>'no','answer_text'=>'Young goat']);
        $answer7 = Answer::factory()->create(['question_id'=>$question9->id,'isCorrect'=>'yes','answer_text'=>'7']);
        $answer8 = Answer::factory()->create(['question_id'=>$question9->id,'isCorrect'=>'no','answer_text'=>'5']);
        $answer9 = Answer::factory()->create(['question_id'=>$question9->id,'isCorrect'=>'no','answer_text'=>'6']);

        // $assessment = Assessment::factory()->create(['user_id'=>$user->id, 'isComplete'=>'yes']);
        // $assessmentQuestion1 = AssessmentQuestion::factory()->create([
        //     'question_id'=>$question1->id,
        //     'assessment_id'=>$assessment->id,
        //     'answer_id'=>$answer1->id,
        //     'time_taken'=>12
        // ]);
        // $assessmentQuestion2 = AssessmentQuestion::factory()->create([
        //     'question_id'=>$question2->id,
        //     'assessment_id'=>$assessment->id,
        //     'answer_id'=>$answer2->id,
        //     'time_taken'=>12
        // ]);
        // $assessmentQuestion3 = AssessmentQuestion::factory()->create([
        //     'question_id'=>$question3->id,
        //     'assessment_id'=>$assessment->id,
        //     'answer_id'=>$answer3->id,
        //     'time_taken'=>12
        // ]);

        // $assessmentStat = AssessmentStat::factory()->create([
        //     'assessment_id'=>$assessment->id,
        //     'topic_id'=>$topic1->id,
        //     'should_recap_topic'=>'yes',
        //     'topic_performance'=>33,
        // ]);
    }
}
