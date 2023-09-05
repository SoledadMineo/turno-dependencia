<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AgregarRuta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:agregar-ruta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $resp = Http::withHeaders(['X-Api-Key'=> 'edd1c9f034335f136f87ad84b625c8f1'])
            ->post('http://apisix:9180/apisix/admin/routes', [
            "uri" => "/hola/*",
            "name"=> "hola_mundo",
            "upstream"=> [
                "nodes"=> ["nginx-hola_mundo:80"=>1],
                "type" => "roundrobin"
            ]
            ]);
        return $resp->json();

    }
}
