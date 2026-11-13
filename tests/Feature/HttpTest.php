<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

class HttpTest extends TestCase
{

    public function testGet()
    {
        $response = Http::get('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertTrue($response->ok());
    }

    public function testPost()
    {
        $response = Http::post('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertTrue($response->ok());
    }

    public function testDelete()
    {
        $response = Http::delete('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertTrue($response->ok());
    }

    public function testResponse()
    {
        $response = Http::get('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertEquals(200, $response->status());
        assertNotNull($response->headers());
        assertNotNull($response->body());

        $json = $response->json();
        assertTrue($json);
    }

    public function testQueryParameter()
    {
        $response = Http::withQueryParameters([
            'page'=>1,
            'limit'=>10
        ])->get('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertTrue($response->ok());
    }

    public function testHeader()
    {
        $response = Http::withQueryParameters([
            'page'=>1,
            'limit'=>10
        ])->withHeaders([
            'Accept'=>'application/json',
            'X-Request-ID'=>'12323232323'
        ])->get('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertTrue($response->ok());
    }

    public function testCookie()
    {
        $response = Http::withQueryParameters([
            'page'=>1,
            'limit'=>10
        ])->withHeaders([
            'Accept'=>'application/json',
            'X-Request-ID'=>'12323232323'
        ])->withCookies([
            'SessionId'=>'12141414',
            'UserId'=>'1'
        ], 'https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro')->get('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro');
        assertTrue($response->ok());
    }

    public function testFormPost()
    {
        $response = Http::asForm()->post('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro', [
            'username'=>'admin',
            'password'=>'admin'
        ]);
        assertTrue($response->ok());
    }
    public function testMultiPart()
    {
        $response = Http::asMultipart()
        ->attach("profile", file_get_contents(__DIR__ . "/HttpTest.php"),"profile.jpg")
        ->post('https://bd0fa3351f48fd717fa8gi7abmeyyyyyb.oast.pro', [
            'username'=>'admin',
            'password'=>'admin'
        ]);
        assertTrue($response->ok());
    }


}
