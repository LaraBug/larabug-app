import {createApp, h} from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3'
import {InertiaProgress} from '@inertiajs/progress'
import Toast from "vue-toastification";
import 'charts.css/dist/charts.min.css'

InertiaProgress.init({
    delay: 250,
    color: '#5D87E6',
    includeCSS: true,
    showSpinner: false,
})

createInertiaApp({
    title: title => title ? `${title} - LaraBug` : 'LaraBug',
    resolve: (name) => import(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(Toast, {
                transition: "Vue-Toastification__fade",
                maxToasts: 5,
                newestOnTop: true,
                timeout: 5000,
            })
            .component('InertiaLink', Link)
            .component('InertiaHead', Head)
            .mixin({
                methods: { route }
            })
            .use(plugin)
            .mount(el)
    },
})
