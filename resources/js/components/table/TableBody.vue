<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
  icon: String,
  title: String,
  tHead: {
    type: Array,
    default: []
  },
  tBody: {
    type: Array,
    default: []
  },
})
</script>

<template>

  <div class="mt-5 card border border-base-content/20">
    <div class="card-title text-primary p-3 flex items-center gap-1">
      <FontAwesomeIcon :icon="['fas', icon]" />
      {{ title }}
    </div>

    <div class="overflow-x-auto border-t border-base-content/20">

      <table class="table">

        <thead>
          <tr class="bg-base-content/5">
            <th class="font-bold text-black"
              v-for="item in props.tHead">
              {{ item }}
            </th>
          </tr>
        </thead>

        <tbody>
          <tr class="hover:bg-base-300">
            <td>Cy Ganderton</td>
            <td>Quality Control Specialist</td>
            <td>Blue</td>
          </tr>
        </tbody>

      </table>
    </div>
  </div>
</template>