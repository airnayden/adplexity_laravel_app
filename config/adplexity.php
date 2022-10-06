<?php

return [
    'allowed_formats' => env('ADPLEXITY_ALLOWED_FORMATS', 'pdf,zip,rar,7zip,tar,gz,doc,docx,mp3,wav,avi,png,jpg,jpeg,webp,txt,rtf,sql'),
    //'max_file_size' => env('ADPLEXITY_MAX_FILE_SIZE', 512000)
    // Default Queue to dispatch Jobs to (in case we're using SQS or RabbitMQ)
    //'defaultQueueName' => env('ADPLEXITY_DEFAULT_QUEUE', 'adplexity_downloads'),
];
