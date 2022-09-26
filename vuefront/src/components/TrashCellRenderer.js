import { defineComponent } from 'vue'
export default defineComponent({
    template: `
        <v-dialog>
          <template v-slot:activator="{ props }">
            <v-icon v-bind="props">mdi-trash</v-icon>
          </template>
          <v-card>
            <v-toolbar>
              <v-card-title>Удалить ключевую фразу?</v-card-title>
            </v-toolbar>
            <v-card-text>
              Вы собираетесь удалить фразу из статистики. Продолжить?
            </v-card-text>
            <v-card-actions>
              <v-btn>Отменить</v-btn>
              <v-btn>Подтвердить</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
    `,
    data: () => ({
        cellValue: null
    }),
    beforeMount () {
        this.cellValue = this.getValueToDisplay(this.params)
    },
    methods: {
        getValueToDisplay (params) {
            return params.valueFormatted ? params.valueFormatted : params.value
        }
    }
})
