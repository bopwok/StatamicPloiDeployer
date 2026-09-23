<script>
import Confetti from "../confetti.min.js";
import { Widget } from '@statamic/cms/ui';

export default {
    components: {
        Widget,
    },

    props: {
        title: {
            type: String,
            required: true,
        },

        hasConfig: {
            type: Boolean,
            required: true,
        },
    },

    data() {
        return {
            loading: false,
            message: '',
            success: false,
            configRoute: Statamic.$config.get(
                'routes.ploi-deployer.config.index'
            ),
            confettiInstance: null,
        };
    },

    mounted() {
        if (typeof Confetti === 'function') {
            try {
                this.confettiInstance = new Confetti(
                    'ploi-confetti-target'
                );

                this.confettiInstance.setCount(175);
                this.confettiInstance.setPower(30);
                this.confettiInstance.setSize(1);
                this.confettiInstance.setFade(false);
                this.confettiInstance.destroyTarget(false);
            } catch (e) {
                //
            }
        }
    },

    methods: {
    deploy() {
        this.loading = true;

        this.$axios
            .post(cp_url('ploi-deployer/deploy'))
            .then(response => {
                this.$toast.success(
                    response.data.message || 'Deployment started.'
                );
            })
            .catch(error => {
                this.$toast.error(
                    error.response?.data?.message ||
                    'An error occurred during deployment.'
                );
            })
            .finally(() => {
                this.loading = false;
            });
    },
}
};
</script>

<template>
    <Widget :title="title">
        <div class="px-4 py-3">

            <div
                v-if="!hasConfig"
                class="text-sm text-red-500 mb-2"
            >
                Please configure your Ploi API settings first.

                <a
                    :href="configRoute"
                    class="text-blue-500 hover:text-blue-700"
                >
                    Configure now
                </a>
            </div>

            <ui-button
    id="ploi-confetti-target"
    variant="primary"
    :disabled="loading || !hasConfig"
    @click="deploy"
>
    {{ loading ? 'Deploying...' : 'Deploy to Production' }}
</ui-button>


        </div>
    </Widget>
</template>
