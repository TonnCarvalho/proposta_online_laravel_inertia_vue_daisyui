<script setup>
import Navbar from './parts/AppLayout/Navbar.vue';
import Sidebar from './parts/AppLayout/Sidebar.vue';

</script>
<template>
  <div class="antialiased">

    <div class="drawer lg:drawer-open">
      <input id="my-drawer-3"
        type="checkbox"
        class="drawer-toggle" />
      <Sidebar />
      <div class="drawer-content bg-base-300">
        <Navbar />
        <div class="p-3">
          <slot />
        </div>
      </div>

    </div>
  </div>
</template>