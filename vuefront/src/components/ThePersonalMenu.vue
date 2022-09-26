<template>
  <v-btn
      @click="onShowMenu"
      ref="personalBtn"
      class="pa-0 personal-button"
      width="30"
  >
    <v-img
        :src="avatar"
        width="30"
        height="30"
    ></v-img>
    <v-menu
        v-model="drawer"
        location="right"
        absolute
        attach
        width="150"
        auto
        bottom
        right
        close-on-click
    >
      <v-list
      >
        <v-list-item
            v-for="(menuItem, idx) of personalMenu"
            :key="idx"
        >
          <v-list-item-title v-text="menuItem.name"></v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-btn>
</template>

<script>
import avatar from "../assets/avatar.png";

export default {
  name: "ThePersonalMenu",
  data: () => ({
    drawer: false,
    personalMenu: [
      {
        name: 'Пользователь'
      },
      {
        name: 'Доступ: '
      },
      {
        name: 'Выход'
      }
    ],
    avatar
  }),
  methods: {
    onShowMenu (event) {
      this.drawer = false
      this.x = event.clientX
      this.y = event.clientY + 50
      this.$nextTick(() => {
        this.drawer = !this.drawer
      })
    }
  }
}
</script>

<style scoped>

</style>
