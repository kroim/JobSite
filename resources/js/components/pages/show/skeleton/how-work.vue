<template>
  <content-loader
    :speed='2'
    :width='1110'
    :height='365'
    primaryColor="#f8f7f7"
    secondaryColor="#ecebeb"
  >
    <rect x="443" y="-2" rx="3" ry="3" width="281" height="50" /> 
    <circle cx="208" cy="209" r="44" /> 
    <rect x="247" y="77" rx="3" ry="3" width="730" height="52" /> 
    <circle cx="599" cy="209" r="44" /> 
    <circle cx="971" cy="209" r="44" /> 
    <rect x="11" y="298" rx="3" ry="3" width="350" height="30" /> 
    <rect x="426" y="298" rx="3" ry="3" width="350" height="30" /> 
    <rect x="851" y="298" rx="3" ry="3" width="350" height="30" />
  </content-loader>
</template>
<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader },
  }
</script>