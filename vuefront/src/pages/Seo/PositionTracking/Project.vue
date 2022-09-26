<template>
  <v-container fluid
       class="pa-6"
  >
    <v-card
        class="mb-2"
        v-if="!loading"
        :loading="loading"
    >
      <v-card-actions>
        <v-row
            class="d-flex justify-space-between"
        >
          <v-col
              class="d-flex justify-space-between ml-3 mr-3 al-center"
          >
            <router-link
                :to="{ name: 'position-tracking-projects' }"
                class="text-decoration-none ham-ico"
            >
              <v-icon
              >mdi-menu</v-icon>
            </router-link>

            <v-select
                v-if="project"
                class="select-project"
                hide-details="true"
                solo
                :items="projectList"
                item-title="text"
                item-value="value"
                height="30"
                :model-value="project.id"
                @update:modelValue="openProject"
            ></v-select>

            <v-btn-toggle
                v-model="skuView"
                mandatory
            >
              <v-btn
                  height="30"
                  width="30"
              >
                <v-icon
                    width="30"
                >mdi-arrow-collapse-vertical</v-icon>
              </v-btn>
              <v-btn
                  height="30"
                  width="30"
              >
                <v-icon
                    width="30"
                >mdi-arrow-expand-vertical</v-icon>
              </v-btn>
            </v-btn-toggle>

            <datepicker
                height="30"
                v-model="dates"
                ref="calendar"
                locale="ru"
                modelType="dd.MM.yyyy"
                @internalModelChange="onDatesChange"
                range
                autoApply
            ></datepicker>

            <v-select
                :items="intervalTypes"
                item-title="text"
                item-value="id"
                label="Период"
                class="select-interval"
                hide-details="true"
                @update:modelValue="onIntervalChange"
            ></v-select>
          </v-col>
          <v-col
              class="d-flex ml-3 mr-3 justify-end align-center"
          >
            <input type="text" class="search-input">
            <v-col
                cols="3"
            >
              <dialog-seo-sku-add>Добавить SKU</dialog-seo-sku-add>
            </v-col>
            <v-btn
                width="30"
                height="30"
                class="export-xls"
                @click="downloadReport"
            >
              <v-icon
                  width="30"
                  height="30"
              >mdi-file-excel-outline</v-icon>
            </v-btn>
            <v-menu
                location="left"
            >
              <template v-slot:activator="{ props }">
                <v-btn
                    width="30"
                    height="30"
                    v-bind="props"
                >
                  <v-icon
                      width="30"
                      height="30"
                  >mdi-dots-vertical</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item-action>
                  <v-btn
                      @click="dialog = true"
                  >
                    <v-icon class="mr-2">mdi-pencil-outline</v-icon> Редактировать название проекта
                  </v-btn>
                </v-list-item-action>
                <v-list-item-action>
                  <v-divider></v-divider>
                </v-list-item-action>
                <v-list-item-action>
                  <v-btn
                      @click="deleteDialog = true"
                  >
                  <v-icon class="mr-2">mdi-delete</v-icon>Удалить проект
                  </v-btn>
                </v-list-item-action>
              </v-list>
            </v-menu>
          </v-col>
        </v-row>
      </v-card-actions>
    </v-card>
    <div class="card-content"
         v-if="!loading"
    >
    <sku-details-item
        v-if="skus && skus.length"
        :loading="loading"
        :skus="skus"
        :item="item"
    ></sku-details-item>
      <div class="card py-8"
           v-else
      >
        <div class="card-body">
          <div class="d-flex flex-column justify-content-center align-items-center align-center">
            <svg data-v-0e253256="" viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="table" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-table text-secondary b-icon bi" style="opacity: 0.3; font-size: 500%;"><g data-v-0e253256=""><path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"></path></g></svg>
            <h4 class="my-4">Данные отсутствуют</h4>
            <dialog-seo-sku-add icon="''">Добавить SKU</dialog-seo-sku-add>
          </div>
        </div>
      </div>
    </div>
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
    <v-dialog
        v-model="dialog"
        transition="dialog-top-transition"
        width="600"
    >
    <seo-project-form @input="onDialog" v-if="!loading" v-model="dialog" :project="project" :id="project.id"></seo-project-form>
    </v-dialog>
    <v-dialog
        v-model="deleteDialog"
        transition="dialog-top-transition"
        width="600"
    >
      <dialog-seo-project-delete
          v-if="project.id"
          :dialog="deleteDialog"
          :project-name="project.name"
          :id="project.id"
          @delete="onDelete"
          @close="closeDelete"
      ></dialog-seo-project-delete>
    </v-dialog>
  </v-container>
</template>
<script>
import { mapActions, mapState } from "pinia"
import { useSeoProjectsStore } from "../../../store/index.js"
import DialogSeoSkuAdd from "../../../components/DialogSeoSkuAdd.vue"
import SeoProjectForm from "../../../components/SeoProjectForm.vue"
import SkuDetailsItem from "../../../components/SkuDetailsItem.vue"
import DialogSeoProjectDelete from "../../../components/DialogSeoProjectDelete.vue"

