<?php

use App\Models\PendudukMandiri;
use Illuminate\Support\Facades\Auth;

class AuthenticationTest extends TestCase
{
    public function testSuccessLogin()
    {
        $this->post('/api/v1/auth/login', [
            'credential' => '3275014601977005',
            'password' => '123456',
        ])
        ->seeStatusCode(200)
        ->seeJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'access_token' => [
                        'token',
                        'token_type',
                        'expires_in',
                    ],
                    'foto',
                    'nama',
                    'nik',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'sex' => ['id', 'nama'],
                    'agama' => ['id', 'nama'],
                    'pendidikan' => ['id', 'nama'],
                    'pekerjaan' => ['id', 'nama'],
                ],
            ],
        ]);
    }

    public function testFailedLoginCredential()
    {
        $this->post('/api/v1/auth/login', [
            'credential' => '327501460197700',
            'password' => '12345',
        ])
        ->seeStatusCode(401)
        ->seeJsonStructure([
            'code',
            'messages' => ['credential'],
        ]);
    }

    public function testSuccesslogout()
    {
        $token = Auth::tokenById(PendudukMandiri::first()->id_pend);

        $this->post('/api/v1/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ])
        ->seeStatusCode(200);
    }
}
