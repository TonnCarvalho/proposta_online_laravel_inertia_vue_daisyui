<script setup>
import Navbar from './parts/AppLayout/Navbar.vue';
import Sidebar from './parts/AppLayout/Sidebar.vue';

</script>
<template>
  <div class="antialiased">
    <!-- <Navbar /> -->
    <div class="drawer lg:drawer-open">
      <input id="my-drawer-3"
        type="checkbox"
        class="drawer-toggle" />

      <div class="drawer-content p-3">
        <slot />
      </div>
      
      <Sidebar />
    </div>
  </div>
</template>