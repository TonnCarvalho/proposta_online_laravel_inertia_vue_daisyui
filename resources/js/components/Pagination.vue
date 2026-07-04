<script setup lang="ts">
import { computed } from 'vue';

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Paginator {
    current_page: number;
    last_page: number;
    links: PaginationLink[];
}

const props = defineProps<{
    paginator?: Paginator;
}>();

const visibleLinks = computed(() => {
    const links = props.paginator?.links ?? [];
    const currentPage = props.paginator?.current_page ?? 1;
    const lastPage = props.paginator?.last_page ?? 1;
    const pagesToShow = 10;

    return links.filter((link) => {
        if (link.label.includes('Previous') || link.label.includes('Next')) {
            return true;
        }

        const page = Number(link.label);

        if (Number.isNaN(page)) {
            return false;
        }

        const firstPage = Math.max(
            1,
            Math.min(currentPage - Math.floor(pagesToShow / 2), lastPage - pagesToShow + 1),
        );
        const lastVisiblePage = Math.min(lastPage, firstPage + pagesToShow - 1);

        return page >= firstPage && page <= lastVisiblePage;
    });
});

const makeLabel = (label: string) => {
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
            <div v-for="(link, index) in visibleLinks"
                :key="index">
                <component :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    class="join-item btn "
                    :class="{
                        'hover:btn-primary': link.url,
                        'text-zinc-400': !link.url,
                        'join-item btn btn-primary': link.active,
                    }">
                    {{ makeLabel(link.label) }}
                </component>
            </div>
        </div>
    </div>

</template>
