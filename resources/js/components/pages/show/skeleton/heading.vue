<template>
  <content-loader
    :speed='2'
    :width='1110'
    :height='75'
    primaryColor="#f6f4f4"
    secondaryColor="#d1cccc"
  >
    <rect x="15" y="-3" rx="3" ry="3" width="1080" height="75" />
  </content-loader>
</template>

<script>
  import { ContentLoader } from "vue-content-loader"

  export default {
    components: { ContentLoader }
  }
</script>
