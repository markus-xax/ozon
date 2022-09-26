<template>
  <v-menu
      v-if="menu.children && menu.children.length"
      transition="none"
      open-on-hover
  >
    <template v-slot:activator="{ props, on }">
      <v-btn
          v-bind="props"
          class="pl-3 pr-3"
          height="60"
      >
        {{ menu.name }}
        <v-icon>mdi-menu-down</v-icon>
      </v-btn>
    </template>
    <v-list class="mt-6 pa-0 header-list">
      <v-list-item
          v-for="(item, idx) of menu.children"
          class="pa-0"
          :class="{
            'd-block w100': item.name,
            'divider-item': !item.name
          }"
         :key="idx"
      >
        <a
            class="pt-3 pl-5 pr-5 pb-3 d-block w-100"
            v-if="item.href"
            v-text="item.name"
            :href="item.href"
        ></a>
        <router-link
            class="pt-3 pl-5 pr-5 pb-3 d-block w-100"
            style="line-height: 18px"
            v-else-if="item.name"
            :disabled="!item.action.name"
            :event="(item.action && item.action.name ? 'click' : '')"
            :to="item.action"
        >
          <span v-text="item.name"></span>
        </router-link>
        <v-divider v-else></v-divider>
      </v-list-item>
    </v-list>
  </v-menu>
  <v-btn
      class="pl-2 pr-2"
      v-else
  >
    <a
       v-if="menu.href"
       :href="menu.href"
       v-text="menu.name"
    ></a>
    <router-link
        v-else
        :disabled="!menu.action.name"
         :event="(menu.action && menu.action.name ? 'click' : '')"
         :to="menu.action" v-text="menu.name"
    ></router-link>
  </v-btn>
</template>

<script>
export default {
  name: "MultilevelNavItem",
  props: {
    menu: {
      type: Object
    }
  },
  components: {
  },
  methods: {
  },
  computed: {
  }
}
</script>

<style>
li {
  list-style: none
}
.nav-link {
  text-decoration: none;
  color: #000;
  font-size: 13px;
}
.nav-link:focus,
.nav-link:active {
  color: #4285f4
}
.v-btn a {
  text-decoration: none;
  color: #212529;
}
.dropdown-menu {
  display: none;
  position: absolute;
  margin-top: 12px;
  max-height: 80vh;
  overflow-y: auto;
  border: none;
  float: none;
  background: #fff;
}
.v-btn.v-btn--variant-text {
  text-transform: none;
  font-weight: 400;
}
.show .dropdown-menu {
  display: block;
}
.v-overlay__content .v-list-item a {
  font-size: 13px;
  text-decoration: none;
  color: #212529;
  cursor: pointer;
}
.v-overlay__content .v-list-item a[disabled="true"] {
  background: transparent!important;
  color: #212529 !important;
  cursor: not-allowed;
  text-decoration: red line-through;
}
.v-list-item-action .v-btn:hover {
  background-color: #4285f4;
  color: #fff;
}
.v-overlay__content .v-list-item a:hover,
.v-overlay__content .v-list-item a.router-link-active {
  background-color: #4285f4!important;
  color: #fff!important;
}
.v-list-item--density-default.v-list-item--one-line.divider-item {
  min-height: 10px;
}
.header-list {
  max-height: 80vh
}
.v-toolbar .v-btn .v-icon {
  --v-icon-size-multiplier: 1;
}
.v-btn__overlay {
  display: none;
}
.v-toolbar .v-btn[aria-expanded="true"] {
  color: #4285f4;
}
</style>
