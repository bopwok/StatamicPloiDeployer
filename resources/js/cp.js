import PloiDeployerComponent from './components/PloiDeployerComponent.vue';

Statamic.booting(() => {
    Statamic.$components.register(
        'ploi-deployer-component',
        PloiDeployerComponent
    );
});
