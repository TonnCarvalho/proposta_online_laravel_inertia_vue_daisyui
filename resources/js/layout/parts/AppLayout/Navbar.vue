<script setup>
import logo from '@/assets/images/logo.png';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { ref, onMounted } from 'vue';

const menuDropdown = [
    { label: 'Perfil', icon: 'user-gear', route: '' },
]
const theme = ref('light');

const toggleTheme = () => {
    theme.value =
        theme.value === 'light'
            ? 'dark'
            : 'light';

    document.documentElement.setAttribute(
        'data-theme',
        theme.value
    );

    localStorage.setItem('theme', theme.value);
};

onMounted(() => {
    theme.value =
        localStorage.getItem('theme') || 'light';

    document.documentElement.setAttribute(
        'data-theme',
        theme.value
    );
});
</script>

<template>
    <div class="navbar border-b border-b-base-content/20 bg-base-100">
        <div class="flex-none lg:hidden">
            <label for="my-drawer-3"
                class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="inline-block h-5 w-5 stroke-current">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
        </div>
        <div class="flex-1 ms-2">
            <img class="lg:hidden w-40 "
                :src="logo">
        </div>
        <div class="flex gap-2">

            <button @click="toggleTheme"
                class="btn btn-circle btn-ghost">
                <span v-if="theme === 'light'">
                    <FontAwesomeIcon icon="sun" />
                </span>
                <span v-if="theme === 'dark'">
                    <FontAwesomeIcon icon="moon" />
                </span>
            </button>

            <div class="dropdown dropdown-end">
                <div tabindex="0"
                    role="button"
                    class="btn btn-ghost p-1">
                    <div class="w-10 rounded-full">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-content text-base-100 w-10 rounded-full">
                                <span class="text-xl ">CC</span>
                            </div>
                        </div>

                    </div>
                    <span class="text-sm">Cleiton</span>
                </div>
                <ul tabindex="-1"
                    class="menu dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li v-for="item in menuDropdown">
                        <Link>
                        <FontAwesomeIcon :icon="item.icon" />
                        {{ item.label }}
                        </Link>
                    </li>
                    <li>
                        <a class="text-error">
                            <FontAwesomeIcon icon="arrow-right-from-bracket" />
                            Sair
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>