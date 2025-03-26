<template>
    <div>
        <div v-if="!hasConfig" class="text-sm text-red-500 mb-2">
            Please configure your Ploi API settings first.
            <a :href="configRoute" class="text-blue-500 hover:text-blue-700">Configure now</a>
        </div>

        <button 
            class="btn-primary" 
            @click="deploy" 
            :disabled="loading || !hasConfig"
        >
            <span v-if="loading">Deploying...</span>
            <span v-else>Deploy to Production</span>
        </button>

        <div v-if="message" class="mt-2" :class="{'text-green-500': success, 'text-red-500': !success}">
            {{ message }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        hasConfig: {
            type: Boolean,
            required: true
        }
    },
    
    data() {
        return {
            loading: false,
            message: '',
            success: false,
            configRoute: Statamic.$config.get('routes.ploi-deployer.config.index')
        };
    },
    
    methods: {
        deploy() {
            this.loading = true;
            this.message = '';
            this.$axios.post(cp_url('ploi-deployer/deploy'))
                .then(response => {
                    this.success = true;
                    this.message = response.data.message;
                })
                .catch(error => {
                    this.success = false;
                    this.message = error.response?.data?.message || 'An error occurred during deployment.';
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>