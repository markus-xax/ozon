<template>
  <div class="projects-list">
    <position-project-list-item
        v-if="!loading"
        v-for="(project, idx) of projectsFiltered"
        :key="idx"
        :project="project"
    ></position-project-list-item>
    <div
        v-for="(n, i) in 3"
        :key="i"
        v-else
        class="skeletor__card mb-5 bg-white pa-3 v-col">
      <skeletor class="mb-3" width="40%"></skeletor>
      <skeletor class="mb-3" width="65%"></skeletor>
      <skeletor class="mb-3" width="60%"></skeletor>
      <skeletor class="mb-3" width="60%"></skeletor>
      <skeletor class="mb-3" width="80%"></skeletor>
      <skeletor width="30%"></skeletor>
    </div>
  </div>
</template>

<script>
import { useTheme } from 'vuetify'
import { useSeoProjectsStore } from "../store/index.js"
import { mapActions, mapState } from 'pinia'
import PositionProjectListItem from '../components/PositionProjectListItem.vue'
export default {
  name: "PositionProjectsList",
  components: {
    PositionProjectListItem
  },
  data: () => ({
    loading: true
  }),
  methods: {
    ...mapActions(useSeoProjectsStore, ['fetchProjects'])
  },
  computed: {
    projectsFiltered () {
      let that = this
      return this.projects.filter((item) => {
        return (!that.filter.name ? true : item.name.includes(that.filter.name))
      })
    },
    ...mapState(useSeoProjectsStore, ['projects', 'filter'])
  },
  async mounted () {
    this.loading = true
    const result = await this.fetchProjects()
        .then((data) => {
          setTimeout(() => {
          this.loading = false
          }, 0)
        })
  }
}
</script>

<style scoped>

</style>
