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
import "../confetti.min.js"; // exposes window.confetti from confettijs.org

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
            // fire confetti immediately on click
            this.confettiBurst();

            this.loading = true;
            this.message = '';
            this.$axios.post(cp_url('ploi-deployer/deploy'))
                .then(response => {
                    this.success = true;
                    this.message = response.data.message;

                    // optional: celebrate success again
                    // this.confettiBurst();
                })
                .catch(error => {
                    this.success = false;
                    this.message = error.response?.data?.message || 'An error occurred during deployment.';
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        confettiBurst() {
            // guard if the script hasn't loaded for any reason
            if (typeof window !== 'undefined' && typeof window.confetti === 'function') {
                window.confetti({
                    particleCount: 140,
                    spread: 70,
                    startVelocity: 55,
                    origin: { y: 0.6 }
                });
            }
        }
    }
}
</script>
