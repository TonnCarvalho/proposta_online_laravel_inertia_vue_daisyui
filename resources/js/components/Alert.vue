<script setup>
import {
    Ban,
    UserRoundPlus,
    UserRoundX,
    FileCheck,
} from '@lucide/vue';
import { computed } from 'vue';

const icons = {
    Ban,
    UserRoundPlus,
    UserRoundX,
    FileCheck,
}

const props = defineProps({
    icon: String,
    message: String,
    subMessage: String,
    success: Boolean,
    error: Boolean,
    warning: Boolean,
    type: {
        type: String,
        default: 'success',
        validator: (value) => ['success', 'error', 'warning'].includes(value),
    },

})

const alertClass = computed(() => {
    const classes = {
        success: 'bg-green-100 text-green-600 border-green-600',
        error: 'bg-red-100 text-red-600 border-red-600',
        warning: 'bg-yellow-100 text-yellow-600 border-yellow-600',
    }

    return classes[props.type] ?? classes.success
})

</script>
<template>
    <div role="alert"
        class="alert sm:alert-horizontal my-3"
        :class="alertClass">

        <component v-if="icon"
            :is="icons[icon]"
            size="25" />
        <div>
            <h3 class="text-lg font-bold">{{ message }}</h3>
            <div v-if="subMessage"
                class="text-xs text-base-content">
                {{ subMessage }}
            </div>
        </div>
    </div>
</template>