<script setup>
import logo from '@/assets/images/logo.png';
import {
  FileText,
  FilePlusCorner,
  HatGlasses,
  Circle,
} from '@lucide/vue';

const icons = {
  FileText,
  FilePlusCorner,
  HatGlasses,
  Circle,
}
const menuitems = [
  {
    label: 'Propostas',
    icon: 'FileText',
    subMenu: false,
    route: route('proposta.index'),
    component: ['proposta/Index',
      'proposta/Editar']
  },
  {
    label: 'Criar Proposta',
    icon: 'FilePlusCorner',
    subMenu: false,
    route: route('pesquisaCpfCadastro.index'),
    component: ['associado/pesquisaCpfCadastro/PesquisaCpfCadastro',
      'proposta/Criar']
  },
  {
    label: 'Acompanhamento',
    icon: 'HatGlasses',
    subMenu: false,
    route: route('acompanhamento.index'),
    component: ['acompanhamento/Index']
  },
  {
    label: 'ClickSign',
    icon: 'Circle',
    subMenu: true,
    subMenuItem: [
      {
        label: 'Enviar',
        routeSub: route('clicksign.enviar'),
        component: ['clicksign/enviar/Enviar']
      },
      {
        label: 'Enviadas',
        routeSub: route('clicksign.enviadas'),
        component: ['clicksign/enviadas/Enviadas']
      },
    ],
    route: null,
    component: ['clicksign']
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
            v-if="!item.subMenu"
            class="p-2 text-base"
            :class="{ 'bg-primary/15 text-primary': item.component.includes($page.component) }">
          <component :is="icons[item.icon]"
            size="23" />

          {{ item.label }}
          </Link>

          <details v-if="item.subMenu"
            :open="$page.component.includes(item.component)">
            <summary class="p-2 text-base"
              :class="{ 'bg-primary/15 text-primary': $page.component.includes(item.component) }">
              <component :is="icons[item.icon]"
                size="23" />
              {{ item.label }}
            </summary>
            <ul>
              <li v-for="subMenuitem in item.subMenuItem">
                <Link :href="subMenuitem.routeSub"
                  :class="{ 'bg-primary/15 text-primary': subMenuitem.component.includes($page.component) }">
                {{ subMenuitem.label }}
                </Link>
              </li>
            </ul>
          </details>

        </li>
      </ul>
    </div>
  </div>
</template>