import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'

Nova.booting((Vue, router, store) => {
  Vue.component('vue-simplemde', VueSimplemde)

  router.addRoutes([
    {
      name: 'nova-newsletter',
      path: '/nova-newsletter',
      component: require('./components/Tool'),
    },
  ])
})
