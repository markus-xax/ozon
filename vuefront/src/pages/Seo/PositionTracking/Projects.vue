<template>
  <v-container fluid
     class="pa-6"
  >
    <v-col
        md="12"
        lg="8"
        class="pa-0"
    >
      <position-tracking-toolbar
      ></position-tracking-toolbar>
      <v-alert type="info" variant="outlined" class="bg-white mb-4"><b>Обратите внимание!</b> Вы можете добавлять неограниченное кол-во SKU в рамках одного проекта.</v-alert>
      <position-projects-list></position-projects-list>
    </v-col>
  </v-container>
</template>

<script>
import PositionTrackingToolbar from "../../../components/PositionTrackingToolbar.vue"
import PositionProjectsList from "../../../components/PositionProjectsList.vue"

export default {
  name: 'Projects',
  components: {
    PositionTrackingToolbar,
    PositionProjectsList
  },
  methods: {
  }
}
</script>

<style>
.v-alert .v-alert__content {
  color: #404040;
  font-size: 13px;
}
</style>
