<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
  icon: String,
  title: String,
})
</script>

<template>
  <section>
    <div class="border border-base-content/20 rounded-t-lg card-title p-3">
      <FontAwesomeIcon :icon="['fas', icon]" />
      {{ title }}
    </div>

    <div class="overflow-x-auto border-x border-b border-base-content/20 rounded-b-lg">

      <table class="table">

        <thead>
          <slot name="thead"></slot>
        </thead>

        <tbody>
          <slot name="tbody"></slot>
        </tbody>

      </table>
    </div>
  </section>

</template>