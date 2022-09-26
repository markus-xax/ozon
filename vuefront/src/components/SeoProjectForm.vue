<template>
    <v-card>
      <v-toolbar
          color="primary"
          class="px-0"
          dark
      >
        <v-toolbar-title>Редактировать название проекта</v-toolbar-title>
        <v-btn
            icon="mdi-close"
            @click="onClose"
        >
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <v-text-field
            autofocus
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
            @click="onClose"
            :disabled="loading"
        >Отменить</v-btn>
        <v-btn
            class="bg-blue text-white"
            dark="true"
            @click="rename"
            :loading="loading"
            :disabled="loading || !name"
        >Сохранить</v-btn>
      </v-card-actions>
    </v-card>
    <v-snackbar
        v-model="updated"
        timeout="1000"
        color="success"
        outlined="true"
        absolute
        right
        top
    >Проект успешно обновлен</v-snackbar>
</template>

<script>
import {mapActions} from "pinia";
import {useSeoProjectsStore} from "../store/index.js";

export default {
  name: "SeoProjectForm",
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
    name: props.project.name,
    updated: false,
    loading: false
  }),
  emits: ['input'],
  methods: {
    onClose () {
      this.dialog = false
      this.$emit('input', this.dialog)
    },
    setName (event) {
      this.name = event.target.value
    },
    async rename () {
      this.loading = true
      let that = this
      const result = await this.updateProject({id: this.project.id, newname: this.name})
          .then((response) => {
            if (response.data.status <= 201) {
              that.$snotify.success('Проект успешно обновлен')
            } else {
              that.$snotify.error(response.data.error)
            }
            that.loading = false
            that.onClose()
          })
    },
    ...mapActions(useSeoProjectsStore, ['updateProject'])
  }
}
</script>

<style scoped>

</style>
