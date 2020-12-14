<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <style1 
            :slider="slider" 
            :pageID="pageID"
            :element_id="element_id"
            v-if="this.slider.style == 'style1'">
        </style1>
        <style2 
            :slider="slider" 
            :pageID="pageID"
            :element_id="element_id"
            v-if="this.slider.style == 'style2'">
        </style2>
        <style3 
            :slider="slider" 
            :pageID="pageID"
            :element_id="element_id"
            v-if="this.slider.style == 'style3'">
        </style3>
        <style4 
            :slider="slider" 
            :pageID="pageID"
            :element_id="element_id"
            v-if="this.slider.style == 'style4'">
        </style4>
    </div>
</template>
<script>
import style1 from './style1'
import style2 from './style2'
import style3 from './style3'
import style4 from './style4'
export default {
    components: {style1, style2, style3, style4},
    props:['parent_index', 'element_id', 'sliders', 'pageID'],
    data() {
        return {
            slider:{}
        }
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('slider-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
    },
    created: function() {
         var self = this
        setTimeout(function () {
            var index = self.getArrayIndex(self.sliders, 'id', self.element_id)
            if (self.sliders[index]) {
                self.slider = self.sliders[index]
            }
        }, 100);
    },    
};
</script>
