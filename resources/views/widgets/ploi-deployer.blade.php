<div class="card p-0 h-full">
    <div class="flex justify-between items-center p-2">
        <h2>{{ $title }}</h2>
    </div>
    <div class="px-2 pb-2">
        <ploi-deployer-component :has-config="{{ json_encode($hasConfig) }}"></ploi-deployer-component>
    </div>
</div>