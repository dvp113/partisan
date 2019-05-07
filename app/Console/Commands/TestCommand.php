<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:thoi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $verifyCsrfToken_file = app_path().'/Http/Middleware/VerifyCsrfToken.php';
        $content_file = file_get_contents($verifyCsrfToken_file);
        $string_append = "\t'/that',\n\t'/that/*',\n";
        $pattern = '/protected \$except = \[([\s\S]*?)];/';

        preg_match($pattern, $content_file, $output);
        $string_after_append = $output[1].$string_append;
        $new_content = str_replace(
            [
                $output[1]
            ],
            [
                $string_after_append
            ],
            $content_file
        );
        file_put_contents($verifyCsrfToken_file, $new_content);

        $this->info('Them csrf thanh cong');
        return true;
    }
}
