<script setup>
import logo from '@/assets/images/logo.png';
import {
  FileText,
  FilePlusCorner,
  HatGlasses,
} from '@lucide/vue';

const icons = {
  FileText,
  FilePlusCorner,
  HatGlasses,
}
const menuitems = [
  {
    label: 'Propostas',
    icon: 'FileText',
    route: route('proposta.index'),
    component: ['proposta/Index',
      'proposta/Editar']
  },
  {
    label: 'Criar Proposta',
    icon: 'FilePlusCorner',
    route: route('pesquisaCpfCadastro.index'),
    component: ['associado/pesquisaCpfCadastro/PesquisaCpfCadastro',
      'proposta/Criar']
  },
  {
    label: 'Acompanhamento',
    icon: 'HatGlasses',
    route: route('acompanhamento.index'),
    component: ['acompanhamento']
  },
]

</script>

<template>
  <div class="drawer-side">
    <label for="my-drawer-3"
      aria-label="close sidebar"
      class="drawer-overlay">
    </label>
    <div class="bg-base-100 min-h-full w-60 border-r border-r-base-content/20">

      <img :src="logo"
        class="w-full h-16 p-1">

      <ul class="menu w-full mt-3">

        <li v-for="item in menuitems">

          <Link :href="item.route"
            class="p-2 text-base"
            :class="{ 'bg-primary text-white': item.component.includes($page.component) }">
          <component :is="icons[item.icon]"
            size="23" />

          {{ item.label }}
          </Link>

        </li>

      </ul>
    </div>
  </div>
</template>