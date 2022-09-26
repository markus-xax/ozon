<template>
  <div class="sku-info d-flex justify-start" v-if="loading">
    <div
        class="skeletor__card mb-5 bg-white pa-3 v-col">
      <skeletor class="mb-3" width="40%"></skeletor>
      <skeletor class="mb-3" width="65%"></skeletor>
      <skeletor class="mb-3" width="60%"></skeletor>
      <skeletor class="mb-3" width="60%"></skeletor>
      <skeletor class="mb-3" width="80%"></skeletor>
      <skeletor width="30%"></skeletor>
    </div>
  </div>
  <div class="sku-info d-flex justify-start" v-else>
    <div class="sku-image" v-if="sku.image && sku.image.t">
      <img :src="sku.image.t" class="mr-3" alt="" style="height: 105px">
    </div>
    <div class="product-sku-info sku-data mb-5">
      <svg
          @click="clearSku"
          viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img"
          aria-label="x circle" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          class="bi-x-circle position-absolute cursor-pointer b-icon bi" style="right: 0px; font-size: 150%;">
        <g>
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
          <path
              d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
        </g>
      </svg>
      <p class="sku-name" v-text="sku.name"></p>
      <p class="sku-seller">
        Продавец: <a :href="`/wb/seller?supplierId=${sku.supplierId}`" v-text="sku.seller"></a>
      </p>
      <p class="sku-brand">
        Бренд: <a :href="`/wb/brand?brand=${sku.brand}`" v-text="sku.brand"></a>
      </p>
      <p class="sku-sku">
        Артикул: <a :href="`/wb/item/${sku.sku}`" v-text="sku.sku"></a>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "SkuDetails",
  props: {
    sku: {
      type: Object
    },
    loading: {
      type: Boolean
    }
  }
}
</script>

<style scoped>

</style>
