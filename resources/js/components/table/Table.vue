<script setup lang="ts">
import Card from '../card/Card.vue';
import CardTitle from '../card/CardTitle.vue';
defineProps({
  title: String,
  icon: String,
})
</script>

<template>
  <Card>
    <div class=" card-title pt-6 pl-6 mb-2"
      v-if="title">
      <CardTitle :title="title"
        :icon="icon" />
    </div>

    <div class="pl-4">
      <slot name="prepend"></slot>
    </div>


    <div class="overflow-x-auto rounded-box bg-base-100 w-full">
      <table class="table table-sm md:table-md">

        <thead class="text-base-content">
          <slot name="thead"></slot>
        </thead>

        <tbody class="text-base-content">
          <slot name="tbody"></slot>
        </tbody>

      </table>
    </div>

    <div class="p-4">
      <slot name="append"></slot>
    </div>
  </Card>

</template>