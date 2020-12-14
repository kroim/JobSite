<template>
  <content-loader
    :width="1140"
    :height="998"
    :speed="2"
    primaryColor="#f2eeee"
    secondaryColor="#c7c6c6"
  >
    <rect x="362" y="0" rx="2" ry="2" width="350" height="44" /> 
    <rect x="265" y="61" rx="2" ry="2" width="550" height="18" /> 
    <rect x="-9" y="94" rx="2" ry="2" width="1150" height="201" /> 
    <rect x="-1" y="297" rx="2" ry="2" width="1150" height="200" /> 
    <rect x="0" y="500" rx="2" ry="2" width="1150" height="200" /> 
    <rect x="-10" y="703" rx="2" ry="2" width="1150" height="200" /> 
    <rect x="465" y="911" rx="2" ry="2" width="160" height="50" />
  </content-loader>
</template>
<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>