<?php

namespace App\Console\Commands;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use App\Http\Resources\DownloadResource;
use App\Models\Download;
use Illuminate\Console\Command;

class Downloads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloads {action=help} {url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all file download tasks, along with useful data about their statuses.';

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        $action = $this->argument('action');
        $code = 0;

        switch ($action) {
            case 'help':
                $code = $this->help();
                break;
            case 'index':
                $code = $this->index();
                break;
            case 'store':
                $code = $this->store();
                break;
            default:
                $this->error(trans('adplexity.error_cli_unknown_action', [
                    'action' => $action
                ]));
                $code = 1;
        }

        return $code;
    }

    /**
     * @return void
     */
    private function index()
    {
        $this->table(
            $this->listTableHeader(),
            DownloadResource::collection(Download::get())->toArray(null)
        );

        return 0;
    }

    private function store()
    {
        $fileUrl = $this->argument('url');

        // Check if we have a valid URL
        if (empty($fileUrl) || !filter_var($fileUrl, FILTER_VALIDATE_URL)) {
            $this->error(trans('adplexity.error_cli_url_argument'));
            return 1;
        }

        try {
            CreateDownload::execute(DownloadDataFactory::createDataObjectFromUrl($fileUrl));

            // Show success message ;)
            $this->info(trans('adplexity.cli_success_add'));

            // Show list again
            $this->index();
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }

    /**
     * @return void
     */
    private function help(): void
    {
        $this->table(
            ['Available actions', 'Usage'],
            [
                [
                    'help', "Prints a table with a list of available actions and descriptions.\n"
                ],
                [
                    'index', "php artisan downloads index\nPrints a table with a list of available actions and descriptions.\n"
                ],
                [
                    'store', "php artisan downloads store https://URL_TO_FILE_TO_DOWNLOAD\nWill print a table, listing all queued downloads with their status and other useful data.\n"
                ]
            ]
        );
    }

    /**
     * @return array
     */
    private function listTableHeader(): array
    {
        return [
            'ID',
            'Filename',
            'Format',
            'URL',
            'Status',
            'Error',
            'Added',
            'Updated'
        ];
    }
}
