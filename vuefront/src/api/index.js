import axios from 'axios'
import { useRouter, useRoute } from 'vue-router'
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'

const API_URL = import.meta.env.VITE_API_URL
const SEO_CONTROLLER = import.meta.env.VITE_SEO_CONTROLLER
const seoProjectsList = import.meta.env.VITE_SEO_PROJECTS_METHOD
const seoProjectMethodAdd = import.meta.env.VITE_SEO_PROJECT_ADD_METHOD
const seoProjectMethodDetail = import.meta.env.VITE_SEO_PROJECT_METHOD_DETAIL
const seoProjectsMethodUpdate = import.meta.env.VITE_SEO_PROJECT_UPDATE_METHOD
const seoProjectMethodSku = import.meta.env.VITE_SEO_PROJECT_SKU_METHOD
const seoProjectMethodLimit = import.meta.env.VITE_SEO_PROJECT_LIMIT_METHOD
const seoProjectMethodWords = import.meta.env.VITE_SEO_PROJECT_WORDS_METHOD
const seoProjectMethodSkus = import.meta.env.VITE_SEO_PROJECT_SKUS_METHOD
const seoProjectMethodProjectReport = import.meta.env.VITE_SEO_PROJECT_REPORT_METHOD
const seoProjectMethodName = import.meta.env.VITE_SEO_PROJECT_METHOD
const seoProjectMethodSkuReport = import.meta.env.VITE_SEO_PROJECT_ITEM_REPORT_METHOD
const seoProjectMethodDelete = import.meta.env.VITE_SEO_PROJECT_DELETE_METHOD
const seoProjectMethodSkuDelete = import.meta.env.VITE_SEO_PROJECT_SKU_METHOD_DELETE
const seoProjectMethodSkuAdd = import.meta.env.VITE_SEO_PROJECT_SKU_ADD_METHOD
const seoProjectMethodSkuData = import.meta.env.VITE_SEO_PROJECT_SKUDATA_METHOD
const seoProjectMethodSkuMove = import.meta.env.VITE_SEO_PROJECT_SKU_MOVE_METHOD
const seoProjectMethodSkuinfo = import.meta.env.VITE_SEO_PROJECT_SKUINFO_METHOD
const seoProjectMethodSkuUpdate = import.meta.env.VITE_SEO_PROJECT_SKU_UPDATE_METHOD
const seoProjectMethodRemoveWords = import.meta.env.VITE_SEO_WORDS_REMOVE_METHOD

