<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SystemRequirements extends Command
{
    // El nombre y la descripción del comando.
    protected $signature = 'system:requirements';
    protected $description = 'Genera una lista de los requerimientos del sistema en un archivo txt';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Recolección de los requerimientos del sistema.
        $requirements = [
            'PHP Version' => phpversion(),
            'Laravel Version' => app()->version(),
            'OS' => PHP_OS,
            'Database Connection' => config('database.default'),
            'Storage Path Writable' => is_writable(storage_path()) ? 'Yes' : 'No',
            'Cache Path Writable' => is_writable(storage_path('framework/cache')) ? 'Yes' : 'No',
            'Log Path Writable' => is_writable(storage_path('logs')) ? 'Yes' : 'No',
        ];

        // Formato y escritura en un archivo txt.
        $content = "System Requirements:\n\n";
        foreach ($requirements as $key => $value) {
            $content .= "$key: $value\n";
        }

        File::put(storage_path('system_requirements.txt'), $content);

        $this->info('Los requerimientos del sistema se han guardado en ' . storage_path('system_requirements.txt'));
    }
}