export default {
  name: 'SeoProject',
  components: {
    DialogSeoSkuAdd,
    SeoProjectForm,
    SkuDetailsItem,
    DialogSeoProjectDelete
  },

  data: () => ({
    loading: true,
    expanded: true,
    skuView: 0,
    dates: [],
    dialog: false,
    deleteDialog: false,
    intervalTypes: [
      {text: '7 дней', id: 7},
      {text: '14 дней', id: 14},
      {text: '30 дней', id: 30}
    ]
  }),
  computed: {
    projectList () {
      return this.projects.map((item) => {
        return { text: item.name, value: item.id }
      })
    },
    project () {
      let filtered = []
      let singleProject
      let that = this
      // filtered = this.projects.filter((project) => {
      //   let result = parseInt(project.id) === parseInt(that.$route.params.id)
      //   console.log('compare', result)
      //   return result
      // })
      this.projects.forEach((project) => {
        let neq = parseInt(project.id) !== parseInt(that.$route.params.id)
        if (neq) return
        filtered.push(project)
        singleProject = project
      })

      // const id = singleProject.id
      // const name = singleProject.name
      const { id, name } = singleProject
      return { id, name }
    },
    ...mapState(useSeoProjectsStore, ['projects', 'skus'])
  },
  methods: {
    onDelete (value) {
      if (value) this.$router.push({name: 'position-tracking-projects'})
    },
    onDialog (value) {
      this.dialog = value
    },
    closeDelete () {
      this.deleteDialog = false
    },
    onIntervalChange (event) {
    },
    onDatesChange (event) {
      this.$refs.calendar.$el.classList.toggle('active__data', (event && event.length > 1))
    },
    openProject (id) {
      this.$router.push({name: 'position-tracking-project-detail', params: {id}})
    },
    async loadSkus (params) {
      await this.fetchSkus(params).then((response) => {
        this.loading = false
      })
    },
    async downloadReport () {
      await this.fetchProjectReport(this.project.id).then((response) => {
      })
    },
    ...mapActions(useSeoProjectsStore, ['fetchProjects', 'fetchSkus', 'fetchProjectReport', 'setSkuView'])
  },
  async mounted () {
    await this.fetchProjects().then((response) => {
      this.loading = false
    })
    await this.loadSkus({id: this.$route.params.id})
  },
  watch: {
    dates (value) {
      this.loading = true
      this.loadSkus({id: this.$route.params.id, d1: value[0], d2: value[1]}).then(() => {
        this.loading = false
      })
    },
    skuView (value) {
      this.setSkuView(value)
    }
  },
  created () {
    this.$watch(
        () => this.$route.params,
        (toParams) => {
          this.loading = true
          if (toParams.length > 0)
          {
            this.loadSkus(toParams)
          }
        }
    )
  }
}
</script>

<style>
.select-project .v-input__control {
  width: 135px;
}
.v-input__control {
  color: #4285f4;
  border: 1px solid #4285f4;
}
.v-select .v-field .v-field__input {
  padding-top: 0;
  padding-bottom: 0;
  height: 30px;
  align-items: center;
  min-height: 0;
  padding-left: 10px;
}
.v-field .v-field__append-inner {
  padding-top: 0;
  align-items: center;
}
.v-field.v-field--variant-filled .v-field__overlay {
  background-color: #fff;
}
.v-field .v-select__selection-text {
  font-size: 13px;
}
.v-field .v-field__outline {
  --v-field-border-width: 0;
  --v-field-border-opacity: 0;
  display: none;
}
.v-field.v-field--appended {
  padding-inline-end: 0;
}
.ham-ico {
  margin-right: 5px;
  border: 1px solid #4285f4;
  height: 30px;
  padding: 0 10px;
  padding-top: 2px;
}
.ham-ico:hover {
  color: #fff;
  background: #4285f4;
}
.select-project .v-field__input:hover {
  background: #4285f4;
  color: #fff;
}
.al-center {
  align-items: center;
}
.v-btn-group {
  border: 1px solid #dbdbdb;
}
.v-btn-group .v-btn {
  min-width: 30px;
  padding: 0;
  margin: 0;
  margin-inline-start: 0!important;
}
.v-btn-group .v-btn:nth-child(1) {
  border-right: 1px solid #dbdbdb;
}
.v-btn-group--density-default.v-btn-group {
  height: auto;
  margin-right: 10px;
}
.v-btn--selected {
  background: #e3e3e3;
}
.active__data .dp__pointer {
  background: #e3e3e3;
}
.v-field__field .v-label:nth-child(2) {
  font-size: 12px;
  top: 7px;
}
/*.v-field .v-label.v-field-label--floating {*/
/*  visibility: visible;*/
/*}*/
/*.v-field.v-field--active .v-label.v-field-label--floating {*/
/*  visibility: hidden!important;*/
/*}*/
.v-field--has-label .v-field__input:hover {
  background: transparent;
  color: #4285f4;
}
.dp__main {
  margin-right: 10px;
}
.select-interval .v-select__selection {
  width: 100%;
  background: #fff;
}
</style>
