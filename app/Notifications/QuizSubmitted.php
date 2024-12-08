<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class QuizSubmitted extends Notification
{
    public $quiz;

    public function __construct($quiz)
    {
        $this->quiz = $quiz;
    }

    public function via($notifiable)
    {
        return ['database']; // Store the notification in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'quiz_id' => $this->quiz->id,
            'message' => 'You have successfully submitted the quiz: ' . $this->quiz->title,
        ];
    }
}
