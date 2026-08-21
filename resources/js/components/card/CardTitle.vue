<script setup>
import {
    DollarSign,
    User,
    FileText,
    Search,
    Users,
    Wallet,
    SlidersHorizontal,
    MapPinned,
    Landmark,
    Files,
} from '@lucide/vue'

defineProps({
    title: String,
    icon: String,
    subMessage: String,
})

const icons = {
    DollarSign,
    User,
    FileText,
    Search,
    Users,
    Wallet,
    SlidersHorizontal,
    MapPinned,
    Landmark,
    Files,
}

</script>
<template>
    <div class="card-title text-base-content flex">

        <component v-if="icons[icon]"
            :is="icons[icon]"
            size="30"
            class="bg-primary/20 text-primary p-1.5 rounded flex justify-center items-center" />

        <span class="text-primary">
            {{ title }}
        </span>
    </div>
    <div v-if="subMessage"
        class="text-xs">
        {{ subMessage }}
    </div>

</template>