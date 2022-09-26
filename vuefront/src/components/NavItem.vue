<template>
  <li
      :class="classList"
  >
    <a href="#" data-toggle="dropdown"
       class="nav-link"
       v-if="link.children && link.children.length"
       @click.prevent.self.stop="onClick"
    >
      {{ link.name }}
      <v-icon v-if="link.children && link.children.length" @click.prevent.stop="onClick">mdi-menu-down</v-icon>
    </a>
    <router-link v-else :to="link.action" v-text="link.name" class="nav-link"></router-link>
    <nav-children v-if="link.children && link.children.length" :items="link.children" @select="selectItem"></nav-children>
  </li>
</template>

<script>
import NavChildren from "./NavChildren.vue";
export default {
  name: "NavItem",
  components: {
    NavChildren
  },
  methods: {
    onClick (event) {
      this.$emit('input', event.target.closest('.dropdown'))
    },
    selectItem (target) {
      target.classList.remove('show')
    }
  },
  props: {
    cssClass: {
      type: String,
      default: () => 'nav-item text-center'
    },
    link: {
      type: Object,
      required: true
    }
  },
  computed: {
    classList (props) {
      let result = [props.cssClass]
      if (props.link.children && props.link.children.length) {
        result.push('dropdown')
      }

      return result
    }
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
  font-size: 14px;
}
.nav-link:focus,
.nav-link:active {
  color: #4285f4
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
.show .dropdown-menu {
  display: block;
}
</style>
