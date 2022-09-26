<template>
  <v-card
      @mouseover="onHover"
      @mouseout="onLeave"
      class="mb-6 pa-4"
  >
    <v-card-actions
        class="d-flex justify-space-between"
    >
      <div class="card-header d-flex pb-0">
        <router-link class="project-link d-flex justify-space-between align-center" :to="{name: 'position-tracking-project-detail', params: {id: project.id}}">
          <h4 class="card-name" v-text="project.name"></h4>
          <v-dialog
              v-model="dialog"
              transition="dialog-top-transition"
              width="600"
          >
            <template v-slot:activator="{ attrs }">
              <v-icon
                  size="x-small"
                  class="pl-4"
                  v-bind="attrs"
                  @click.self.prevent="dialog = true"
              >mdi-pencil-outline</v-icon>
            </template>
            <seo-project-form :project="project" @input="onClose"></seo-project-form>
          </v-dialog>
        </router-link>
      </div>

      <v-menu location="left">
        <template v-slot:activator="{ props }">
          <v-btn
              width="30"
              size="small"
              v-bind="props"
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item>
            <v-list-item-action>
              <v-btn
                  @click="dialog = true"
              >
                <v-icon class="mr-2">mdi-pencil-outline</v-icon> Редактировать
              </v-btn>
            </v-list-item-action>
          </v-list-item>
          <v-list-item>
            <v-divider></v-divider>
          </v-list-item>
          <v-list-item>
            <v-list-item-action>
              <v-btn @click="deleteDialog = true">
                <v-icon
                    class="mr-2"
                >
                  mdi-delete
                </v-icon>
                Удалить проект</v-btn>
            </v-list-item-action>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-card-actions>
    <v-card-text
        class="d-flex justify-end card-body"
        v-if="project"
    >
      <v-col
          cols="1"
      >
        <div class="pb-1" v-text="project.d0Top1 + '%'"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.d1Top1"></div>
          <div class="diffvalue"
               :class="{
            'negative': project.changeTop1 < 0
               }"
               v-if="project.changeTop1 !== 0" v-text="project.changeTop1"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            color="black"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Top 1</span>
          </template>
          <span>Количество ключевых слов в ТОП1</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
      >
        <div class="pb-1" v-text="project.d0Top4 + '%'"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.d1Top4"></div>
          <div class="diffvalue"
               :class="{
            'negative': project.changeTop4 < 0
               }"
               v-if="project.changeTop4 !== 0" v-text="project.changeTop4"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            color="black"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Top 4</span>
          </template>
          <span>Количество ключевых слов в ТОП4</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
          class="text-center"
      >
        <div class="pb-1" v-text="project.d0Top12 + '%'"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.d1Top12"></div>
          <div class="diffvalue"
               :class="{
            'negative': project.changeTop12 < 0
               }"
               v-if="project.changeTop12 !== 0" v-text="project.changeTop12"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Top 12</span>
          </template>
          <span>Количество ключевых слов в ТОП12</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
          class="text-center"
      >
        <div class="pb-1" v-text="project.d0Top100 + '%'"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.d1Top100"></div>
          <div class="diffvalue"
               :class="{
            'negative': project.changeTop100 < 0
               }"
               v-if="project.changeTop100 !== 0" v-text="project.changeTop100"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Top 100</span>
          </template>
          <span>Количество ключевых слов в ТОП100</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
          class="text-center"
      >
        <div class="pt-1"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.d0AvgPos"></div>
          <div class="diffvalue"
               :class="{
            'negative': project.changeAvgPos < 0
               }"
               v-if="project.changeAvgPos !== 0" v-text="project.changeAvgPos"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            color="black"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Ср поз</span>
          </template>
          <span
          >Среднее арифметическое позиций всех ключевых слов</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
          class="text-center"
      >
        <div class="pt-1"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.d1FTotal"></div>
          <div class="diffvalue"
               :class="{
            'negative': project.changeTotal < 0
               }"
               v-if="project.changeTotal !== 0" v-text="project.changeTotal"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            color="black"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Всего</span>
          </template>
          <span
          >Суммарное количество ключевых слов с позициями / всего обработанных ключевых слов (позиции были сняты) за выбранный период на текущий момент времени</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
          class="text-center"
      >
        <div class="pt-1"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.wordCount"></div>
          <div class="diffvalue"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            color="black"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">Кл. слов</span>
          </template>
          <span
          >Количество всех ключевых слов, добавленные в проект</span>
        </v-tooltip>
      </v-col>

      <v-col
          cols="1"
          class="text-center"
      >
        <div class="pt-1"></div>
        <div class="mb-1 d-flex justify-space-between">
          <div class="value" v-text="project.skuCount"></div>
        </div>
        <v-tooltip
            location="top"
            width="200"
            class="text-center"
            color="black"
            transition="fade-transition"
        >
          <template v-slot:activator="{ props }"
          >
            <span v-bind="props">SKU</span>
          </template>
          <span
          >Количество SKU, добавленные в проект</span>
        </v-tooltip>
      </v-col>
    </v-card-text>
    <dialog-seo-project-delete
        :dialog="deleteDialog"
        :project-name="project.name"
        :id="project.id.toString()"
        @close="closeDelete"
    ></dialog-seo-project-delete>
  </v-card>
