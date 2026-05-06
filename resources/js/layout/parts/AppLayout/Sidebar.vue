<script setup>

const menuitems = [
  { label: 'Propostas', icon: 'file-lines', route: '#' },
  { label: 'Propostas', icon: 'house', route: '#' },
  { label: 'Propostas', icon: 'house', route: '#' },
  { label: 'Propostas', icon: 'house', route: '#' },
  { label: 'Propostas', icon: 'house', route: '#' },
]

</script>

<template>
  <aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav"
    id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">

      <ul class="space-y-1">

        <li v-for="item in menuitems">
          <a href="#"
            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

            <FontAwesomeIcon :icon="['fas', item.icon]"
              class="text-white"
              size="lg" />

            <span class="ml-3">
              {{ item.label }}
            </span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
</template>