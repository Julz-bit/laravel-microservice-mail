## ENV

Mailer Config: Will load mailer config in database `mails` table via MailServiceProvider if `mails` table doesn't exists, it will load the .env mail configuration.

Queue Config: Use Rabbitmq for queue connection
```sh
    QUEUE_CONNECTION=rabbitmq
    RABBITMQ_HOST=
    RABBITMQ_PORT=
    RABBITMQ_USER=
    RABBITMQ_PASSWORD=
    RABBITMQ_VHOST=/
    RABBITMQ_QUEUE=mail_service_queue
```

Job Class: MailServiceJob($htmlContent, $to, $subject)
- $htmlContent = pass raw HTML. Avoid to pass markdown
- $to = can be single recepient inclosed in string 'julz@seav.com' or an array ['julz@seav.com', 'julz@dev.com']
- $subject = pass the subject of the mail

  Example usage: 
  ```php
        $to = ['julz101.pci@gmail.com', 'julz.seaversity@gmail.com'];
        $subject = 'Napaka innocent mo Julz';
        $url = 'https://github.com/Julz-bit';
        $htmlContent = View::make('emails.test', ['url' => $url])->render();
        MailServiceJob::dispatch($htmlContent, $to, $subject)->onQueue('mail_service_queue');
    ?>
    ```
   

```sh
php artisan rabbitmq:consume
```
- queue name must be existed before running it 

```sh
php artisan queue:work
```
- even the queue is not exist will generate the queue name after recieving a job


Test in Action:
```sh
    php artisan fire:baby
```
