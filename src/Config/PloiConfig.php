<?php

namespace Savelend\PloiDeployer\Config;

use Statamic\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Encryption\Encrypter;

class PloiConfig
{
    protected $disk;
    protected $path;
    protected $encrypter;
    
    public function __construct()
    {
        $this->disk = 'local';
        $this->path = 'ploi-deployer/config.json';
        
        // Set up encrypter with app key
        $key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $this->encrypter = new Encrypter($key, config('app.cipher'));
    }
    
    public function all()
    {
        if (!Storage::disk($this->disk)->exists($this->path)) {
            return [];
        }
        
        $contents = Storage::disk($this->disk)->get($this->path);
        
        try {
            $decrypted = $this->encrypter->decrypt($contents);
            return json_decode($decrypted, true);
        } catch (\Exception $e) {
            return [];
        }
    }
    
    public function get($key, $default = null)
    {
        $config = $this->all();
        
        return $config[$key] ?? $default;
    }
    
    public function set($values)
    {
        $config = $this->all();
        
        foreach ($values as $key => $value) {
            $config[$key] = $value;
        }
        
        $encrypted = $this->encrypter->encrypt(json_encode($config));
        
        if (!Storage::disk($this->disk)->exists(dirname($this->path))) {
            Storage::disk($this->disk)->makeDirectory(dirname($this->path));
        }
        
        Storage::disk($this->disk)->put($this->path, $encrypted);
        
        return true;
    }
}