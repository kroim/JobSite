<template>
    <div>
        <style1 
            :slider="slider" 
            :page_id="page_id"
            v-if="this.slider.style == 'style1'">
        </style1>
        <style2 
           :page_id="page_id"
           v-if="this.slider.style == 'style2' && this.slider.parentIndex > 0">
        </style2>
        <style3 
            :page_id="page_id"
            v-if="this.slider.style == 'style3' && this.slider.parentIndex > 0">
        </style3>
        <style4 
            :slider="slider" 
            :page_id="page_id"
            :symbol="symbol"
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
    props:['parent_index', 'element_id', 'sliders', 'page_id', 'symbol'],
    data() {
        return {
            slider:{}
        }
    },
    methods:{
        getArrayIndex (array, attr, value) {
            for (var i = 0; i < array.length; i += 1) {
                if (array[i][attr] == value) {
                return i
                }
            }
            return -1
        },
    },
    created: function() {
        var index = this.getArrayIndex(this.sliders, 'id', this.element_id)
        if (this.sliders[index]) {
            this.slider = this.sliders[index]
        }
    },    
};
</script>
