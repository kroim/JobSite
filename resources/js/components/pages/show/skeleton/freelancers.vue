<template>
  <content-loader
    :width="1140"
    :height="664"
    :speed="2"
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="10" y="201" rx="3" ry="3" width="255" height="457" /> 
    <rect x="376" y="3" rx="3" ry="3" width="350" height="36" /> 
    <rect x="430" y="56" rx="3" ry="3" width="250" height="18" /> 
    <rect x="191" y="97" rx="3" ry="3" width="730" height="80" /> 
    <rect x="282" y="201" rx="3" ry="3" width="255" height="457" /> 
    <rect x="554" y="201" rx="3" ry="3" width="255" height="457" /> 
    <rect x="826" y="201" rx="3" ry="3" width="255" height="457" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>