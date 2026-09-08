<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailNotification extends Notification
{
    use Queueable;

    // Declare $details as public so the entire class can access the data
    public $details;

    /**
     * __construct: Receives data from the Controller
     * When instantiated (new SendEmailNotification($details)), it runs here first
     */
    public function __construct($details)
    {
        // Capture the data passed from the controller and store it in $this->details
        $this->details = $details;
    }

    /**
     * via: Determines the delivery channels
     * In this case, we set it to 'mail', meaning it will be sent to the guest's email
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * toMail: Designs the email layout (Mail Representation)
     * It formats the form data into a well-structured email with a button and text
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            // Displays the greeting (e.g., Hello Sam Channa,)
            ->greeting($this->details['greeting'])
            
            // Displays the main content body written by the user
            ->line($this->details['body'])
            
            // Creates an action button
            // $this->details['actiontext'] = Button label
            // $this->details['actionurl'] = Link when the button is clicked
            ->action($this->details['actiontext'], $this->details['actionurl'])
            
            // Displays the ending line (e.g., Thank you for choosing KETO HOTEL!)
            ->line($this->details['endline']);
    }

    /**
     * toArray: Used if you also want to save notifications in the database
     */
    public function toArray(object $notifiable): array
    {
        return [
            // You can leave this empty if sending via email only
        ];
    }
}