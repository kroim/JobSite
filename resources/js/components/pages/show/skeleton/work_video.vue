<template>
  <content-loader
    :width="1140"
    :height="666"
    :speed="2"
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="105" y="159" rx="3" ry="3" width="920" height="483" /> 
    <rect x="376" y="3" rx="3" ry="3" width="350" height="36" /> 
    <rect x="425" y="56" rx="3" ry="3" width="250" height="18" /> 
    <rect x="191" y="96" rx="3" ry="3" width="730" height="40" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>