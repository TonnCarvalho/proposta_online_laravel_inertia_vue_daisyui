<script setup>
import Navbar from './parts/AppLayout/Navbar.vue';
import Sidebar from './parts/AppLayout/Sidebar.vue';

</script>
<template>
  <div class="antialiased">
    <Navbar />

    <!-- Sidebar -->
    <Sidebar />


    <main class="p-4 md:ml-64 h-auto pt-20">
      <slot />
    </main>
  </div>
</template>