<template>
  <v-dialog
      class="big-dialog-popup"
      transition="dialog-top-transition"
      width="1140"
      v-model="dialog"
      scrollable
  >
    <template v-slot:activator="{ props }">
      <v-btn
          flat
          class="btn-add"
          prepend-icon="mdi-plus-box-outline"
          height="30"
          v-bind="props"
          @click="dialog = true"
      >
        <slot name="default"></slot>
      </v-btn>
    </template>
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
      <v-card-text>
        <div class="d-flex mb-4 add-project-top">
          <label class="project-name--label">Имя проекта</label>
          <input class="project-name ml-5 pl-3 pr-3" width="200" type="text" v-model="projectName">
        </div>
        <div class="card"
             v-if="!foundSku"
        >
          <div class="d-flex input-wrap-full" v-if="!loadingSearch">
            <input type="text"
                   class="pl-3 pr-3"
                   placeholder="https://www.wildberries.ru/catalog/2389150/detail.aspx или 2389150"
                   v-model="projectUrl"
                   @change="seekBySku"
                   ref="skusearch"
            >
            <v-btn
                icon="mdi-keyboard-return"
            ></v-btn>
          </div>
          <div
              class="skeletor__card mb-5 bg-white pa-3 v-col"
              v-else
          >
            <skeletor class="mb-3" width="40%"></skeletor>
            <skeletor class="mb-3" width="65%"></skeletor>
            <skeletor class="mb-3" width="60%"></skeletor>
          </div>
        </div>
        <div class="sku-info d-flex justify-start" v-else>
          <div class="sku-image" v-if="sku.image && sku.image.t">
            <img :src="sku.image.t" class="mr-3" alt="" style="height: 105px">
          </div>
          <div class="product-sku-info sku-data mb-5">
            <svg
                @click="clearSku"
                viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img"
                aria-label="x circle" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                class="bi-x-circle position-absolute cursor-pointer b-icon bi" style="right: 0px; font-size: 150%;">
              <g>
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
              </g>
            </svg>
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
                  @keydown.ctrl.enter="addWords"
                  style="resize: none"
              >
              </textarea>
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
            type="info"
            class="mb-7"
        >
          Дополнительные SKU к проекту вы можете добавить после его создания.
        </v-alert>
        <v-alert
            type="warning"
        >
          Данные по товару будут доступны в течение дня.<br/>
          Сведения по позициям будут доступны с даты добавления товара в раздел.
        </v-alert>
      </v-card-text>

      <v-card-actions
          class="dialog-bottom text-center justify-center"
      >
        <v-btn
            class="bg-green text-white"
            :disabled="!hasLimit || !sku.sku || !phrases.length"
            @click="addSkuToProject"
        >Начать сбор данных
        </v-btn>
      </v-card-actions>
    </v-card>

    <v-snackbar
        timeout="300"
        :model-value="notification"
    >{{ notificationMessage }}
    </v-snackbar>
  </v-dialog>
</template>

<script>
import {mapActions, mapState} from "pinia";
import {useSeoProjectsStore} from "../store/index.js";

export default {
  name: "DialogSeoProjectSkuAdd",
  data: () => ({
    dialog: false,
    projectKeywordsText: '',
    projectUrl: '',
    notification: false,
    phrases: [],
    notificationMessage: '',
    projectName: '',
    loadingSearch: false,
    foundSku: false
  }),
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
    ...mapState(useSeoProjectsStore, ['sku', 'limits', 'words'])
  },
  methods: {
    async addSkuToProject () {
      let projectId = this.$route.params.id
      if (!projectId) {
        projectId = await this.createProject(this.projectName).then((response) => {
          if (response.data.status === 201) {
            return response.data.result.id
          }
        })
      }

      let phrases = []

      this.phrases.map((phrase) => {
        phrases.push(phrase.word)
      })
      let that = this
      await this.addSku(projectId, {
        words: phrases,
        sku: this.sku.sku
      }).then((response) => {
        if (response.data.status <= 201) {
          let that = this
          this.$snotify.success('Проект успешно создан')
        } else {
          this.$snotify.error(response.data.error)
        }
      }).then((id) => {
        setTimeout(() => {
          that.$router.push({name: 'position-tracking-project-detail', params: { id }})
        }, 1000)
      }).catch((err) => {
        this.$snotify.error(err)
      })
    },
    uploaderClick () {
      this.$refs.uploader.click()
    },
    deleteWord (word) {
      const idx = this.phrases.findIndex((elem, idx) => {
        return word.word === elem.word
      })

      this.phrases.splice(idx, 1)
    },
    clearSku () {
      this.resetSku()
      this.projectUrl = ''
      this.foundSku = false
      this.$nextTick(() => {
        this.$refs.skusearch.focus()
      })
    },
    deletePhrases () {
      this.phrases = []
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
    async seekBySku () {
      let that = this
      const sku = this.projectUrl.match(/\d+/)
      if (sku) {
        this.loadingSearch = true
        try {
          await this.searchSku(sku.pop()).then(async (response) => {
            const {data, status, code, message} = response

            if (data.status !== 200) {
              that.$snotify.error(data.error)
              return false
            }

            this.foundSku = true
            return data.result.sku
          }).then((sku) => {
            this.fetchWords(sku).then((response) => {
              const { data } = response
              let lines = []
              if (data.result.length) {
                data.result.forEach((word) => {
                  lines.push(word.word)
                })
              }
              that.projectKeywordsText = lines.join('\r\n')
            })
          }).catch((err) => {
            console.log(err)
          })
        } catch (error) {
          this.$snotify.error(error)
        } finally {
          this.loadingSearch = false
        }
      }
    },
    ...mapActions(useSeoProjectsStore, ['fetchProjects', 'setFilterByName', 'searchSku', 'resetSku', 'fetchLimits', 'fetchWords', 'addSku', 'createProject'])
  },
  watch: {
    dialog (newValue, oldValue) {
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
.title-popup {
  height: 58px;
  padding: 0 20px !important;
}

.title-popup span {
  font-weight: 300;
  font-size: 19.994px;
  line-height: 28.500px;

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
  min-height: 30px !important;
}

.v-dialog {
  align-items: flex-start !important;
}

.sku-info {
  position: relative;
}

.sku-data .btn-close {
  position: absolute;
  top: 0;
  right: 0;
}

.list_overflow {
  height: 150px;
  padding: 10px;
  border: 1px solid #4285f4;
  overflow-y: auto;
}

.phrases-edit {
  height: 220px;
  display: flex;
  flex-direction: column;
}
</style>
