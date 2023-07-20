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
You will get the test notification message.(_NOTE: You must enable system notification on your device. If you have blocked the notifications, the notification will not send to your device!_)

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
 - At the payload URL, paste your ngrok URL that exposed from your local server. (_Don't forget to add the '/git' at the ent of the URL_)
 - ![image](https://github.com/SaiZawMyint/git-notifier/assets/96133665/6ef7687e-816e-4b0e-8196-548322c267e0)
 - Scroll down and at the **Which events would you like to trigger this webhook?**, choose the **Send me everything**.
 - ![image](https://github.com/SaiZawMyint/git-notifier/assets/96133665/30753799-d091-44ee-94ef-d24e2dd0d27c)

 - Click on Add webhooks button (_You can skip other input, after you have completed the about options_)

Congratulations, we have done all of the implementation.
<hr/>

## Test
Make some event to the repository you have configure the webhook, likes push, fork, given stars, issues, pull request, etc...
You will Get the notification every time event happened on your repository. 

## Where to use?
> **As the project is to handle the Git event, you can use it when you want to notify the event of your Git repository.
> It's very useful when you have the development team and you want to know who have push to the repository
> or who have PR to the repository or other actions happen between your team development.**

<br/>

**Hope this help you in your improvement or development with Git. :D**

### Thank you. 







