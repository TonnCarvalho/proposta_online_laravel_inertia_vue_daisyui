<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps({
    title: String,
    icon: String,
})
</script>
<template>
    <div class="card-title text-base-content flex">
        <span v-if="icon">
            <div class="bg-primary/20 text-primary p-1.5 rounded flex justify-center items-center">
                <FontAwesomeIcon :icon="['fas', icon]"/>
            </div>
        </span>
        <span>
            {{ title }}
        </span>
    </div>
</template>