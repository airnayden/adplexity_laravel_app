# AdPlexity - File Downloader

Proof of concept Laravel app for downloading remote resources, using Jobs and tracking progress.

## Requirements
PHP 8.1

## Setup
1. Clone the repo locally
2. Edit `.env` with your DB credentials, `APP_KEY`, `APP_URL`, `ADPLEXITY_ALLOWED_FORMATS`.
3. Run `./prepare.sh`. This script will fetch the latest files from the repository, clear cache, run migrations and install composer dependencies.
4. Run `php artisan serve` to start the app.
5. [Optional] To generate API docs - run `php ./generate_apidoc.php`. [`apidoc` is required!!!. Also you won't be able to view documentation, using `php artisan serve`. You need to open it on the app's domain.]

## Queue Workers
In order to start the workers, simply run `./work_queues.sh`.

## CLI Commands
The application comes with a CLI command for monitoring and adding new downloads to the queue.

#### CLI Usage
`php artisan downloads` -> Will print a table, listing all queued downloads with their status and other useful data.


## API Documentation
Documentation for the API can be found under `/docs` in your app URL.
Example for the hosted demo: https://adplexity-laravel.drpanchev.com/docs

## Testing
Run the following commands for tests:
1. Run `php artisan test`

## Demo
You can see a demo of the app here: https://adplexity-laravel.drpanchev.com/

#### Demo Notes: 
Because the application here runs on a shared hosting, jobs are not operational. The only available functionality for testing is adding a new file for downloads and listing them. Using the `sync` driver for processing the queue would make the web app slow, so it's not in use.
