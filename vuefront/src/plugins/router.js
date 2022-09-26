import {
    createWebHashHistory,
    createRouter
} from 'vue-router'

import {
    mapActions,
    mapState
} from 'pinia'
import { useSecurityStore } from "../store/index.js";

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import('../pages/Login.vue'),
        meta: {
            layout: 'layout-auth'
        }
    },
    {
        path: '/',
        name: 'default',
        meta: {
            auth: false
        },
        redirect: { name: 'position-tracking-projects' }
    },
    {
        path: '/projects',
        name: 'position-tracking-projects',
        component: () => import('../pages/Seo/PositionTracking/Projects.vue'),
        meta: {
            auth: false,
            layout: 'layout-default'
        }
    },
    {
        path: '/project/:id',
        name: 'position-tracking-project-detail',
        component: () => import('../pages/Seo/PositionTracking/Project.vue'),
        meta: {
            auth: false,
            layout: 'layout-default'
        }
    },
    {
        path: '/project/:id/item/:itemId',
        name: 'position-tracking-sku-detail',
        component: () => import('../pages/Seo/PositionTracking/Sku.vue'),
        meta: {
            auth: false,
            layout: 'layout-default'
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'errorPage',
        component: () => import('../pages/Error.vue'),
        meta: {
            layout: 'layout-default'
        }
    }
]

export const router = createRouter({
    history: createWebHashHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const getAuth = () => mapActions(useSecurityStore, ['getAuth'])
    // console.log(this.$http)
    const requireAuth = to.matched.some(record => record.meta.auth)
    if (requireAuth) {
        next('/login')
    }

    next()
})

export default router
