<template>
  <multilevel-nav-item v-for="(item, idx) of links" :key="idx" :menu="item">
  </multilevel-nav-item>
</template>

<script>
import MultilevelNavItem from '../components/MultilevelNavItem.vue'

export default {
  name: "TheNav",
  components: {
    MultilevelNavItem
  },
  data: () => ({
    links: [
      {
        name: 'Кабинет WB',
        children: [
          {
            name: 'Сводка',
            action: { name: '' },
            href: '/cabinet/summary'
          },
          {
            name: 'Продажи и заказы',
            action: { name: '' },
            href: '/cabinet/sales'
          },
          {
            name: 'Товары',
            action: { name: '' },
            href: '/cabinet/products'
          },
          {
            name: 'Раскладка по складам',
            action: { name: '' },
            href: '/cabinet/warehouses'
          },
          {
            name: 'География заказов',
            action: { name: '' },
            href: '/cabinet/order-region'
          },
          {},
          {
            name: 'Импорт себестоимости и параметров товара',
            action: { name: '' },
            href: '/cabinet/import/cost-price'
          },
          {
            name: 'Сравнение периодов',
            action: { name: '' },
            href: '/cabinet/compare'
          },
          {
            name: 'Расчет поставки',
            action: { name: '' },
            href: '/cabinet/income-calc'
          },
          {
          },
          {
            name: 'Еженедельные отчеты',
            action: { name: '' },
            href: '/cabinet/weekly-reports'
          },
          {
            name: 'Подключения',
            action: { name: '' },
            href: '/cabinet/connect'
          }
        ]
      },
      {
        name: 'SEO',
        children: [
          {
            name: 'Результаты поиска (SERP)',
            action: { name: '' },
            href: '/seo/keywords'
          },
          {
            name: 'Расширение запросов',
            action: { name: '' },
            href: '/seo/keywords/expanding'
          },
          {
            name: 'Подбор запросов',
            action: { name: '' },
            href: '/seo/keywords/selection'
          },
          {
            name: ''
          },
          {
            name: 'Мониторинг позиций',
            action: { name: 'position-tracking-projects' }
          },
          {
            name: 'Проверка карточки товара',
            action: { name: '' },
            href: '/seo/tools/wb-card-checker'
          },
          {
            name: 'Сравнение групп SKU',
            action: { name: '' },
            href: '/seo/tools/wb-sku-compare'
          },
          {},
          {
            name: 'Заказать SEO',
            highlight: true,
            action: { name: '' },
            href: '/consult-request'
          }
        ]
      },
      {
        name: 'Студия',
        action: {
          name: 'default'
        },
        href: '/studio'
      },
      {
        name: 'Ozon',
        children: [
          {
            name: 'Категории',
            action: { name: '' },
            href: '/ozon/category?url='
          },
          {
            name: 'Продавцы',
            action: { name: '' },
            href: '/ozon/seller'
          },
          {
            name: 'Бренды',
            action: { name: '' },
            href: '/ozon/brand'
          },
          {
            name: 'Поиск по SKU',
            action: { name: '' },
            href: '/ozon/search'
          }
        ]
      },
      {
        name: 'Wildberries',
        children: [
          {
            name: 'Выбор ниши',
            isnew: true,
            action: { name: '' },
            href: '/wb/subject'
          },
          {
            name: 'Категории',
            action: { name: '' },
            href: '/wb/category?url='
          },
          {},
          {
            name: 'Поиск на площадке',
            action: { name: '' },
            href: '/wb/bysearch'
          },
          {
            name: 'Продавцы',
            action: { name: '' },
            href: '/wb/seller'
          },
          {
            name: 'Бренды',
            action: { name: '' },
            href: '/wb/brand'
          },
          {
            name: 'Похожие товары',
            action: { name: '' },
            href: '/wb/similar'
          },
          {
            name: 'Поиск по SKU',
            action: { name: '' },
            href: '/wb/search'
          },
          {},
          {
            name: 'Анализ характеристик SKU',
            isnew: true,
            action: { name: '' },
            href: '/wb/tools/attribute-report'
          },
          {
            name: 'Проверка рекламной ставки',
            action: { name: '' },
            href: '/wb/tools/check-rates'
          },
          {},
          {
            name: 'Рейтинг брендов',
            action: { name: '' },
            href: '/wb/top-brands'
          },
          {
            name: 'Рейтинг поставщиков',
            action: { name: '' },
            href: '/wb/top-sellers'
          }
        ]
      },
      {
        name: 'Инструменты',
        children: [
          {
            name: 'Плагин Chrome',
            action: { name: '' },
            href: '/chrome-plugin'
          },
          {
            name: 'Группы',
            action: { name: '' },
            href: '/groups'
          }
        ]
      },
      {
        name: 'Возможности',
        children: [
          {
            name: 'Обучение',
            action: { name: '' },
            href: '/learning'
          },
          {
            name: 'Вакансии',
            action: { name: '' },
            href: '/vacancy'
          },
          {
            name: 'Сообщество',
            action: { name: '' },
            href: '/mpsellers'
          }
        ]
      },
    ]
  }),
  methods: {
  }
}
</script>

