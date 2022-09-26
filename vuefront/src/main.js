import { createApp, defineComponent } from 'vue'
import axios from 'axios'
import App from './App.vue'
import { loadFonts } from './plugins/webfontloader'
import { createPinia } from 'pinia'
import VueAxios from "vue-axios"
import router from './router'
import vuetify from "./plugins/vuetify.js"
import { Skeletor } from 'vue-skeletor'
import Datepicker from '@vuepic/vue-datepicker'
let datePicker = defineComponent(Datepicker)
import './style.css'
import '@vuepic/vue-datepicker/dist/main.css'
import 'vue-skeletor/dist/vue-skeletor.css'
import snotify from 'vue3-snotify'
import 'vue3-snotify/style'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

loadFonts()

const mount = async (el) => {
    let root = document.querySelector(el)
    let { module } = root.dataset

    const app = createApp(App, {
        module
    })
    app.config.devtools = true
    app.use(VueAxios, axios)
    app.use(createPinia())
    app.use(vuetify)

    app.use(snotify, {
        position: 'rightTop'
    })
    app.component('skeletor', defineComponent(Skeletor))
    // app.component('layout-auth', layoutAuth)
    // app.component('layout-default', layoutDefault)
    app.component('datepicker', datePicker)
    const requireComponent = import.meta.glob(
        './views/**/*.vue'
    )

    let moduleRouter = import.meta.glob('./router/**/index.js')
    let exactRouter
    Object.keys(moduleRouter).map((inc) => {
        let moduleOrigin = module.replaceAll('-', '').toLowerCase()
        let matchedModule = inc.split('/').at(-2)
        if (moduleOrigin === matchedModule.toLowerCase()) {
            exactRouter = matchedModule
        }
    })

    for (const fileName of Object.keys(requireComponent)) {
        const componentName = upperFirst(
            camelCase(
                fileName
                    .split('/')
                    .pop()
                    .replace(/\.\w+$/, '')
            )
        )

        if (exactRouter && exactRouter === componentName) {
            let { routes } = await import(`./router/${exactRouter}/index.js`)

            routes.forEach((route) => {
                router.addRoute(route)
            })
        }

        let component = await import(`./views/${componentName}.vue`)

        app.use(router)
        app.component(componentName, component.default)
    }

    app.mount(el)
}

mount('#app')
