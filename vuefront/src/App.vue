<template>
  <component v-if="requiredModule" :is="requiredModule">
    <vue-snotify></vue-snotify>
  </component>
</template>

<script>
// import LayoutDefault from "./layout/LayoutDefault.vue"
// import { useRoute } from 'vue-router'
export default {
  name: 'App',

  props: {
    module: {
      type: String
    }
  },

  components: {
    // LayoutDefault
  },

  data: () => ({
    //
  }),

  computed: {
    requiredModule () {
      if (!this.module) return false

      let name = this.module.split('-')
      return name.map((word) => word[0].toUpperCase() + word.slice(1)).join('')
    }
  },
  mounted () {
  }
}
</script>

<style>
* {
  letter-spacing: 0!important;
}
</style>
