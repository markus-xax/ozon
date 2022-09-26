export const PhraseCellRenderer = {
    name: 'PhraseCellRenderer',
    template: `
      <div>
      <span>334</span>
        <span>{{ cellValue }}</span>
      <span>12132</span>
      </div>
    `,
    data: () => ({
        cellValue: null
    }),
    beforeMount () {
        let value = this.getValueToDisplay(this.params)
        console.log('cellvalue', value)
        this.cellValue = value
    },
    mounted () {

    },
    methods: {
        getValueToDisplay (params) {
            console.log('params', params)
            return params.valueFormatted ? params.valueFormatted : params.value
        }
    }
}

export default PhraseCellRenderer
