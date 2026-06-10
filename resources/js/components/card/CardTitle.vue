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
            <FontAwesomeIcon :icon="['fas', icon]" />
        </span>
        <span>
            {{ title }}
        </span>
    </div>
</template>