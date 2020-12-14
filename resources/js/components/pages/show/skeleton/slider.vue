<template>
    <content-loader 
    :speed='2'
    :width='1920'
    :height='694'
    secondaryColor="#f2eeee"
    primaryColor="#c7c6c6"
  >
    <rect x="7" y="20" rx="0" ry="0" width="1920" height="694" />
  </content-loader>
</template>
<script>
import { ContentLoader } from 'vue-content-loader'

export default {
    props:['items'],
    components: { 
        ContentLoader
    },
}
</script>