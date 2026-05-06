<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps({
    title: String,
    subTitle: String,
    icon: String,
})
</script>
<template>
    <div class="flex gap-2 mb-5">
        <div class="bg-primary/30 p-4 rounded-lg">
            <FontAwesomeIcon :icon="['fas', icon]" class="text-primary" size="xl" />
        </div>
        <div class="">
            <p class="text-primary text-2xl md:text-3xl font-semibold">
                {{ title }}
            </p>
            <p class="text-base">
                {{ subTitle }}
            </p>
        </div>
    </div>
</template>