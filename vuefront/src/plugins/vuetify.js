// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import colors from 'vuetify/lib/util/colors.mjs'

// Vuetify
import { createVuetify } from 'vuetify'

const myLightTheme = {
    dark: false,
    variables: {
        input: {
            height: 10
        }
    },
    colors: {
        primary: '#5f99f5',
        background: '#eee',
        danger: '#d62516'
    }
}

export default createVuetify(
    {
        display: {
            mobileBreakpoint: 'sm',
            thresholds: {
                xs: 0,
                sm: 340,
                md: 540,
                lg: 1200,
                xl: 1440
            }
        },
        theme: {
            defaultTheme: 'myLightTheme',
            themes: {
                myLightTheme
            }
        },
        defaults: {
            global: {
                ripple: false
            },
        },
        options: {
            customProperties: true
        }
    }
  // https://vuetifyjs.com/en/introduction/why-vuetify/#feature-guides
)
