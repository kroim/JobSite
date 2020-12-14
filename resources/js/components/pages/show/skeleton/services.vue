<template>
  <content-loader
    :width="1140"
    :height="1036"
    :speed="2"
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="4" y="229" rx="3" ry="3" width="350" height="382" /> 
    <rect x="355" y="1" rx="3" ry="3" width="350" height="36" /> 
    <rect x="301" y="62" rx="3" ry="3" width="500" height="18" /> 
    <rect x="196" y="105" rx="3" ry="3" width="730" height="100" /> 
    <rect x="392" y="227" rx="3" ry="3" width="350" height="382" /> 
    <rect x="784" y="225" rx="3" ry="3" width="350" height="382" /> 
    <rect x="7" y="632" rx="3" ry="3" width="350" height="382" /> 
    <rect x="392" y="629" rx="3" ry="3" width="350" height="382" /> 
    <rect x="784" y="625" rx="3" ry="3" width="350" height="382" />
  </content-loader>
</template>
<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>