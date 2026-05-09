<script setup>
defineProps({
    icon: Array
})
</script>

<template>
    <div class="dropdown dropdown-left dropdown-hover">
        <div tabindex="0"
            role="button"
            class="btn btn-sm m-1">
            <FontAwesomeIcon v-if="icon" :icon="icon" />
        </div>
        <ul tabindex="-1"
            class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
            <li v-for="item in tableOptionProposta">
                <a :href="item.route">
                    <FontAwesomeIcon :icon="item.icon"
                        :class="item.colorIcon" />
                    {{ item.label }}
                </a>
            </li>
        </ul>
    </div>
</template>