@extends('statamic::layout')
@section('title', 'Ploi Deployer Settings')

@section('content')
    <div class="flex items-center justify-between mb-3">
        <h1>Ploi Deployer Settings</h1>
    </div>

    <div class="card p-0 mb-3">
        <div class="p-2">
            <form method="POST" action="{{ cp_route('ploi-deployer.config.update') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="api_key" class="font-bold text-base mb-sm">Ploi API Key</label>
                    <input type="password" name="api_key" id="api_key" class="input-text" value="{{ $config['api_key'] ?? '' }}" required>
                    <div class="text-xs text-gray-600 mt-1">
                        You can find your API key in your Ploi account settings.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="server_id" class="font-bold text-base mb-sm">Server ID</label>
                    <input type="text" name="server_id" id="server_id" class="input-text" value="{{ $config['server_id'] ?? '' }}" required>
                    <div class="text-xs text-gray-600 mt-1">
                        The ID of your server in Ploi.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="site_id" class="font-bold text-base mb-sm">Site ID</label>
                    <input type="text" name="site_id" id="site_id" class="input-text" value="{{ $config['site_id'] ?? '' }}" required>
                    <div class="text-xs text-gray-600 mt-1">
                        The ID of your site in Ploi.
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="btn-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@stop