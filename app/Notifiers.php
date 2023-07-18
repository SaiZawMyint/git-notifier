<?php
namespace app;

use Joli\JoliNotif\NotifierFactory;
use Joli\JoliNotif\Notification;
use Joli\JoliNotif\Notifier;

class GitNotifier{
    public Notifier $notifier;

    function __construct(){
        $this->notifier = NotifierFactory::create();
    }

    function sendNotification($title, $message, $url = null){
        $notification = (new Notification())
        ->setTitle($title)
        ->setBody($message)
        ->setIcon($_SERVER['DOCUMENT_ROOT'].'/resources/github.png');

        if($url != null){
            $notification->addOption('url', $url);
        }
        $this->notifier->send($notification);
    }
}
