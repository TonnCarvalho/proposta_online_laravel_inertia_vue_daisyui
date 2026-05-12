<script setup>
defineProps({
    paginator: Object
})

const makeLabel = (label) => {
    if (label.includes("Previous")) {
        return "<<";
    } else if (label.includes("Next")) {
        return ">>";
    } else {
        return label;
    }
};

</script>
<template>

    <div class="flex justify-between items-start mt-5">

        <div class="join">
            <div v-for="(link, index) in paginator.links"
                :key="link.index">
                <component :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makeLabel(link.label)"
                    class="join-item btn "
                    :class="{
                        'hover:btn-primary': link.url,
                        'text-zinc-400': !link.url,
                        'join-item btn btn-primary': link.active,
                    }" />
            </div>
        </div>

        <p class="text-zinc-400 text-sm">
            Mostrando de {{ paginator.from }} a {{ paginator.to }} de {{ paginator.total }} resultados
        </p>
    </div>

</template>