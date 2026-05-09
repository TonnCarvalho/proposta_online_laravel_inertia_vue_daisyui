<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
  icon: String,
  title: String,
})
</script>

<template>

  <div class="mt-5 card border border-base-content/20">
    <div class="card-title text-neutral p-3 flex items-center gap-1">
      <FontAwesomeIcon :icon="['fas', icon]" />
      {{ title }}
    </div>

    <div class="overflow-x-auto border-t border-base-content/20">

      <table class="table">

        <thead>
          <slot name="thead"></slot>
        </thead>

        <tbody>
          <slot name="tbody"></slot>
        </tbody>

      </table>
    </div>
  </div>
</template>