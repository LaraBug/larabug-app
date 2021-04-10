import {createApp, h} from 'vue'
import {app, plugin} from '@inertiajs/inertia-vue3'
import {InertiaProgress} from '@inertiajs/progress'
import Toast from "vue-toastification";

InertiaProgress.init({
    delay: 250,
    color: '#5D87E6',
    includeCSS: true,
    showSpinner: false,
})

const el = document.getElementById('app')

const vueApp = createApp({
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - LaraBug` : 'LaraBug'
    },
    render: () =>
        h(app, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
        }),

})
    .use(plugin)
    .use(Toast, {
        transition: "Vue-Toastification__fade",
        maxToasts: 5,
        newestOnTop: true,
        timeout: 5000,
    });

vueApp.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    },
});

vueApp.mount(el);