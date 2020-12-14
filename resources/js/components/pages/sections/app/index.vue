<template>
    <div  class="element-preview-wrapper" v-on:click="editElement">
        <style1 
        :app="app"
        :sectionStyle="sectionStyle"
        :pageID="pageID"
        :element_id="element_id"
        v-if="app.style == 'style1'">
        </style1>
        <style2 
        :app="app"
        :sectionStyle="sectionStyle"
        :pageID="pageID"
        :element_id="element_id"
        v-else-if="app.style == 'style2'">
        </style2>
        <style3
        :app="app"
        :sectionStyle="sectionStyle"
        :pageID="pageID"
        :element_id="element_id"
        v-else-if="app.style == 'style3'">
        </style3>
    </div>
</template>
<script>
import style1 from './style1'
import style2 from './style2'
import style3 from './style3'
export default {
    components:{style1, style2, style3},
    props:['parent_index', 'element_id', 'apps', 'pageID'],
    data() {
        return {
            url:APP_URL,
            app:{},
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.app.padding ? `${this.app.padding.top}${this.app.padding.unit} ${this.app.padding.right}${this.app.padding.unit} ${this.app.padding.bottom}${this.app.padding.unit} ${this.app.padding.left}${this.app.padding.unit}` : '',
                margin: this.app.margin ? `${this.app.margin.top}${this.app.margin.unit} ${this.app.margin.right}${this.app.margin.unit} ${this.app.margin.bottom}${this.app.margin.unit} ${this.app.margin.left}${this.app.margin.unit}` : '',
                'text-align': this.app.alignment,
                background: !this.app.background_image ? this.app.sectionColor : ''
            }
        },
        contentSectionStyle() {
            return {
                background:this.app.contentBackground,
                color:this.app.contentColor
            }
        },
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('app-section-update', (data) => {
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
        // var index = this.getArrayIndex(this.apps, 'id', this.element_id)
        // if (this.apps[index]) {
        //     this.app = this.apps[index]
        //     this.app.style = this.apps[index].style
        // }
        // this.app.parentIndex = this.parent_index
        var self = this
        setTimeout(function () {
            // console.log(self.apps)
            var index = self.getArrayIndex(self.apps, 'id', self.element_id)
            if (self.apps[index]) {
                self.app = self.apps[index]
            }
        }, 100);
    },   
};
</script>
