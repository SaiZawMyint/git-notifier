<?php

use app\GitNotifier;

include __DIR__ . '/vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case "/git": {
            error_log("Git action!");
            git();
        }
        break;
    case "/test-noti": {
            (new GitNotifier())->sendNotification("Test", "Testing");
        }
        break;
    default: {
            error_log("Default action!");
        }
}

function git()
{
    switch ($_SERVER['CONTENT_TYPE']) {
        case 'application/json':
            $json = file_get_contents('php://input');
            break;
        case 'application/x-www-form-urlencoded':
            $json = $_POST['payload'];
            break;
        default:
            throw new \Exception("Unsupported content type: $_SERVER[CONTENT_TYPE]");
    }
    handle($json);
}

function handle($payload)
{
    $gitNotifier = new GitNotifier();
    $event = $_SERVER['HTTP_X_GITHUB_EVENT'];
    $data = json_decode($payload);
    $repository = $data->repository->full_name;
    $url = $data->repository->url;
    $sender = $data->sender->login;
    $body = "Repository: $repository\nSender: $sender\nEvent: $event\nurl: $url";
    $gitNotifier->sendNotification("Some actions happen to you Git!", $body, $url);
}
