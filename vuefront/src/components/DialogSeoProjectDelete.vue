<template>
  <v-dialog
      width="600"
      transition="dialog-top-transition"
      v-model="dialog"
  >
    <v-card type="danger">
      <v-card-title>Удалить проект?</v-card-title>
      <v-card-text>
        Внимание!<br />
        Вы действительно хотите удалить «{{ projectName }}»?<br />
        Все данные, собранные в рамках этого проекта, будут удалены.
      </v-card-text>
      <v-card-actions
          class="justify-end"
      >
        <v-btn @click="onCloseDialog">
          Отмена
        </v-btn>
        <v-btn
            type="danger"
            color="bg-danger"
            @click="onConfirmDialog"
            :disabled="loading"
        >Удалить</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
  <v-snackbar
      v-model="affected"
  >
    Проект успешно удален
  </v-snackbar>
</template>

<script>
import {useSeoProjectsStore} from "../store/index.js"
import {mapActions} from "pinia"

export default {
  name: "DialogSeoProjectDelete",
  data: () => ({
    affected: false
  }),
  emits: ['close', 'delete'],
  props: {
    loading: {
      type: Boolean
    },
    projectName: {
      type: String
    },
    id: {
      type: String
    },
    dialog: {
      type: Boolean
    }
  },
  methods: {
    onCloseDialog () {
      this.$emit('close', false)
    },
    async onConfirmDialog () {
      let that = this
      return await this.deleteProject(this.id).then((data) => {
        this.affected = true
        this.fetchProjects().then((response) => {
          that.$snotify.success('Проект успешно удален')
          that.$router.push({name: 'position-tracking-projects'})
        })

        this.$emit('close', false)
        this.$emit('delete', true)
      })
    },
    ...mapActions(useSeoProjectsStore, ['deleteProject', 'fetchProjects'])
  }
}
</script>

<style scoped>

</style>
