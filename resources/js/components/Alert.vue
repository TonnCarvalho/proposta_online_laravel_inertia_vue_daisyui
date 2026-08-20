<script setup>
import { 
    Ban,
    UserRoundPlus,
    UserRoundX,
    FileCheck,
} from '@lucide/vue';

const icons = {
    Ban,
    UserRoundPlus,
    UserRoundX,
    FileCheck,
}

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

        <component v-if="icon"
            :is="icons[icon]"
            size="25" />
        <div>
            <h3 class="text-lg font-bold">{{ message }}</h3>
            <div v-if="subMessage"
                class="text-xs">
                {{ subMessage }}
            </div>
        </div>
    </div>
</template>