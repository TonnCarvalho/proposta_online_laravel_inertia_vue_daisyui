<script setup>
defineProps({
    icon: String,
    title: String,
})
</script>

<template>
    <div class="card-title text-neutral p-3 flex items-center gap-1
    border-b border-base-content/20">
        <FontAwesomeIcon v-if="icon"
            :icon="['fas', icon]" class="text-neutral" />
        {{ title }}
    </div>
</template>