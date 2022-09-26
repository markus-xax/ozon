<template>
  <ag-grid-vue
      style="width: 100%;height: 400px;"
      class="ag-theme-alpine grid-mpstats"
      :rowData="rows"
      :columnDefs="columns"
  ></ag-grid-vue>
</template>

<script>
import "ag-grid-community/dist/styles/ag-grid.css"
import "ag-grid-community/dist/styles/ag-theme-alpine.css"
import { AgGridVue } from "ag-grid-vue3"
import {useSeoProjectsStore} from "../store/index.js"
// import TrashCellRenderer from './TrashCellRenderer.js'
import {mapState} from "pinia"

const deletePhraseComponent = `
  <span @click="alert(222)">ok</span>
`

window.positionParser = function positionParser(params) {
  console.log('valueParser', params.value)
  return Number(params.value)
}

export default {
  name: "WordsStat",
  data: () => ({
    panel: []
  }),
  components: {
    AgGridVue,
    deletePhraseComponent
  },
  props: {
    words: {
      type: Array
    }
  },
  computed: {
    rows () {
      let words = []
      this.words.forEach((item) => {
        let datesObj = {}
        item.positions.forEach((pos, k) => {
          let key = 'date' + k
          datesObj[key] = pos ? pos : ""
        })
        words.push({word: item.word, count: item.count, results: item.results, ...datesObj})
      })
      return words
    },
    columns () {
      const keywordRenderer = function keywordRenderer (params) {
        const {colDef, data} = params
        let svg = `<svg viewBox="0 0 16 16" @click="alert(111)" width="1em" height="1em" focusable="false" role="img" aria-label="search" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-search b-icon bi"><g><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></g></svg>`
        let svgTrash = `<svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="trash" xmlns="http://www.w3.org/2000/svg" fill="currentColor" className="bi-trash cursor-pointer delete-keyword text-muted ml-auto b-icon bi"><g><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></g></svg>`
        return `<div class="d-flex text-space-between"><a target="_blank" href="https://wildberries.ru/catalog/0/search.aspx?search=${params.value}&xsearch=true">${svg}</a><span class="text-truncate">${params.value}</span><div @click="alert(222)">${svgTrash}</div></div>`
      }

      let result = [
        { headerName: 'Ключевое слово', field: 'word', sortable: true, pinned: 'left', cellRendererFramework: 'TrashCellRenderer' },
        { headerName: 'Частота', field: 'count', sortable: true, pinned: 'left', width: 100 },
        { headerName: 'Результатов', field: 'results', sortable: true, pinned: 'left', width: 150 }
      ]

      this.periods.forEach((item, k) => {
       result.push({
         headerName: item,
         field: 'date' + k,
         sortable: true,
         valueGetter: (params) => {
           const {colDef, data} = params
           // console.log('data', data)
           // console.log('valueGetter', params.getValue(params.value.colDef))
           // console.log('dataField', data[colDef.field])
           return data[colDef.field]
         },
         // valueFormatter: positionsFormatter,
         cellRenderer: params => {
           const {colDef, data} = params
           const dates = Object.keys(data).filter((field) => /date/.test(field))
           if (/date0/.test(colDef.field)) return data[colDef.field]

           let prevColumn = (dates.indexOf(colDef.field) - 1)
           let prevValue = ''
           if (prevColumn) {
             prevValue = data[dates[prevColumn]]
           }
           let result = 0
           if (prevValue) {
            result = prevValue - data[colDef.field]
           }
           if (result !== 0) {
             let sign = result > 0 ? '+' : ''
             let color = /\+/.test(sign) ? 'green' : 'red'
             return `<div class="d-flex flex-row align-items-center"><span class="align-self-center">${data[colDef.field]}</span> <span class="ml-3 pa-2 text-center bg-${color}-lighten-5 align-self-center text-caption text-${color}">${sign}${result}</span></div>`
           }
           return data[colDef.field]
          }
       })
      })

      return result
    },
    ...mapState(useSeoProjectsStore, ['skuViewMode', 'skus', 'words', 'periods'])
  },
  watch: {
    skuViewMode (value) {
      this.words.forEach((word) => {

      })
      this.panel = value
    }
  },
  mounted () {
    console.log('words', this.words)
    console.log('this.periods', this.periods)
  }
}
</script>

<style scoped>

</style>
