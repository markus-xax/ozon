<template>
  <v-app-bar-nav-icon
      width="126"
      class="ml-15 rounded-0 mr-6"
      rounded="false"
  >
    <router-link
        :to="{name: 'default'}"
    >
      <v-img
          :src="icon"
          contain="false"
          class="logo"
          width="126"
      ></v-img>
    </router-link>
  </v-app-bar-nav-icon>
</template>

<script>
import icon from "../assets/logo.svg";

export default {
  name: 'TheLogo',
  computed: {
    icon () { return icon }
  }
}
</script>

<style lang="scss">

</style>
