<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    public function downloadBackup()
    {
        abort_unless(Gate::allows('hasPermission', 'export_backup'), 403);

        if(env('DB_USED') == 'production')
        {
            $username = 'u1642703_indotehnik';
            $password = 'indotehnik@deus.code';
            $dbname = 'u1642703_indotehnik';
        }
        else if(env('DB_USED') == 'local')
        {
            $username = 'root';
            $password = '';
            $dbname = 'indotehnik';
        }

        $dumpPath = 'export/backup.sql';

        $command = [
            'mysqldump',
            "-u{$username}",
            "-p{$password}",
            $dbname,
        ];

        $process = new Process($command);
        $process->run();

        if ($process->isSuccessful()) {
            $output = $process->getOutput();
            $outputFile = public_path($dumpPath);
            file_put_contents($outputFile, $output);
        }
                
        return Response::download($outputFile, 'backup_' . date('dmY', strtotime('now'))  .  '.sql')->deleteFileAfterSend(true);
    }
}
