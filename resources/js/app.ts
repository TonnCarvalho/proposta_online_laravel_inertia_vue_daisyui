import '../css/app.css'
import { createApp, h, type DefineComponent } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

// import Main from './layouts/main.vue'

createInertiaApp({
  title: (title) => `My App ${title}`,
  resolve: (name) => {
    const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', { eager: true })
    const page = pages[`./pages/${name}.vue`]

    page.default.layout = page.default.layout

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component('Head', Head)
      .component('Link', Link)
      .mount(el)
    },
  progress: {
    color: '#4B5563',
    showSpinner: true,
  },
})