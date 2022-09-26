<template>
  <div class="mp-loader-overlay ag-overlay"
       :class="{
        'hidden': !loading
       }"
       :aria-hidden="{
        'true': !loading,
        'false': loading
  }">
    <div class="ag-overlay-panel">
      <div class="ag-overlay-wrapper ag-layout-normal ag-overlay-loading-wrapper">
        <div class="mp-loader-static"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AgPreloader",
  props: {
    loading: {
      type: Boolean
    }
  }
}
</script>

<style scoped>
.mp-loader-overlay.ag-overlay {
  height: 100%;
  left: 0;
  pointer-events: none;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 10;
}
.mp-loader-overlay .ag-overlay-panel, .mp-loader-overlay .ag-overlay-wrapper {
  display: flex;
  height: 100%;
  width: 100%;
}
.mp-loader-overlay .ag-overlay-loading-wrapper {
  background-color: hsla(0,0%,100%,.66);
}
.mp-loader-overlay .ag-overlay-wrapper {
  flex: none;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.mp-loader-overlay .ag-overlay-wrapper {
  flex: none;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.ag-overlay-loading-wrapper {
  pointer-events: all;
}
.mp-loader-static {
  width: 75px;
  height: 75px;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: #59BB31;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
.mp-loader-static:before {
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  right: 5px;
  bottom: 5px;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: #78d152;
  -webkit-animation: spin 3s linear infinite;
  animation: spin 3s linear infinite;
}
.mp-loader-static:after {
  content: "";
  position: absolute;
  top: 15px;
  left: 15px;
  right: 15px;
  bottom: 15px;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: #9DE47f;
  -webkit-animation: spin 1.5s linear infinite;
  animation: spin 1.5s linear infinite;
}
</style>
