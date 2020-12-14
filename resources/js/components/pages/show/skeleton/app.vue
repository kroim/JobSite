<template>
  <content-loader
    :width="1140"
    :height="551"
    :speed="2"
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="40" y="27" rx="3" ry="3" width="350" height="500" /> 
    <rect x="476" y="36" rx="3" ry="3" width="300" height="36" /> 
    <rect x="476" y="101" rx="3" ry="3" width="500" height="18" /> 
    <rect x="476" y="180" rx="3" ry="3" width="540" height="78" /> 
    <rect x="476" y="299" rx="3" ry="3" width="540" height="78" /> 
    <rect x="476" y="433" rx="3" ry="3" width="170" height="78" /> 
    <rect x="701" y="433" rx="3" ry="3" width="170" height="78" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>