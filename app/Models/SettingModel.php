<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model {

    protected string $table = 'settings';
    protected string $primaryKey = 'id';
    protected array $allowedFields = [
        'company_name', 'about_us', 'mission', 'vision', 'logo', 'mobile_logo', 'favicon', 'phone_1', 'phone_2', 'fax_1', 'fax_2',
        'email', 'facebook', 'twitter', 'instagram', 'linkedin',
    ];
}