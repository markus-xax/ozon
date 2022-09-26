<template>
  <v-app>
    <v-main>
      <router-view></router-view>
      <vue-snotify></vue-snotify>
    </v-main>
  </v-app>
</template>

<script>
// import routes from '../router/SeoPositionTracking'
// console.log(routes)
export default {
  name: "SeoPositionTracking",
  beforeMount () {
    console.log('onBeforeMount')
    // routes.forEach((route) => {
    //   this.$router.addRoute(route)
    // })
  },
  mounted () {
    console.log('mounted')
  }
}
</script>

<style scoped>

</style>
