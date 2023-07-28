<?php

use app\GitNotifier;

include __DIR__ . '/vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];

error_log($request);

switch ($request) {
    case "/git": {
            error_log("Git action => $_SERVER[HTTP_X_GITHUB_EVENT]");
            git();
        }
        break;
    case "/chatwork": {
            error_log("Chat action => $_SERVER[HTTP_X_GITHUB_EVENT]");
            chatwork();
        }
        break;
    case "/test-noti": {
            (new GitNotifier())->sendNotification("Test", "Testing");
        }
        break;
    default: {
            if (str_contains($request, 'chatwork')) {
                chatwork();
            } else {
                error_log("Default action!");
            }
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
    handleGit($json);
}

function chatwork()
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
    error_log($json);
    handleChatWork($json);
}

function handleGit($payload)
{
    $gitNotifier = new GitNotifier();
    $event = $_SERVER['HTTP_X_GITHUB_EVENT'];
    $data = json_decode($payload);
    $repository = $data->repository->full_name;
    $url = $data->repository->url;
    $sender = $data->sender->login;
    $body = "Repository: $repository\nSender: $sender\nEvent: $event\nurl: $url";
    $gitNotifier->sendNotification("Some actions happen to your Git!", $body, $url);
}

function handleChatWork($payload)
{
    $gitNotifier = new GitNotifier();
    $data = json_decode($payload);
    $body = $data->webhook_event->body;
    $gitNotifier->sendNotification("Some action happen to your Chatwork Group!", "Message : " . $body);
}
