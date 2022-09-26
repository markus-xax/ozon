<template>
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
    <v-card>
      <v-toolbar
          color="primary"
          class="px-0"
          dark
      >Редактировать название проекта</v-toolbar>
      <v-card-text>
        <v-text-field
            autofocus="true"
            placeholder="Название проекта"
            :model-value="name"
            @input="setName"
            @keydown.enter="rename"
        ></v-text-field>
      </v-card-text>
      <v-card-actions
          class="d-flex justify-end"
      >
        <v-btn
            class="clear"
            @click="dialog = false"
        >Отменить</v-btn>
        <v-btn
            class="bg-blue text-white"
            dark="true"
            @click="rename"
        >Сохранить</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import {mapActions} from "pinia/dist/pinia.js";
import {useSeoProjectsStore} from "../store/index.js";

export default {
  name: "DialogSeoProjectEdit",
  props: {
    project: {
      type: Object
    },
    value: {
      type: Boolean
    }
  },
  data: (props) => ({
    dialog: props.value,
    name: props.project.name
  }),
  mounted () {
    console.log('mounted dialog seo project edit')
  },
  methods: {
    setName (event) {
      this.name = event.target.value
    },
    async rename () {
      let that = this
      console.log('name', this.name)
      console.log('projectId', this.project.id)
      const result = await this.updateProject({id: this.project.id, newname: this.name})
          .then((response) => {
            that.updated = true
            this.dialog = false
            that.$snotify.success(response.data.result)
            setTimeout(() => {
              that.updated = false
            }, 3000)
          }).catch((err) => {
            that.$snotify.error(err)
          })
    },
    ...mapActions(useSeoProjectsStore, ['updateProject'])
  }
}
</script>
