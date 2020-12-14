<template>
  <content-loader
    :width="1903"
    :height="829"
    :speed="2"
    primaryColor="#f2eeee"
    secondaryColor="#c7c6c6"
  >
    <rect x="805" y="2" rx="2" ry="2" width="350" height="44" /> 
    <rect x="705" y="69" rx="2" ry="2" width="550" height="18" /> 
    <rect x="29" y="138" rx="2" ry="2" width="346" height="559" /> 
    <rect x="409" y="137" rx="2" ry="2" width="346" height="559" /> 
    <rect x="788" y="137" rx="2" ry="2" width="346" height="559" /> 
    <rect x="1168" y="136" rx="2" ry="2" width="346" height="559" /> 
    <rect x="1544" y="131" rx="2" ry="2" width="346" height="559" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>