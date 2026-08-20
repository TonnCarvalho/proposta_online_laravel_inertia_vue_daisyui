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
}

</script>
<template>
    <div class="card-title text-base-content flex">
        <span v-if="icons[icon]">
            <div class="bg-primary/20 text-primary p-1.5 rounded flex justify-center items-center">
                <component :is="icons[icon]"
                    size="20" />
            </div>
        </span>
        <span class="text-primary">
            {{ title }}
        </span>
    </div>
        <div v-if="subMessage"
        class="text-xs">
        {{ subMessage }}
    </div>

</template>