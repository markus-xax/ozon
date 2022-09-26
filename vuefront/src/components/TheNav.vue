<template>
  <ul class="d-flex flex-row">
    <nav-item class="nav-item pl-4 pr-4"
        v-for="(link, id) of links"
        :key="id"
        :link="link"
        @input="onSelect"
    >
    </nav-item>
  </ul>
</template>

<script>
import NavItem from '../components/NavItem.vue'
export default {
  name: "TheNav",
  components: {
    NavItem
  },
  data: () => ({
    links: [
      {
        name: 'Кабинет WB',
        children: [
          {
            name: 'Сводка',
            action: { name: 'default' }
          },
          {
            name: 'Продажи',
            action: { name: 'default' }
          }
        ]
      },
      {
        name: 'SEO',
        children: [
          {
            name: 'Результаты поиска (SERP)',
            action: { name: 'position-tracking-projects' }
          },
          {
            name: 'Расширение запросов',
            action: { name: 'position-tracking-projects' }
          },
          {
            name: 'Подбор запросов',
            action: { name: 'position-tracking-projects' }
          },
          {
            name: ''
          },
          {
            name: 'Мониторинг позиций',
            action: { name: 'position-tracking-projects' }
          }
        ]
      },
      {
        name: 'Студия',
        action: {
          name: 'default'
        }
      }
    ]
  }),
  methods: {
    onSelect (value) {
      const children = Array.from(value.parentNode.children).filter((item) => (item !== value && item.classList.contains('dropdown')))
      children.map((item) => item.classList.remove('show'))
      value.classList.toggle('show')
    }
  }
}
</script>

