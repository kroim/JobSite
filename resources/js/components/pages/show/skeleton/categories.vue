<template>
  <content-loader
    :speed='2'
    :width='1140'
    :height='747'
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="369" y="15" rx="3" ry="3" width="350" height="36" /> 
    <rect x="423" y="68" rx="3" ry="3" width="250" height="18" /> 
    <rect x="314" y="112" rx="3" ry="3" width="500" height="39" /> 
    <rect x="19" y="195" rx="3" ry="3" width="255" height="255" /> 
    <rect x="299" y="189" rx="3" ry="3" width="255" height="255" /> 
    <rect x="578" y="184" rx="3" ry="3" width="255" height="255" /> 
    <rect x="862" y="180" rx="3" ry="3" width="255" height="255" /> 
    <rect x="18" y="475" rx="3" ry="3" width="255" height="255" /> 
    <rect x="303" y="471" rx="3" ry="3" width="255" height="255" /> 
    <rect x="581" y="467" rx="3" ry="3" width="255" height="255" /> 
    <rect x="861" y="464" rx="3" ry="3" width="255" height="255" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>