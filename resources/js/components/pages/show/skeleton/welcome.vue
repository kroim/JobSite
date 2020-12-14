<template>
   <content-loader
    :speed='2'
    :width='1140'
    :height='353'
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="102" y="57" rx="3" ry="3" width="250" height="22" /> 
    <rect x="4" y="123" rx="3" ry="3" width="475" height="69" /> 
    <rect x="144" y="226" rx="3" ry="3" width="167" height="50" /> 
    <rect x="717" y="57" rx="3" ry="3" width="250" height="22" /> 
    <rect x="601" y="123" rx="3" ry="3" width="475" height="69" /> 
    <rect x="761" y="226" rx="3" ry="3" width="167" height="50" />
  </content-loader>

</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>