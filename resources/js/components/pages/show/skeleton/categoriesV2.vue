<template>
  <content-loader
    :width="1140"
    :height="737"
    :speed="2"
    primaryColor="#f2eeee"
    secondaryColor="#c7c6c6"
  >
    <rect x="359" y="4" rx="2" ry="2" width="350" height="44" /> 
    <rect x="261" y="66" rx="2" ry="2" width="550" height="18" /> 
    <rect x="4" y="119" rx="2" ry="2" width="276" height="300" /> 
    <rect x="282" y="118" rx="2" ry="2" width="276" height="300" /> 
    <rect x="562" y="118" rx="2" ry="2" width="276" height="300" /> 
    <rect x="840" y="117" rx="2" ry="2" width="276" height="300" /> 
    <rect x="5" y="424" rx="2" ry="2" width="276" height="300" /> 
    <rect x="283" y="422" rx="2" ry="2" width="276" height="300" /> 
    <rect x="562" y="420" rx="2" ry="2" width="276" height="300" /> 
    <rect x="841" y="421" rx="2" ry="2" width="276" height="300" />
  </content-loader>
</template>
<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>
