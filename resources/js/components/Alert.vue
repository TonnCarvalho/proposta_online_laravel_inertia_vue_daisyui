<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    message: String,
    icon: String,
    soft: Boolean,
    outline: Boolean,
    dash: Boolean,
    subMessage: String,
})

</script>
<template>
    <div role="alert"
        class="alert sm:alert-horizontal my-3"
        :class="{
            'alert-soft': soft,
            'alert-outline': outline,
            'alert-dash': dash,
        }">

        <FontAwesomeIcon v-if="icon"
            :icon="['fas', icon]" 
            class="text-2xl"/>
        <div>
            <h3 class="text-xl font-bold">{{ message }}</h3>
            <div class="text-xs"
                v-if="subMessage">{{ subMessage }}</div>
        </div>
    </div>
</template>