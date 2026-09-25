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
    FileUser,
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
    FileUser,
}

</script>
<template>
    <div class="card-title text-base-content flex">
        <div v-if="icons[icon]"
            class="bg-primary/20 text-primary rounded p-1 flex justify-center items-center">
            <component :is="icons[icon]"
                class="" />
        </div>

        <span class="text-primary">
            {{ title }}
        </span>
    </div>
    <div v-if="subMessage"
        class="text-xs">
        {{ subMessage }}
    </div>

</template>