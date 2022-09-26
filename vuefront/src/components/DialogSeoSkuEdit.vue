<template>
  <v-dialog
      class="big-dialog-popup"
      transition="dialog-top-transition"
      width="1140"
      v-model="dialog"
      scrollable
  >
    <v-card>
      <v-toolbar
          color="primary"
          class="title-popup pl-4 pr-0 d-flex justify-space-between"
          dark
      >
        <span>Настройки инструмента &laquo;Отслеживание позиций&raquo;</span>
        <v-spacer></v-spacer>
        <v-btn
            icon="mdi-close"
            @click="dialog = false"
        ></v-btn>
      </v-toolbar>
      <v-card-text
          v-if="!loading"
      >
        <div class="sku-info d-flex justify-start"
        >
          <div class="sku-data mb-5">
            <p class="sku-name" v-text="sku.name"></p>
            <p class="sku-seller">
              Продавец: <a :href="`/wb/seller?supplierId=${sku.supplierId}`" v-text="sku.seller"></a>
            </p>
            <p class="sku-brand">
              Бренд: <a :href="`/wb/brand?brand=${sku.brand}`" v-text="sku.brand"></a>
            </p>
            <p class="sku-sku">
              Артикул: <a :href="`/wb/item/${sku.sku}`" v-text="sku.sku"></a>
            </p>
          </div>
        </div>
        <div class="mt-1 mb-0 v-row d-flex justify-space-between">
          <v-col cols="6">
            <div
                class="d-flex justify-space-between bg-white top-col"
            >
              <p class="controls-label">Черновик</p>
              <v-toolbar-items>
                <v-btn
                    class="small-btn"
                    @click="uploaderClick"
                >
                  <v-icon>mdi-file-excel</v-icon>
                  <input type="file" style="display: none" accept="text/csv" ref="uploader">
                  Импорт файла
                </v-btn>
                <v-btn
                    class="small-btn primary-color"
                    @click="projectKeywordsText = ''"
                >
                  <v-icon>mdi-close</v-icon>
                  Очистить
                </v-btn>
              </v-toolbar-items>
            </div>
            <v-card
                height="250"
                class="phrases-edit"
            >
              <textarea
                  v-model="projectKeywordsText"
                  placeholder="ключевые фразы"
                  class="pa-3 mb-3 d-flex flex-grow-1"
                  style="resize: none"
                  @keydown.ctrl.enter="addWords"
              ></textarea>
              <v-btn
                  width="100%"
                  class="bg-primary btn-primary-full"
                  @click="addWords"
              >
                Добавить (Ctrl + Enter)
              </v-btn>
            </v-card>
          </v-col>
          <v-col cols="6">
            <div
                class="d-flex justify-space-between bg-white top-col"
            >
              <p class="controls-label">Ключевые слова в товарной позиции</p>
              <v-toolbar-items>
                <v-btn
                    class="small-btn primary-color"
                    @click="deletePhrases"
                >
                  <v-icon>mdi-close</v-icon>
                  Удалить все
                </v-btn>
              </v-toolbar-items>
            </div>
            <v-card
                height="250"
            >
              <v-sheet
                  height="100%"
                  v-if="phrases.length"
                  border="1"
                  class="list_overflow pa-0"
              >
                <div
                    v-for="(word, idx) of phrases"
                    :key="idx"
                    class="d-flex align-center"
                >
                  <span class="mr-2" v-text="idx + 1"></span>
                  <span class="flex-grow-1" v-text="word.word"></span>
                  <v-btn
                      height="20"
                      @click="deleteWord(word)"
                  >
                    <v-icon>mdi-trash-can-outline</v-icon>
                  </v-btn>
                </div>
              </v-sheet>
              <v-sheet
                  v-else
                  height="100%"
                  class="list_overflow pa-0"
              >
                <div
                    class="fill-height flex-row align-content-center"
                ><b>Ключевые слова</b><br />еще не добавлены
                  Для добавления ключевых слов, которые вы хотите отслеживать, используйте черновик.
                </div>
              </v-sheet>
            </v-card>
            <p class="d-flex justify-space-between mt-3">
              <span>Ключевые слова для отслеживания</span>
              <span v-text="phrases.length"></span>
            </p>
            <p class="d-flex justify-space-between">
              <span>Общее число ключевых слов в проектах / лимит по тарифу</span>
              <span v-text="`${usedLimit} / ${limits.available}`"></span>
            </p>
          </v-col>
        </div>
        <v-alert
            type="info"
            class="mb-7 bg-full"
            v-if="!hasLimit"
        >
          Превышен лимит доступных ключевых слов для отслеживания. Чтобы отслеживать больше ключевых слов, оформите подписку на более высокий тарифный план.
          <a class="bg-green text-white text-decoration-underline pa-2 rounded" href="/i-need-more">Переход на повышенный тариф</a>
        </v-alert>
        <v-alert
            type="warning"
        >
          Данные по товару будут доступны в течение дня.<br/>
          Сведения по позициям будут доступны с даты добавления товара в раздел.
        </v-alert>
      </v-card-text>
      <v-card-text
          v-else
      >
        <div class="skeletor__card mb-5 bg-white pa-3 v-col"
        >
          <skeletor class="mb-3" width="40%"></skeletor>
          <skeletor class="mb-3" width="65%"></skeletor>
          <skeletor class="mb-3" width="60%"></skeletor>
        </div>
      </v-card-text>
      <v-card-actions
          class="text-center justify-center"
      >
        <v-btn
            class="bg-green text-white"
            :disabled="!hasLimit || !phrases.length"
            @click="onConfirmDialog"
        >
          Обновить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import {useSeoProjectsStore} from "../store/index.js"
