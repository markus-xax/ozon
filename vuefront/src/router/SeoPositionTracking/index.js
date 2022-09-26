import Projects from '../../pages/Seo/PositionTracking/Projects.vue'
import Project from '../../pages/Seo/PositionTracking/Project.vue'

export const routes = [
    {
        name: 'position-tracking-projects',
        path: '/',
        component: Projects
    },
    {
        name: 'position-tracking-project-detail',
        path: '/project/:id',
        component: Project
    },
    {
        name: 'position-tracking-sku-detail',
        path: '/project/:id/sku/:itemId'
    }
]

export default routes
