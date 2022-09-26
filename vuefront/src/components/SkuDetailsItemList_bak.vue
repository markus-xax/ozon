<template>
  <v-card
  >
    <v-card-item
    >
      <v-toolbar class="bg-transparent">
        <v-toolbar-title class="ma-0 pa-0">
          <router-link
              class="text-primary text-decoration-none"
              :to="{name: 'position-tracking-sku-detail', params: {id: $route.params.id, itemId: item.id} }"
              v-text="item.name"></router-link>
        </v-toolbar-title>
        <v-btn
            @click="loadSkus"
        >
          <v-icon>mdi-refresh</v-icon>
        </v-btn>
        <v-btn
            width="30"
            height="30"
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
                size="small"
                width="30"
                height="30"
                v-bind="props"
            >
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item-action>
              <v-btn
                  @click="dialogEdit = true"
              >
                <v-icon>mdi-format-list-text</v-icon> Добавить / удалить ключи
              </v-btn>
            </v-list-item-action>
            <v-list-item-action>
              <v-btn
                  @click="dialogMove = true"
              >
                <v-icon>mdi-file-replace-outline</v-icon> Перенести в другой проект
              </v-btn>
            </v-list-item-action>
            <v-list-item-action>
              <v-btn
                  @click="dialogDelete = true"
              >
                <v-icon>mdi-delete</v-icon> Удалить SKU
              </v-btn>
            </v-list-item-action>
          </v-list>
        </v-menu>
      </v-toolbar>
      <v-card-text
          class="d-flex justify-space-between"
          v-if="item.sku"
      >
        <div class="media">
          <img
          v-if="item.image && item.image.t"
          :src="`${item.image.t}`" alt="">
          <div class="media-body">
            <table>
              <tbody>
              <tr>
                <td>Продавец</td>
                <td v-text="item.seller"></td>
              </tr>
              <tr>
                <td>Бренд</td>
                <td><a class="text-primary text-decoration-none" :href="`/wb/brand?brand=${item.brand}`" v-text="item.brand"></a></td>
              </tr>
              <tr>
                <td>SKU</td>
                <td v-text="item.sku"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
                  <a class="text-black pr-3 text-decoration-none" :href="`https://www.wildberries.ru/catalog/${item.sku}/detail.aspx`" target="_blank">
                    Открыть в WB
                    <v-icon>mdi-open-in-new</v-icon>
                  </a>
                  <a class="text-black text-decoration-none" :href="`/wb/item/${item.sku}`">Открыть в MPSTATS</a>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
        <position-statistic
            :project="project"
            :sku="item.sku"
            :item="item"
        ></position-statistic>
      </v-card-text>
      <v-expansion-panel-text
        class="table-wrapper"
      >
        <v-card-text >
          <words-stat
          :words="item.words"
          ></words-stat>
        </v-card-text>
      </v-expansion-panel-text>
    </v-card-item>
  </v-card>

  <dialog-seo-sku-edit
      :dialog="dialogEdit"
      :id="item.id"
      :project-id="project.id"
      :sku-name="item.name"
      @close="onCloseEdit"
  ></dialog-seo-sku-edit>
  <dialog-seo-sku-move
      :dialog="dialogMove"
      :id="parseInt(item.id)"
      :project-id="project.id"
      :sku-name="item.name"
      @close="onCloseMove"
  ></dialog-seo-sku-move>
  <dialog-seo-sku-delete
      :dialog="dialogDelete"
      :id="parseInt(item.id)"
      :project-id="project.id"
      :sku-name="item.name"
      @close="onCloseDelete"
  ></dialog-seo-sku-delete>
</template>

<script>
import WordsStat from "./WordsStat.vue"
import PositionStatistic from "./PositionStatistic.vue"
import DialogSeoSkuEdit from './DialogSeoSkuEdit.vue'
import DialogSeoSkuMove from './DialogSeoSkuMove.vue'
import DialogSeoSkuDelete from './DialogSeoSkuDelete.vue'

export default {
  name: "SkuDetailsItemList",
  data: () => ({
    dialogDelete: false,
    dialogMove: false,
    dialogEdit: false
  }),
  components: {
    WordsStat,
    PositionStatistic,
    DialogSeoSkuDelete,
    DialogSeoSkuMove,
    DialogSeoSkuEdit
  },
  methods: {
    loadSkus () {
      this.$emit('onupdate')
    },
    onCloseDelete (value) {
      this.dialogDelete = value
    },
    onCloseMove (value) {
      this.dialogMove = value
    },
    onCloseEdit (value) {
      this.dialogEdit = value
    }
  },
  emits: ['onupdate'],
  props: {
    item: {
      type: Object
    },
    project: {
      type: Object
    }
  },
  mounted () {
  }
}
</script>

<style scoped>

</style>
