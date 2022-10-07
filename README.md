# AdPlexity - File Downloader

Proof of concept Laravel app for downloading remote resources, using Jobs and tracking progress.

## How it works
This application lets you add a file to the download queue. 
Only certain file formats are allowed. By default: `pdf,zip,rar,7zip,tar,gz,doc,docx,mp3,wav,avi,png,jpg,jpeg,webp,txt,rtf,sql`.

1. The user adds a valid link to a file for download.
2. The information is written in the database, storing the URL, file name, format and status (`Pending` by default) in the form of a `Download` object (represented by a `Download` model).
3. A Job is dispatched to the queue and will be processed by the workers.
4. When the job begins, the file will be put into `Downloading` status.
5. If the Job fails, then the `Download` object status will be changed to `Error`
6. If the Job succeeds, then the `Download` object status will be changed to `Complete`
7. If the `Download` object has `Complete` status, then it can be downloaded.

### How to use
Adding and listing queued downloads can be done either from the REST API (see docs), Web frontend or CLI (see CLI docs).

File download can be done only via REST API or Web frontend.

## Requirements
PHP 8.1

Composer v2

## Setup
1. Clone the repo locally
2. Edit `.env` with your DB credentials, `APP_KEY`, `APP_URL`, `ADPLEXITY_ALLOWED_FORMATS`.
3. Run `./prepare.sh`. This script will fetch the latest files from the repository, clear cache, run migrations and install composer dependencies.
4. Run `php artisan serve` to start the app.
5. [Optional] To generate API docs - run `php ./generate_apidoc.php`. [`apidoc` and `nodejs` are required!!!. Also you won't be able to view documentation, using `php artisan serve`. You need to open it on the app's domain.]
6. The application does not include any demo data by default.

## Queue Workers
In order to start the workers, simply run `./work_queues.sh`.

## Localisation
The application is fully localised and can be easily translated to other languages.

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

### Future Improvements
1. Better error handler.
2. Search / pagination / filtering / sorting of the listings for both API and Web.
3. Update / Delete of links.
4. Add support for RabbitMQ as queue driver.
5. Add configurable limitations for downloadable file sizes.

## Code, which might be of interest, is located under:
`app/Console/Commands`

`app/Events`

`app/Listeners`

`app/Jobs`

`app/Actions`

`app/Enums`

`app/Http/Requests`

`app/DataTransferObjects`

`app/DataFactories`

`app/Http/Controllers`

`app/Http/Models`

`app/Http/Resources`

`database/Migrations`

`database/seeders`

`resources/views`

`tests`
