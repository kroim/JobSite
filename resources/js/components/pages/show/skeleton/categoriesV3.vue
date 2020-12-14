<template>
  <content-loader
    :width="1140"
    :height="570"
    :speed="2"
    primaryColor="#f2eeee"
    secondaryColor="#c7c6c6"
  >
    <rect x="12" y="137" rx="2" ry="2" width="280" height="44" /> 
    <rect x="12" y="285" rx="2" ry="2" width="450" height="80" /> 
    <rect x="1168" y="136" rx="2" ry="2" width="346" height="559" /> 
    <rect x="1544" y="131" rx="2" ry="2" width="346" height="559" /> 
    <rect x="12" y="415" rx="2" ry="2" width="160" height="50" /> 
    <rect x="591" y="11" rx="20" ry="20" width="255" height="255" /> 
    <rect x="866" y="32" rx="20" ry="20" width="255" height="255" /> 
    <rect x="593" y="280" rx="20" ry="20" width="255" height="255" /> 
    <rect x="869" y="300" rx="20" ry="20" width="255" height="255" /> 
    <rect x="12" y="206" rx="2" ry="2" width="350" height="44" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>