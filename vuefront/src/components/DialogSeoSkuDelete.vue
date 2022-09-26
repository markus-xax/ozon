<template>
  <v-dialog
      width="600"
      transition="dialog-top-transition"
      v-model="dialog"
  >
    <v-card type="danger">
      <v-card-title>Удалить SKU?</v-card-title>
      <v-card-text>
        Внимание!<br />
        Вы действительно хотите удалить «{{ skuName }}» из отслеживания?
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
</template>

<script>
import {useSeoProjectsStore} from "../store/index.js"
import {mapActions} from "pinia"

export default {
  name: "DialogSeoSkuDelete",
  data: () => ({
    affected: false,
    loading: false
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
      if (!newValue) this.onCloseDialog()
    }
  },
  emits: ['close'],
  methods: {
    onCloseDialog () {
      this.$emit('close', false)
    },
    async onConfirmDialog () {
      this.loading = true
      return await this.deleteSku(this.id).then((data) => {
        this.affected = true
        this.fetchSkus({id: this.projectId}).then((response) => {
          setTimeout(() => {
            this.loading = false
          }, 1000)
        })

        this.$emit('close', false)
      })
    },
    ...mapActions(useSeoProjectsStore, ['deleteSku', 'fetchProjects', 'fetchSkus'])
  }
}
</script>

<style scoped>

</style>
