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
            $resp = Http::withHeaders(['X-Api-Key'=> 'edd1c9f034335f136f87ad84b625c8f1'])
            ->post('http://apisix:9180/apisix/admin/routes', [
            "uri" => "/seguro/*",
            "name"=> "hola_seguro",
            "upstream"=> [
                "nodes"=> ["nginx-hola_mundo:80"=>1],
                "type" => "roundrobin"
            ],
            "plugins"=> [
                "openid-connect" => [
                    "client_id" =>"mpf",
                    "client_secret" =>"d5c42c50-3e71-4bbe-aa9e-31083ab29da4",
                    "discovery" =>"http://127.0.0.1:7082/auth/realms/master/.well-known/openid-configuration",
                    "scope" => "openid profile",
                    "bearer_only" => false,
                    "realm" =>"master",
                    //"introspection_endpoint_auth_method" =>"client_secret_post",
                    "redirect_uri" => "http://127.0.0.1:7080/"
                ]
            ],

        ]);
        return $resp->json();

    }
}
