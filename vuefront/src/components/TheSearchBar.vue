<template>
  <div class="search-container mr-3">
  <v-row class="mr-0">
    <input
        type="text"
        height="30"
        class="search-field"
        placeholder="Поиск по товарам..."
    >
    <button
        class="col-3 btn btn-primary d-flex justify-center"
    >Поиск</button>
  </v-row>
  </div>
</template>

<script>
export default {
  name: 'TheSearchBar'
}
</script>

<style>
input[type="text"].search-field {
  padding: 4px 12px;
  height: 37px;
  margin: 0 0 0 auto;
  border: 1px solid #d5d8de;
  border-right: 0;
  outline: none;
  font-size: 13px;
}
.btn-primary {
  color: #fff;
  -webkit-box-shadow: inset 0 -1px 0 #1266f1;
  box-shadow: inset 0 -1px 0 #1266f1;
  background-color: #4c8bf5;
  border-color: #4c8bf5;
  border-bottom-color: #1266f1;
}
input[type="text"].search-field:focus {
  border-color: #4285f4;
}
.search-container .btn {
  height: 37px;
  padding: 4px 12px;
  border-radius: 0;
  line-height: 28px;
  font-size: 13px;
  font-weight: 600;
}
.search-container {
  padding: 10px 0;
  position: relative;
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  display: inline-block;
}
</style>
