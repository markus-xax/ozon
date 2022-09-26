<template>
  <v-app>
    <v-app-bar
        height="60"
        color="success"
        flat
    >
      <v-container>
        <a class="logo" href="/">
          <img src="../assets/images/logo_white.svg" alt="">
        </a>
      </v-container>
    </v-app-bar>
    <v-main
        class="layout-auth"
    >
      <v-container>
        <router-view app></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: "LayoutAuth",
  data: () => ({
  }),
  components: {
  },
  mounted () {
    console.warn('is mobile ? ', this.$vuetify.display.mobile)
    console.warn('mobile breakpoint ', this.$vuetify.display.mobileBreakpoint)
    console.warn('current display ', this.$vuetify.display.name)
  }
}
</script>

<style scoped>
.v-application.v-theme--myLightTheme {
  /*z-index: -1;*/
  background: url('../assets/images/main-bg.svg') top no-repeat #5bb369;
  background-size: cover;
  /*top: 0;*/
  /*right: 0;*/
  /*left: 0;*/
  /*max-height: 1335px;*/
  /*height: 100%;*/
}
</style>
