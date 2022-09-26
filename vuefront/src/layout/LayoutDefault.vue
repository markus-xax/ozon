<template>
  <v-app>
    <v-app-bar
        class="d-flex justify-space-between overflow-visible elevation-0"
        height="60"
    >
      <v-row
          class="align-center"
      >
        <the-logo></the-logo>
        <main-nav></main-nav>
      </v-row>
      <the-search-bar></the-search-bar>
      <activator-menu></activator-menu>
    </v-app-bar>
    <v-main
        style="background-color: #eee;"
    >
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
import MainNav from '../components/MainNav.vue'
import TheSearchBar from '../components/TheSearchBar.vue'
import TheLogo from '../components/TheLogo.vue'
import ActivatorMenu from '../components/ActivatorMenu.vue'

export default {
  name: "LayoutDefault",
  components: {
    MainNav,
    TheSearchBar,
    TheLogo,
    ActivatorMenu
  },
  computed: {
    personalRef () {
      console.log('ref', this.$refs.personalBtn)
      return this.$refs.personalBtn
    }
  },
  data: () => ({

  })
}
</script>

<style>
  .v-dialog .v-overlay__content {
    max-height: inherit!important;
  }
  .v-toolbar--density-default .v-toolbar__content{
    height: 58px!important;
  }
  .v-overlay.v-overlay--active.v-theme--myLightTheme.v-dialog.v-overlay--scroll-blocked {
    max-width: 1140px;
    padding: 0;
  }
  .v-toolbar__content .mdi-close.v-icon--size-default {
    font-size: 19px;
    margin-top: -13px;
  }
  .v-toolbar__content .mdi-close.v-icon--size-default:before {
    color: rgba(0,0,0,.7);
    font-weight: 700;
    font-size: 14px;
  }
</style>
