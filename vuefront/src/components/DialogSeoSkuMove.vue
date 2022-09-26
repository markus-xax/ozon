<template>
  <v-dialog
      width="600"
      transition="dialog-top-transition"
      v-model="dialog"
  >
    <v-card type="danger">
      <v-toolbar
          color="primary"
          class="px-0"
          dark
      >
        <v-toolbar-title>Перенести SKU в другой проект?</v-toolbar-title>
        <v-btn
            class="mr-0 pr-0"
            @click="dialog = false"
            width="30"
            height="30"
        >
          <v-icon>
            mdi-close
          </v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text
          class="pa-5 pt-8"
          v-if="!bCreate"
      >
        <p>Список проектов:</p>
        <input type="text" @input="setFilter" placeholder="Введите строку для поиска" class="form-control form-control-xs mb-1 w-100 mb-1 pa-1">
        <select
            size="7"
            @change="setProject"
            class="select-border pa-3 pt-1 w-100 form-control form-control-sm"
            ref="projectList"
            @dblclick="onCloseDialog"
        >
          <option
              v-for="(project, idx) of otherProjects"
              :key="idx"
              :value="project.id" v-text="project.name"></option>
        </select>
        <!-- <v-select
            :items="otherProjects"
            item-title="name"
            item-value="id"
            @update:modelValue="setProject"
        >
        </v-select> -->
        <a class="text-grey dashed" @click="bCreate = true" href="javascript:void(0)">Или создать новый проект</a>
      </v-card-text>
      <v-card-text
          v-else
          class="left-label-input  pa-5 pt-8 "

      ><div
        class="py-3 d-flex align-center"
      >
        <span class="mr-4">Имя проекта</span>
        <input class="px-3" type="text" v-model="projectName">
      </div>

      </v-card-text>
      <v-card-actions
          class="justify-end pa-5"
      >
        <v-btn
            class="border-btn"
            @click="onCloseDialog">
          Отмена
        </v-btn>
        <v-btn
            type="danger"
            color="bg-danger"
            class="bg-primary"
            @click="onConfirmDialog"
            :disabled="loading"
        >{{ btnText }}</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import {useSeoProjectsStore} from "../store/index.js"
import {mapActions, mapState} from "pinia"

export default {
  name: "DialogSeoSkuMove",
  data: () => ({
    affected: false,
    bCreate: false,
    projectName: '',
    loading: false,
    project: 0,
    filter: ''
  }),
  props: {
    skuName: {
      type: String
    },
    projectId: {
      type: String
    },
    id: {
      type: Number
    },
    dialog: {
      type: Boolean
    }
  },
  watch: {
    dialog (newValue, oldValue) {
      if (newValue) {
        this.fetchProjects()
      }
      if(! newValue) {
        this.bCreate = false
        this.onCloseDialog()
      }
    },
    project (newValue, oldValue) {
    }
  },
  computed: {
    btnText () {
      return this.bCreate ? 'Создать и перенести' : 'Перенести'
    },
    otherProjects () {
      let that = this

      let filtered = this.projects.filter((project) => {
        console.log('otherProjects', that.filter)
        console.log('project', project)
        if (that.filter) {
          return (
              project.name.indexOf(that.filter) >= 0
              &&
              parseInt(project.id) !== that.projectId
          )
        }

        return parseInt(project.id) !== that.projectId
      })

      return filtered
    },
    ...mapState(useSeoProjectsStore, ['projects'])
  },
  emits: ['close'],
  methods: {
    setFilter (event) {
      this.filter = event.target.value
    },
    setProject (value) {
      this.project = value
    },
    onCloseDialog () {
      this.$emit('close', false)
    },
    async onConfirmDialog () {
      this.loading = true
      let that = this
      let projectId
      if (this.bCreate) {
        await this.createProject(this.projectName).then((response) => {
          if (response.data.status === 201) {
            return response.data.result.id
          }
        }).then((id) => {
          projectId = id
        })
      } else {
        projectId = this.$refs.projectList.value
      }

      return await this.moveSku(this.id, projectId).then((response) => {
        const { data } = response
        if (data.status >= 400) {
          that.$snotify.error(data.error)
        } else {
          that.$snotify.success('Товар перемещен')
          this.$emit('close', false)
        }

        this.loading = false
        return response
      }).then((response) => {
        this.fetchSkus({id: this.projectId})
      })
    },
    ...mapActions(useSeoProjectsStore, ['updateSku', 'fetchProjects', 'fetchSkus', 'createProject', 'moveSku'])
  }
}
</script>

<style scoped>

</style>