import {mapActions, mapState} from "pinia"

export default {
  name: "DialogSeoSkuEdit",
  data: () => ({
    affected: false,
    loading: true,
    phrases: [],
    projectKeywordsText: '',
    phrasesToDelete: []
  }),
  props: {
    skuName: {
      type: String
    },
    projectId: {
      type: Number
    },
    id: {
      type: Number
    },
    dialog: {
      type: Boolean
    }
  },
  watch: {
    async dialog (newValue, oldValue) {
      if (newValue) {
        this.loading = true
        let that = this
        await this.fetchSkudata(this.projectId, this.id).then((response) => {
          const {data} = response
          return data.result.sku
        }).then(async (sku) => {
          return await this.fetchSkuinfo(sku).then((response) => {
            let currentSku = that.skus.filter((sku) => sku.id === this.id).pop()
            if (currentSku.words && currentSku.words.length > 0) {
              this.phrases = currentSku.words
            }
            that.loading = false
            return sku
          })
        })
      }
      if (!newValue) this.onCloseDialog()
    }
  },
  computed: {
    keywords () {
      return [...this.words, ...this.phrases]
    },
    usedLimit () {
      return this.limits.use + this.phrases.length
    },
    hasLimit () {
      return this.usedLimit <= this.limits.available
    },
    ...mapState(useSeoProjectsStore, ['sku', 'skus', 'limits', 'words'])
  },
  methods: {
    onCloseDialog () {
      this.$emit('close', false)
    },
    addWords () {
      const lines = this.projectKeywordsText.split(/\r?\n|\r|\n/g)

      let phrases = []
      this.phrases.map((item) => {
        phrases.push(item.word)
      })

      let words = []
      let wordsArr = [...phrases]
      lines.map((word) => {
        word = word.trim().toLowerCase()
        if (word && wordsArr.indexOf(word.toLowerCase()) < 0) {
          words.push({word: word})
          wordsArr.push(word)
        }
      })

      this.phrases = [...this.phrases, ...words]
    },
    deleteWord (word) {
      const idx = this.phrases.findIndex((elem, idx) => {
        return word.word === elem.word
      })
      this.phrasesToDelete.push(word.word)
      this.phrases.splice(idx, 1)
    },
    deletePhrases () {
      this.phrases = []
    },
    async onConfirmDialog () {
      this.loading = true
      let that = this
      if (this.phrasesToDelete.length > 0) {
        await this.removeWords({id: this.id, words: this.phrasesToDelete}).then((response) => {
          console.log(response)
        })
      }

      let phrases = []
      this.phrases.map((phrase) => {
        phrases.push(phrase.word)
      })
      console.log(phrases)
      return await this.updateSku(this.projectId, {sku: this.sku.sku, words: phrases}).then((response) => {
        if (response.data.status <= 201) {
          this.$snotify.success('Данные успешно обновлены')
        }
        else {
          this.$snotify.error(response.data.error)
        }
        this.affected = true
        this.fetchSkus({id: this.projectId}).then((response) => {
          setTimeout(() => {
            this.loading = false
          }, 1000)
        })

        this.$emit('close', false)
      })
    },
    ...mapActions(useSeoProjectsStore, ['updateSku', 'removeWords', 'fetchSkus', 'fetchSkudata', 'fetchSkuinfo', 'fetchLimits', 'fetchWords'])
  },
  mounted () {
    this.fetchLimits()
  }
}
</script>

<style scoped>
.title-popup {
  height: 58px;
  min-height: 58px;
}
.title-popup .v-toolbar__content span {
  font-weight: 300;
  font-size: 19.994px;
  line-height: 28.500px;
}
.big-dialog-popup .v-toolbar__content > .v-btn:last-child {
  margin-right: -20px;
  margin-inline-end: 0;
}
</style>