</template>

<script>
import { mapActions } from 'pinia'
import { useSeoProjectsStore } from "../store/index.js"
import SeoProjectForm from "./SeoProjectForm.vue"
import DialogSeoProjectDelete from "./DialogSeoProjectDelete.vue"

export default {
  name: 'PositionProjectListItem',
  components: {
    SeoProjectForm,
    DialogSeoProjectDelete
  },
  props: {
    project: {
      type: Object
    }
  },
  data: (props) =>  ({
    dialog: false,
    deleteDialog: false,
    name: props.project.name
  }),
  async mounted () {
    // await this.fetchSkus({
    //   id: this.project.id
    // })
  },
  methods: {
    setName (event) {
      this.name = event.target.value
    },
    closeDelete (value) {
      this.deleteDialog = value
    },
    onHover () {
      this.$el.classList.toggle('hover', true)
      // this.$el.classList.append('hover')
    },
    onLeave () {
      this.$el.classList.toggle('hover', false)
    },
    onClose (value) {
      this.dialog = value
    },
    ...mapActions(useSeoProjectsStore, ['updateProject', 'fetchSkus'])
  }
}
</script>

<style>
.project-link {
  text-decoration: none;
  font-weight: 300;
}
.card-name {
  color: #4285f4;
  border-bottom: 1px dashed #4285f4;
  font-weight: 300;
}
.project-link .v-icon {
  display: none;
}
.hover .v-icon {
  display: block;
}
.card-body .v-col div.mb-1 {
    display: flex;
    justify-content: center;
    align-items: center;
    line-height: 1;
    margin-bottom: 0!important;
}
.card-body .v-col div.mb-1 .value {
  font-size: 36px;
  font-weight: 300;
}
.card-body .v-col {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  padding: 0;
  max-width: 100%;
  flex: 0 0;
}
.card-body .v-col:not(:first-child) {
  padding-left: 40px;
}
.card-body .diffvalue {
  font-size: 13px;
  padding: 5px 6px;
  margin-left: 3px;
  vertical-align: text-top;
  background-color: rgba(54, 176, 87, 0.05);
  top: inherit;
}
.card-body .v-col > span{
  text-transform: uppercase;
  font-size: 11px;
  padding-top: 5px;
  color: #9d9d9d;
  white-space: nowrap;
}
.card-body .v-col .negative{
  background: rgba(235,87,87,.05);
  color: #eb5757;
}
.card-body .v-col .pb-1 {
  text-transform: uppercase;
  font-size: 11px;
  display: block;
  color: #9d9d9d;
}
.v-tooltip .v-overlay__content {
  background: #1a1a1a!important;
  font-size: 12px!important;
  text-align: center;
}
.v-list-item--density-default:not(.v-list-item--nav).v-list-item--one-line {
  padding-inline-start: 0;
  padding-inline-end: 0;
  min-height: auto;
}
.v-list-item-action a{
  padding-left: 19px;
  padding-right: 19px;
  display: block;
  width: 100%;
}
.v-overlay__content .v-list-item a:hover {
  background-color: #f5f5f5;
  color: #16181b;
  text-decoration: none;
}
.v-overlay__content .v-list-item a:active {
  color: #fff;
  text-decoration: none;
  background-color: #4285f4;
}
.divider {
  margin: 6px 0;
  border-color: #e3e3e3;
}
.v-dialog {
  align-items: flex-start!important;
}
.v-dialog .v-overlay__content {
  width: 100%!important;
}
.v-dialog .v-field__input {
  --v-input-control-height: 20;
  --v-field-padding-top: 3px;
  --v-field-padding-start: 0;
  --v-field-padding-bottom: 3px;
  --v-field-padding-end: 0;
}
</style>
