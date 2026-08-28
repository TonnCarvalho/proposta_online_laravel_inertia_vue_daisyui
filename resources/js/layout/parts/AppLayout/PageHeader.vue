<script setup>
defineProps({
    title: String,
    subTitle: String,
    icon: String,
})
</script>
<template>
    <div class="flex gap-2 mb-5">
        <div>
            <p class="text-primary text-2xl md:text-3xl font-semibold">
                {{ title }}
            </p>
            <p class="text-base">
                {{ subTitle }}
            </p>
        </div>
    </div>
</template>