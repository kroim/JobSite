<template>
    <vue-dropzone :options="this.option" :id="this.id" :useCustomSlot=true :ref="this.img_ref">
        <div class="form-group form-group-label">
            <div class="wt-labelgroup">
                <label for="file">
                    <span class="wt-btn">{{ trans('lang.select_files') }}</span>
                </label>
                <span>{{ trans('lang.drop_files') }}</span>
            </div>
        </div>
    </vue-dropzone> 
</template>
<style scoped>
@import '~vue2-dropzone/dist/vue2Dropzone.min.css';
</style>
<script>
import vue2Dropzone from 'vue2-dropzone'
export default {
    props: ['option', 'id', 'img_ref'],    
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function () {
        return {
        dropzoneOptions: this.option
        }
    }
}
</script>