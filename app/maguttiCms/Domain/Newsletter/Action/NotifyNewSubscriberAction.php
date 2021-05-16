<?php


namespace App\maguttiCms\Domain\Newsletter\Action;


use App\maguttiCms\Notifications\NewsletterSubscriberAdminNotification;
use App\maguttiCms\Notifications\NewsletterSubscribeUserNotification;
use App\Newsletter;
use Illuminate\Support\Facades\Notification;

class NotifyNewSubscriberAction
{

    private Newsletter $newsletter;

    /**
     * NotifyNewSubscriberAction constructor.
     * @param Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {

        $this->newsletter = $newsletter;
    }

    /**
     * @return mixed
     */
    function execute()
    {
        Notification::route('mail', config('maguttiCms.website.option.app.email'))
            ->notify(new NewsletterSubscriberAdminNotification($this->newsletter));

        Notification::route('mail', $this->newsletter->email)
            ->notify(new NewsletterSubscribeUserNotification($this->newsletter));
    }
}