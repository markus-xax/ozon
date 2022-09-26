import { defineStore } from 'pinia'
import { seo, security, wb } from '../api/index.js'

export const useSecurityStore = defineStore('security', {
  state: () => ({
    auth: false
  }),
  actions: {
    async getAuth () {
      return await security.getAuth().then((response) => {
        return response
      })
    }
  }
})

export const useSeoProjectsStore = defineStore('seoprojects', {
  state: () => ({
    projects: [],
    sku: {
      sku: '',
      brand: '',
      name: ''
    },
    filter: {
      name: ''
    },
    limits: {},
    words: [],
    skus: [],
    skuViewMode: 'all',
    periods: [],
    skuid: false
  }),
  actions: {
    async moveSku (id, projectId) {
      return await seo.moveSku(id, projectId).then((response) => {
        return response
      })
    },
    async fetchProjects (cb) {
      await seo.fetchProjects().then((response) => {
        this.projects = response.data
        return response.data
      }).catch((error) => {
        if (typeof cb === 'function')
          return cb(error)
      })

      return this.projects
    },
    async searchSku (value) {
      return await seo.searchSku(value).then((response) => {
        if (response.status === 200) {
          this.sku = response.data.result
        }
        if (response.status === 403) {
          throw new Error(response.result.error)
        }

        return response
      })
    },
    async addSku(id, fields) {
      // return await seo
      return await seo.addSku(id, fields).then((response) => {
        return response
      })
    },
    async fetchWords (sku) {
      return await seo.fetchWords(sku).then((response) => {
        if (response.status === 200)
          this.words = response.data.result

        return response
      })
    },
    async updateSku (id, fields) {
      return seo.updateSku(id, fields).then((response) => {
        return response
      })
    },
    async removeWords (fields) {
      return await seo.removeWords(fields).then((response) => {
        return response
      })
    },
    async updateProject (fields) {
      return await seo.updateProject(fields).then((response) => {
        this.fetchProjects()
        return response
      })
    },
    async createProject (name) {
      return await seo.createProject(name).then((data) => {
        return data
      })
    },
    async fetchLimits (state) {
      let that = this
      await seo.fetchLimits().then((response) => {
        that.limits = response.data
      })
    },
    async fetchSkudata (id, skuid) {
      return await seo.fetchSkudata(id, skuid).then((response) => {
        return response
      })
    },
    async fetchSkuinfo (sku) {
      return await seo.fetchSkuinfo(sku).then((response) => {
        this.sku = response.data.result
        return response
      })
    },
    async fetchSkus (params) {
      return await seo.fetchSkus(params).then((response) => {
        this.skus = response.data.items
        this.periods = response.data.periods
        return response.data
      })
    },
    async fetchProjectReport (id) {
      return await seo.fetchProjectReport(id).then((data) => {
        return data
      })
    },
    async fetchItemReport (id, itemId) {
      return await seo.fetchItemReport(id, itemId).then((data) => {
        return data
      })
    },
    async deleteProject (id) {
      return await seo.deleteProject(id).then((data) => {
        return data
      })
    },
    async deleteSku (id) {
      return await seo.deleteSku(id).then((data) => {
        return data
      })
    },
    resetSku () {
      this.sku = {
        sku: ''
      }
    },
    setFilterByName(value) {
      this.filter.name = value
    },
    setSkuView (value) {
      let mode = value > 0 ? 'all' : 'none'
      this.skuViewMode = mode
    }
  }
})

export const useWbCabinetProductsStore = defineStore('wbcabinetproducts', {
  state: () => ({
    products: [],
    profiles: []
  }),
  actions: {
    async fetchProducts (params) {
      return await wb.fetchProducts(params).then((response) => {
        this.products = response
        return response
      })
    }
  }
})
