<script setup>
import Navbar from './Navbar.vue';


const menuitems = [
  { label: 'Propostas', icon: 'file-lines', route: route('proposta.index'), url: '/proposta' },
  { label: 'Criar Proposta', icon: 'file-circle-plus', route: '' },
]

const logoSidebar = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5czazbk9CodNkCmnH6H7ReSnnIYRvUvkq5Q&s';
</script>

<template>
  <div class="drawer-side">
    <label for="my-drawer-3"
      aria-label="close sidebar"
      class="drawer-overlay">
    </label>
    <div class="bg-base-200 min-h-full w-60 border-r border-r-base-content/20">
      <img :src="logoSidebar"
        class="w-full h-25 p-1">
      <ul class="menu w-full mt-3">
        <li v-for="item in menuitems">
          <Link :href="item.route"
            class="p-2 text-base"
            :class="{ 'bg-primary text-white': $page.url === item.url }">
          <FontAwesomeIcon :icon="['fas', item.icon]"
            size="lg" />
          {{ item.label }}
          </Link>
        </li>
      </ul>
    </div>
  </div>
</template>