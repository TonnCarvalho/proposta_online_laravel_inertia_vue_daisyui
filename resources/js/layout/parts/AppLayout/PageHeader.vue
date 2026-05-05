<script setup>
defineProps({
    title: String,
    subTitle: String,
    icon: String,
})
</script>
<template>
    <UDashboardSidebarToggle />
    <div class="flex gap-2 mb-5">
        <div class="bg-primary/30 p-5 rounded-lg">
            <UIcon :name="'i-lucide-' + icon" class="size-6 text-primary" />
        </div>
        <div class="">
            <p class="text-primary text-3xl font-semibold">
                {{ title }}
            </p>
            <p class="text-base">
                {{ subTitle }}
            </p>
        </div>
    </div>
</template>