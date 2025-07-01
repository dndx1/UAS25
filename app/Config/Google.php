<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public $clientID     = '29930009673-ek8dar6sdbjla3khcq57uf16dhvjttlt.apps.googleusercontent.com';
    public $clientSecret = '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';
    public $redirectUri  = 'http://localhost:8080/auth/googleCallback'; // ganti sesuai base_url kamu
}
