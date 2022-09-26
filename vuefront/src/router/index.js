import {
    createWebHashHistory,
    createRouter
} from 'vue-router'

// import { routes } from './SeoPositionTracking'

// console.log(routes)

// const routes = [
//     // {
//     //     path: '/login',
//     //     name: 'login',
//     //     component: () => import('../pages/Login.vue'),
//     //     meta: {
//     //         layout: 'layout-auth'
//     //     }
//     // },
//     // {
//     //     path: '/',
//     //     name: 'default',
//     //     meta: {
//     //         auth: false
//     //     },
//     //     // redirect: { name: 'position-tracking-projects' }
//     // },
//     {
//         path: '/',
//         name: 'position-tracking-projects',
//         component: () => import('../pages/Seo/PositionTracking/Projects.vue'),
//         meta: {
//             auth: false,
//             layout: 'layout-default'
//         }
//     },
//     {
//         path: '/project/:id',
//         name: 'position-tracking-project-detail',
//         component: () => import('../pages/Seo/PositionTracking/Project.vue'),
//         meta: {
//             auth: false,
//             layout: 'layout-default'
//         }
//     },
//     {
//         path: '/project/:id/item/:itemId',
//         name: 'position-tracking-sku-detail',
//         component: () => import('../pages/Seo/PositionTracking/Sku.vue'),
//         meta: {
//             auth: false,
//             layout: 'layout-default'
//         }
//     },
//     {
//         path: '/:pathMatch(.*)*',
//         name: 'errorPage',
//         component: () => import('../pages/Error.vue'),
//         meta: {
//             layout: 'layout-default'
//         }
//     }
// ]

export const router = createRouter({
    history: createWebHashHistory(),
    routes: []
})

export default router
