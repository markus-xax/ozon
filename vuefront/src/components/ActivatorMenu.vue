<template>
  <v-menu
      transition="none"
      width="220"
      open-on-hover
  >
    <template v-slot:activator="{ on, props }">
      <v-btn
          :ripple="false"
          width="60"
          height="60"
          class="pa-0 ma-0 mr-9"
          v-bind="props"
      >
        <v-avatar
            size="medium"
        >
          <v-img
              cover
              :src="avatar"
              width="30"
              height="30"
          >
          </v-img>
        </v-avatar>
      </v-btn>
    </template>
    <v-list
        class="mt-3 pt-0"
    >
      <div class="user-info">
        <div class="user-name">Анна</div>
        <div class="user-position" hidden>Подписка активна до </div>
      </div>
      <a class="dropdown-item">
        <v-icon>mdi-currency-rub</v-icon>Доступ до 07:59 08.09.2022
      </a>
      <v-list-item
          v-for="(item, index) in personalMenu"
          :key="index"
          :value="index"
      >
        <v-list-item-title>{{ item.name }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import avatar from "../assets/avatar.png";

export default {
  name: "ActivatorMenu",
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
.v-btn--active:focus > .v-btn__overlay,
.v-btn[aria-haspopup=menu][aria-expanded=true]:focus > .v-btn__overlay {
  opacity: 0!important
}
.user-info {
  background-color: #4285f4;
  color: #fff;
  overflow: hidden;
  padding: 20px 15px 14px;
  border-radius: 2px 2px 0 0;
  margin-bottom: 7px;
}
.dropdown-item {
  padding: 10px 20px;
  min-width: 175px;
  line-height: 18px;
}
[hidden] {
  display: none !important;
}
</style>
