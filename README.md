# git-notifier
The git events notifiers, you can implement it to handle all of your Git events happening at any time.

## What you need?
We use the Git webhook technology to handle all of the Git events, so we need some things for the implementation.
  - [Ngrok](https://ngrok.com/): to expose your HTTP over HTTPS to get access for the [Get Webhooks as a payload URL](https://docs.github.com/en/webhooks-and-events/webhooks/creating-webhooks#exposing-localhost-to-the-internet).
  - [Composer](https://getcomposer.org/): to manage the packages of our PHP project.
  - [PHP](https://www.php.net/): to locally develop your own project in handling the Git event process.

## How to use?
First of all, open the terminal at the location of your project folder, and clone the repository.
```sh
git clone https://github.com/SaiZawMyint/git-notifier.git
```
And install the necessary packages, by running
```sh
cd git-notifier
composer install
```

## Start the local development
Now, we are ready to start our local development server.
```sh
php -S localhost:8080
```
To test the notification, open your browser, and on the URL bar, enter the following URL and press enter
```sh
http://localhost:8080/test-noti
```
You will get the test notification message.

We have done our local development, and now let's continue to configure the Git webhook.

## Expose the local server
As Git webhook payload URL, allows only HTTPS so we need to expose our local server to HTTPS.
To do it we will use the [Ngrok](https://ngrok.com/). _If you have not installed the Ngrok on your device 
go to the download page [here](https://ngrok.com/download) and install it._

Open the terminal and enter the following 
```sh
ngrok http 8080
```
You will get the log on the command like this
```sh
Session Status                online
Account                       {{your ngrok account email}} (Plan: Free)
Version                       3.3.1                                                                                     
Region                        Asia Pacific (ap)
Latency                       45ms
Web Interface                 http://127.0.0.1:4040
Forwarding                    https://{{your-ngrok-custom-ips}}.ngrok-free.app -> http://localhost:8080
Connections                   ttl     opn     rt1     rt5     p50     p90
                              0       0       0.00    0.00    0.00    0.00
```
At the *Forwording* sentence, copy the URL exposed by Ngrok. Now we get the exposed URL for our local development.

## Configure Git Webhook
Let's start to configure our git webhook. 
 - Go to the your [Git](https://github.com/) profile.
 - Choose the repository you want to implement the Git event.
 - Go to the settings page.
 - ![image](https://github.com/SaiZawMyint/git-notifier/assets/96133665/beecaf09-708c-4d77-9b64-53850fce9bd7)
 - Click on Webhooks at the side bar.
 - ![image](https://github.com/SaiZawMyint/git-notifier/assets/96133665/f213350e-a450-4cc2-af48-6c57f38dd4b9)
 - Add new Webhook.
 - At the payload URL, paste your ngrok URL that exposed from your local server.
 - ![image](https://github.com/SaiZawMyint/git-notifier/assets/96133665/6ef7687e-816e-4b0e-8196-548322c267e0)
 - Click on Add webhooks button (_You can skip other input, after you have put the payload URL_)

Congratulations, we have done all of the implementation.
<hr/>

## Test
Make some event to the repository you have configure the webhook, likes push, fork, given stars, issues, pull request, etc...
You will Get the notification every time event happened on your repository. 

<hr/>

Hope this help you understanding the Git webhook more. :D

### Thank you. 







