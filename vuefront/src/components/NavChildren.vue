<template>
  <v-list class="dropdown-menu pa-5 mt-8">
    <v-list-item
        v-for="(child, idx) of items"
        :key="idx"
    >
      <router-link class="d-block text-left" v-if="child.name" :to="child.action" v-text="child.name" @click="selectChild"></router-link>
      <v-divider v-else></v-divider>
    </v-list-item>
  </v-list>
</template>

<script>
export default {
  name: "NavChildren",
  props: {
    items: {
      type: Array
    }
  },
  methods: {
    selectChild (event) {
      this.$emit('select', event.target.closest('.show'))
    }
  }
}
</script>

<style scoped>

</style>
