<?php

namespace Savelend\PloiDeployer\Http\Controllers;

use Illuminate\Http\Request;
use Savelend\PloiDeployer\Facades\PloiConfig;

class PloiConfigController
{
    public function index()
    {
        $config = PloiConfig::all();
        
        return view('savelend.ploi-deployer::settings.index', [
            'config' => $config
        ]);
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'api_key' => 'required|string',
            'server_id' => 'required|string',
            'site_id' => 'required|string',
        ]);
        
        PloiConfig::set($validated);
        
        return redirect()->back()->with('success', 'Ploi settings updated successfully.');
    }
}