export const seo = {
    projectsList: seoProjectsList,
    projectDetail: seoProjectMethodDetail,
    projectUpdate: seoProjectsMethodUpdate,
    methodSku: seoProjectMethodSku,
    methodLimit: seoProjectMethodLimit,
    methodWords: seoProjectMethodWords,
    methodSkus: seoProjectMethodSkus,
    methodSkudata: seoProjectMethodSkuData,
    methodSkuAdd: seoProjectMethodSkuAdd,
    methodSkuDelete: seoProjectMethodSkuDelete,
    methodProjectReport: seoProjectMethodProjectReport,
    methodProject: seoProjectMethodName,
    methodItemReport: seoProjectMethodSkuReport,
    methodProjectDelete: seoProjectMethodDelete,
    methodProjectAdd: seoProjectMethodAdd,
    methodSkuMove: seoProjectMethodSkuMove,
    methodSkuinfo: seoProjectMethodSkuinfo,
    methodSkuUpdate: seoProjectMethodSkuUpdate,
    methodWordsRemove: seoProjectMethodRemoveWords,

    async fetchProjects () {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.projectsList}`
        try {
            return await axios.get(endpoint, {
                method: 'GET',
                responseType: 'json',
                headers: {
                    cookies: 'PHPSESSID=a629ce474840d98b3f092b98441215f8'
                }
        }).then((response) => {
            return response
        })
        } catch (err) {
            return err
        }
    },

    async removeWords (fields) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodWordsRemove}`
        try {
            console.log('words', fields)
            return await axios.post(endpoint, fields).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },

    async updateProject (fields) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${this.projectUpdate}`
        try {
            return await axios.post(endpoint, fields).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async searchSku (sku) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodSku}/${sku}`
        // if (import.meta.env.PROD) endpoint += `/${sku}`
        try {
            return await axios.get(endpoint).then((response) => {
                //TODO: Добавить обработку ошибок и правильную обработку ответа, Изображение брать из ску - так оно не работает
                return response
            }).then((response) => {
                return response
            })
        } catch (err) {
            console.error(err)
            return err
        }
    },
    async fetchLimits () {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodLimit}`
        try {
            return await axios.get(endpoint).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async fetchWords (sku) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodWords}`

        endpoint += `/${sku}`
        // if (import.meta.env.PROD) endpoint += `/${sku}`
        try {
            return await axios.get(endpoint).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async fetchSkus (params) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodSkus}/${params.id}`
        if (this.methodSkudata) endpoint += `/${this.methodSkudata}`
        let query = new URLSearchParams()
       // if (import.meta.env.PROD && params.id) endpoint += `/${params.id}`
       //  if (import.meta.env.DEV && params.id) query.append('projectId', params.id)
        let bQuery = false
        if (params.d1) {
            query.append('d1', params.d1)
            bQuery = true
        }
        if (params.d2) {
            query.append('d2', params.d2)
            bQuery = true
        }
        if (bQuery) endpoint += '?' + query.toString()
        try {
            return await axios.get(endpoint).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async createProject (name) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodProjectAdd}`

        try {
            return await axios.post(endpoint, {
                'name': name
            }).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async fetchProjectReport (id) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${seoProjectMethodName}`
        if (import.meta.env.PROD) {
            endpoint += `${id}/`
        }
        endpoint += this.methodProjectReport

        try {
            return await axios.get(endpoint).then((response) => {
                console.log('responseProjectDownload', response)
                let blob = new Blob([response.data.result], { type: 'application/pdf' }),
                    url = window.URL.createObjectURL(blob)
                console.log('url', url)
                window.open(response.url)
                // return url
            })
        } catch (err) {
            return err
        }
    },
    async fetchItemReport (id, itemId) {
        let endpoint = `${SEO_CONTROLLER}${API_URL}${seoProjectMethodName}`
        if (import.meta.env.PROD) {
            endpoint += `${id}/item/${itemId}/`
        }
        endpoint += this.methodItemReport
        try {
            return await axios.get(endpoint).then((response) => {
                console.log('responseItemDownload', response)
                let blob = new Blob([response.result], { type: 'application/xlsx' }),
                    url = window.URL.createObjectURL(blob)

                window.open(url)
                return url
            })
        } catch (err) {
            return err
        }
    },
    async deleteProject (id) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${seoProjectMethodDelete}`

        try {
            return await axios.post(endpoint, {
                id
            }).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async deleteSku (id) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodSkuDelete}`

        try {
            return await axios.post(endpoint, {
                id
            }).then((response) => {
                return response.data
            })
        } catch (err) {
            return err
        }
    },
    async addSku(id, fields) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}project/${id}/addsku`
        try {
            return await axios.post(endpoint, fields).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async updateSku (id, fields) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodSkuUpdate}/${id}/addsku`
        console.log(id, fields)
        try {
            return await axios.post(endpoint, fields).then((response) => {
                return response
            })
        } catch (err) {
            return err
        }
    },
    async moveSku (id, projectId) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodSkuMove}`
        return await axios.post( endpoint, {id, project_id: projectId}).then((response) => {
            return response
        })
    },
    async fetchSkudata (id, skuid) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.projectDetail}/${id}/${this.methodSkudata}/${skuid}`
        return axios.get(endpoint).then((response) => {
            return response
        })
    },
    async fetchSkuinfo (sku) {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.methodSkuinfo}/${sku}`
        return await axios.get(endpoint).then((response) => {
            return response
        })
    }
}

export const wb = {
    async fetchProducts (params) {
        let products = await import('../db/products.json')
        return products.PRODUCTS
        // axios.get(endpoint).then((response) => {
        //     return response
        // })
    }
}

export const security = {
    securityAuthMethod: import.meta.env.VITE_SECURITY_AUTH_METHOD,
    async getAuth () {
        const endpoint = `${SEO_CONTROLLER}${API_URL}${this.securityAuthMethod}`
        return await axios.get(endpoint).then((response) => {
            return response
        })
    }
}
