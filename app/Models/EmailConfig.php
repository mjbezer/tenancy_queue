<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\Http\Controllers\ParametroController;
use Illuminate\Support\Facades\Auth;

class EmailConfig extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'email_config';
    protected $primaryKey = 'id';
    protected $fillable = [
      'host',
      'port',
      'username',
      'password',
      'encryption',
      'from_address',
      'from_name',
    ];

    public function getEncryptionAttributes($value)
    {
      return strtoupper($value);
    }

    static function emailConfig()
    {
      $config = EmailConfig::first();
      if(isset($config)){        
        return array(
              \Config::set('mail.host', $config->host),
              \Config::set('mail.port', $config->port),
              \Config::set('mail.username', $config->username),
              \Config::set('mail.password', $config->password),
              \Config::set('mail.encryption', $config->encryption),
              \Config::set('mail.from', [
                                'address' => $config->from_address, 
                                'name' =>$config->from_name
                          ])
        );
      } else { 
      return $config;
      }
    }
  

  }