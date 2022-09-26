<template>
  <div
      class="mb-2 bg-white pa-4"
  >
    <div class="d-flex justify-space-between align-content-start">
      <div class="card-header">Список проектов для отслеживания</div>
      <v-col
      >
        <v-row
            class="justify-end"
        >
          <v-col class="v-col search-container pa-0 justify-end d-flex pr-4" style="width:300px">
            <input type="text" class="form-control form-control-sm" @input="setFilter" width="300" placeholder="Строка для поиска">
          </v-col>
          <dialog-seo-project-sku-add>Добавить проект</dialog-seo-project-sku-add>
        </v-row>
      </v-col>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "pinia"
import { useSeoProjectsStore } from "../store/index.js"
import DialogSeoProjectSkuAdd from "./DialogSeoProjectSkuAdd.vue"

export default {
  name: "PositionTrackingToolbar",
  components: {
    DialogSeoProjectSkuAdd
  },
  data: () => ({
    dialogNew: false,
    projectName: '',
    projectUrl: '',
    projectKeywordsText: '',
    projectKeywords: []
  }),
  computed: {
    ...mapState(useSeoProjectsStore, ['sku', 'limits'])
  },
  methods: {
    setFilter (event) {
      this.setFilterByName(event.target.value)
    },
    async seekBySku () {
      const sku = this.projectUrl.match(/\d+/)
      if (sku) {
        await this.searchSku(sku.pop()).then(async (data) => {
          if (data) {
            await this.fetchWords(this.sku.sku).then(() => {
            })
          }
        })
      }
    },
    hasLimit: () => (this.limits.available < this.limits.use),
    ...mapActions(useSeoProjectsStore, ['setFilterByName', 'searchSku', 'resetSku', 'fetchLimits', 'fetchWords'])
  },
  watch: {
    sku () {
    },
    dialogNew (newValue, oldValue) {
      if (newValue) {
        this.fetchLimits()
        this.resetSku()
        this.projectUrl = ''
      }
    }
  }
}
</script>

<style scoped>
.card-header {
  font-size: 18px;
  font-weight: 300;
  border-bottom-width: 0;
  border-radius: 3px 3px 0 0;
  background-color: transparent;
}
input[type="search"] {
  outline-offset: -2px;
}
.form-control-sm {
  line-height: 1.6;
  font-size: 1rem;
  padding: 4px 12px;
}
.form-control {
  display: block;
  width: 100%;
  height: 3.692rem;
  padding: 0.7692rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.428571;
  color: #404040;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #d5d8de;
  border-radius: 2px;
  -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
  transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
.btn-add {
  box-shadow: inset 0 -1px 0 #288140;
  background-color: #36b057;
  border-color: #36b057;
  border-bottom-color: #288140;
  color: white;
  text-transform: none;
}
.v-input__control .v-field__input {
  min-height: 30px!important;
}
.search-container input[type="text"] {
  border: 1px solid #eee;
  outline: none;
  height: 30px;
  padding: 4px 12px;
  width: 300px;
  font-size: 13px;
}
.search-container input[type="text"]:focus {
  border-color: #4c8bf5;
}
</style>
