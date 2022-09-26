<template>
    <div
      :loading="loading"
        class="mb-4"
        v-for="(item, idx) of skus">
      <sku-details-item-list
          @onupdate="loadSkus"
          :project="currentProject"
          :item="item"
      ></sku-details-item-list>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { useSeoProjectsStore } from "../store/index.js"

import SkuDetailsItemList from "./SkuDetailsItemList.vue"


export default {
  name: "SkuDetailsItem",
  components: {
    SkuDetailsItemList,
  },
  data: () => ({
    loading: false,
    panels: []
  }),
  props: {
    skus: {
      type: Object
    },
    loading: {
      type: Boolean
    }
  },
  methods: {
    async loadSkus () {
      this.loading = true
      const id = this.$route.params.id
      console.log('id', id)
      await this.fetchSkus({id}).then((response) => {
        console.log('skus response', response)
        this.loading = false
      })
    },
    all () {
      this.panels = [...Object.keys(this.skus).map((k, i) => i)]
    },
    none () {
      this.panels = []
    },
    ...mapActions(useSeoProjectsStore, ['fetchSkus'])
  },
  computed: {
    currentProject () {
      let that = this
      let thisProject
      const filtered = this.projects.forEach((item) => {
        if (parseInt(that.$route.params.id) === parseInt(item.id)) {
          thisProject = item
        }
      })
      return thisProject
    },
    ...mapState(useSeoProjectsStore, ['projects', 'skuViewMode'])
  },
  watch: {
    skuViewMode (value) {
      if (value === 'all') {
        this.all()
      } else {
        this.none()
      }
    }
  },
  async mounted () {
    if (this.skuViewMode === 'all') {
      // console.log('toggle all')
      // this.all()
    }
  }
}
</script>

<style scoped>

</style>
