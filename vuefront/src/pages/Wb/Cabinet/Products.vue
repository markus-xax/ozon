<template>
  <div class="card">
    <div class="card-body">
      <div class="w35">
        <div class="d-flex justify-content-between mt-3">
          <ag-grid-vue
              style="width: 100%;height: 400px;"
              class="ag-theme-alpine grid-mpstats"
              :columnDefs="columns"
              :rowData="products"
          ></ag-grid-vue>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { AgGridVue } from 'ag-grid-vue3'

import {mapActions, mapState} from "pinia"
import "ag-grid-community/dist/styles/ag-grid.css"
import "ag-grid-community/dist/styles/ag-theme-alpine.css"
import {useWbCabinetProductsStore} from "../../../store/index.js";

export default {
  name: "Products",
  components: {
    AgGridVue
  },
  data: () => ({
    columns: [
      {
        headerName: 'Активен', field: 'active'
      },
      {
        headerName: 'Теги', field: 'tags'
      },
      {
        headerName: 'ID товара', field: 'p_id'
      },
      {
        headerName: 'Артикул', field: 'nm_id'
      },
      {
        headerName: 'ts_name', field: 'ts_name'
      },
      {
        headerName: 'Название', field: 'name'
      },
      {
        headerName: 'brand', field: 'brand'
      },
      {
        headerName: 'Группа', field: 'category'
      },
      {
        headerName: 'sa_name', field: 'sa_name'
      },
      {
        headerName: 'Штрихкод', field: 'barcode'
      },
      {
        headerName: 'Рейтинг', field: 'rating'
      },
      {
        headerName: 'Оценка', field: 'commentsvaluation'
      },
      {
        headerName: 'Наличие', field: 'stlock_api_stock_count'
      },
      {
        headerName: 'Наличие на удаленном складе', field: 'stock_api_to_client'
      },
      {
        headerName: 'Остаток от клиента', field: 'stock_api_from_client'
      },
      {
        headerName: 'Остаток полный', field: 'stock_api_full_client'
      },
      {
        headerName: 'stock_parser_count', field: 'stock_parser_count'
      },
      {
        headerName: 'my_stock', field: 'my_stock'
      },
      {
        headerName: 'IN_TRANSIT', field: 'in_transit'
      },
      {
        headerName: 'multiplicity', field: 'multiplicity'
      },
      {
        headerName: 'Тип доставки', field: 'delivery_type'
      },
      {
        headerName: 'EXCLUDED', field: 'excluded'
      },
      {
        headerName: 'Стоимость', field: 'cost_price'
      },
      {
        headerName: 'Базовая цена', field: 'base_price'
      },
      {
        headerName: 'Цена со скидкой', field: 'price_after_discount'
      },
      {
        headerName: 'Цена итоговая', field: 'price_final'
      },
      {
        headerName: 'PRICE_AFTER-SPP', field: 'price_after_spp'
      },
      {
        headerName: 'StockPurchase', field: 'stock_purchase'
      },
      {
        headerName: 'Скидка', field: 'discount'
      },
      {
        headerName: 'price_promo', field: 'price_promo'
      },
      {
        headerName: 'price_spp', field: 'price_spp'
      },
      {
        headerName: 'Поставщик', field: 'supplier'
      },
      {
        headerName: 'days_in_stock', field: 'days_in_stock'
      },
      {
        headerName: 'last_day_stock', field: 'last_day_stock'
      },
      {
        headerName: 'Количество заказов', field: 'orders_count'
      },
      {
        headerName: 'Сумма заказов', field: 'orders_sum'
      },
      {
        headerName: 'Кол-во продаж', field: 'sales_count'
      },
      {
        headerName: 'Сумма продаж', field: 'sale_sum'
      },
      {
        headerName: 'sales_cost', field: 'sales_cost'
      },
      {
        headerName: 'Кол-во возвратов', field: 'returns_count'
      },
      {
        headerName: 'Сумма возвратов', field: 'returns_sum'
      },
      {
        headerName: 'Returns_cost', field: 'returns_cost'
      },
      {
        headerName: 'forwardlogisticsum', field: 'forwardlogisticsum'
      },
      {
        headerName: 'backwardlogisticsum', field: 'backwardlogisticsum'
      },
      {
        headerName: 'logistic_all', field: 'logistic_all'
      },
      {
        headerName: 'Комиссия', field: 'totalcomission'
      },
      {
        headerName: 'forpay', field: 'forpay'
      },
      {
        headerName: 'profit', field: 'profit'
      },
      {
        headerName: 'margin', field: 'margin'
      },
      {
        headerName: 'Рентабельность', field: 'rentable'
      },
      {
        headerName: 'orders_speed', field: 'orders_speed'
      },
      {
        headerName: 'sales_speed', field: 'sales_speed'
      },
      {
        headerName: 'oborot_sales', field: 'oborot_sales'
      },
      {
        headerName: 'oborot_orders', field: 'oborot_orders'
      },
      {
        headerName: 'График', field: 'sparkline'
      },
      {
        headerName: 'График заказов', field: 'sparkline_orders'
      },
      {
        headerName: 'График запросов', field: 'sparkline_observe'
      },
      {
        headerName: 'График цен', field: 'sparkline_prices'
      },
      {
        headerName: 'category_sparkline', field: 'category_sparkline'
      },
      {
        headerName: 'finished_orders', field: 'finished_orders'
      },
      {
        headerName: 'Оплачен', field: 'is_payed'
      },
      {
        headerName: 'Не оплачен', field: 'is_not_payed'
      },
      {
        headerName: 'finish_as_return', field: 'finish_as_return'
      },
      {
        headerName: 'is_payed_percent', field: 'is_payed_percent'
      },
      {
        headerName: 'is_payed_percent_after_returns', field: 'is_payed_percent_after_returns'
      },
      {
        headerName: 'average_delivery_cost', field: 'average_delivery_cost'
      },
      {
        headerName: 'abc_income', field: 'abc_income'
      },
      {
        headerName: 'abc_profit', field: 'abc_profit'
      },
      {
        headerName: 'abc_summary', field: 'abc_summary'
      },
      {
        headerName: 'empty_stock_days', field: 'empty_stock_days'
      },
      {
        headerName: 'sales_ret_sum', field: 'sales_ret_sum'
      },
      {
        headerName: 'empty_stock', field: 'empty_stock'
      },
      {
        headerName: 'lost_sales', field: 'lost_sales'
      },
      {
        headerName: 'lost_profit', field: 'lost_profit'
      },
      {
        headerName: 'out_of_stock_days', field: 'out_of_stock_days'
      },
      {
        headerName: 'category_last_count', field: 'category_last_count'
      },
      {
        headerName: 'Ставка (по-умолчанию)', field: 'default_comission'
      },
      {
        headerName: 'default_logistic', field: 'default_logistic'
      },
      {
        headerName: 'avg_commission_pr', field: 'avg_commission_pr'
      },
      {
        headerName: 'avg_commission_rub', field: 'avg_commission_rub'
      },
      {
        headerName: 'avg_profit', field: 'avg_profit'
      },
      {
        headerName: 'days_on_site', field: 'days_on_site'
      },
      {
        headerName: 'incorrect_seller', field: 'incorrect_seller'
      },
      {
        headerName: 'self_redemptions', field: 'self_redemptions'
      },
      {
        headerName: 'not_finished_orders', field: 'not_finished_orders'
      },
      {
        headerName: 'not_finished_orders_sum', field: 'not_finished_orders_sum'
      },
      {
        headerName: 'mps_rating', field: 'mps_rating'
      },
      {
        headerName: 'subject_ransom', field: 'subject_ransom'
      },
      {
        headerName: 'category_diff', field: 'category_diff'
      },
      {
        headerName: 'shtraf_sum', field: 'shtraf_sum'
      },
      {
        headerName: 'subject_name', field: 'subject_name'
      },
      {
        headerName: 'subject_id', field: 'subject_id'
      },
      {
        headerName: 'Остатки', field: 'stocks'
      },
    ]
  }),
  methods: {
    ...mapActions(useWbCabinetProductsStore,['fetchProducts'])
  },
  computed: {
    rows () {
      let result = [
        {
          name: 'Ok'
        }
      ]
      return result
    },
    ...mapState(useWbCabinetProductsStore, ['products'])
  },
  mounted () {
    this.fetchProducts()
  },
  beforeMount () {
    this.gridOptions = {}
  }
}
</script>

<style scoped>

</style>
