import '../css/app.css';
import { createApp, h, type DefineComponent } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

library.add(fas, far, fab);

createInertiaApp({
    title: (title) => `My App ${title}`,
    resolve: (name) => {
      
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', {
            eager: true,
        });

        const page = pages[`./pages/${name}.vue`];

        if (!page) throw new Error(`Page not found: ./pages/${name}.vue`);

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link)
            .component('FontAwesomeIcon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
        showSpinner: true,
    },
});
