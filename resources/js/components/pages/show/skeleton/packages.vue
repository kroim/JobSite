<template>
  <content-loader
    :width="1140"
    :height="753"
    :speed="2"
    primaryColor="#f2eeee"
    secondaryColor="#c7c6c6"
  >
    <rect x="393" y="3" rx="2" ry="2" width="350" height="44" /> 
    <rect x="300" y="69" rx="2" ry="2" width="550" height="18" /> 
    <rect x="5" y="192" rx="2" ry="2" width="360" height="552" /> 
    <rect x="1168" y="136" rx="2" ry="2" width="346" height="559" /> 
    <rect x="1544" y="131" rx="2" ry="2" width="346" height="559" /> 
    <rect x="367" y="110" rx="2" ry="2" width="410" height="55" /> 
    <rect x="391" y="191" rx="2" ry="2" width="360" height="552" /> 
    <rect x="775" y="192" rx="2" ry="2" width="360" height="552" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>