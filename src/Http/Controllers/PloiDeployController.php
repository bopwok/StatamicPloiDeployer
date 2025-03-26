<?php
namespace Savelend\PloiDeployer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Savelend\PloiDeployer\Facades\PloiConfig;

class PloiDeployController
{
    public function deploy(Request $request)
    {
        $config = PloiConfig::all();
        
        if (!isset($config['api_key']) || empty($config['api_key']) || 
            !isset($config['server_id']) || empty($config['server_id']) || 
            !isset($config['site_id']) || empty($config['site_id'])) {
            return response()->json(['success' => false, 'message' => 'Ploi API configuration is incomplete.'], 400);
        }
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $config['api_key'],
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post("https://ploi.io/api/servers/{$config['server_id']}/sites/{$config['site_id']}/deploy-to-production");
            
            if ($response->successful()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Deployment triggered successfully!'
                ]);
            } else {
                return response()->json([
                    'success' => false, 
                    'message' => 'Ploi API Error: ' . $response->body()
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}