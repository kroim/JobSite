<template>
    <div class="heading-section-wrapper" :class="heading.sectionClass" :id="heading.sectionId" v-bind:style="sectionStyle" v-if="Object.entries(heading).length != 0">
        <div class="container" v-if="heading.link">
            <h1 v-if="this.heading.tag == 'h1'" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                <a :href="heading.url" v-if="heading.link" :target="heading.action" v-bind:style="linkStyle">{{this.heading.title}}</a>
            </h1>
            <h2 v-else-if="this.heading.tag == 'h2'" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                <a :href="heading.url" v-if="heading.link" :target="heading.action" v-bind:style="linkStyle">{{this.heading.title}}</a>
            </h2>
            <h3 v-else-if="this.heading.tag == 'h3'" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                <a :href="heading.url" v-if="heading.link" :target="heading.action" v-bind:style="linkStyle">{{this.heading.title}}</a>
            </h3>
            <h4 v-else-if="this.heading.tag == 'h4'" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                <a :href="heading.url" v-if="heading.link" :target="heading.action" v-bind:style="linkStyle">{{this.heading.title}}</a>
            </h4>
            <h5 v-else-if="this.heading.tag == 'h5'" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                <a :href="heading.url" v-if="heading.link" :target="heading.action" v-bind:style="linkStyle">{{this.heading.title}}</a>
            </h5>
            <h6 v-else-if="this.heading.tag == 'h6'" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                <a :href="heading.url" v-if="heading.link" :target="heading.action" v-bind:style="linkStyle">{{this.heading.title}}</a>
            </h6>
        </div>
        <div class="container" v-else>
            <h1 v-if="this.heading.tag == 'h1'" v-bind:style="headingStyle" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">
                {{this.heading.title}}
            </h1>
            <h2 v-else-if="this.heading.tag == 'h2'" v-bind:style="headingStyle" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">{{this.heading.title}}</h2>
            <h3 v-else-if="this.heading.tag == 'h3'" v-bind:style="headingStyle" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">{{this.heading.title}}</h3>
            <h4 v-else-if="this.heading.tag == 'h4'" v-bind:style="headingStyle" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">{{this.heading.title}}</h4>
            <h5 v-else-if="this.heading.tag == 'h5'" v-bind:style="headingStyle" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">{{this.heading.title}}</h5>
            <h6 v-else-if="this.heading.tag == 'h6'" v-bind:style="headingStyle" v-bind:class="[isActive ? 'activeClass' : '', heading.elementClass]" :id="heading.elementId">{{this.heading.title}}</h6>
        </div>
    </div>
</template>
<script>
// import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'heading_section'],
    data() {
        return {
            heading:{},
            isActive:false
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: `${this.heading.padding.top}${this.heading.padding.unit} ${this.heading.padding.right}${this.heading.padding.unit} ${this.heading.padding.bottom}${this.heading.padding.unit} ${this.heading.padding.left}${this.heading.padding.unit}`,
                margin: `${this.heading.margin.top}${this.heading.margin.unit} ${this.heading.margin.right}${this.heading.margin.unit} ${this.heading.margin.bottom}${this.heading.margin.unit} ${this.heading.margin.left}${this.heading.margin.unit}`,
                'text-align': this.heading.alignment,
            }
        },
        linkStyle() {
            return {
                color : this.heading.color,
            }
        },
        headingStyle() {
            return {
                'text-align': this.heading.alignment,
                color : this.heading.color,
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.heading_section, 'id', this.element_id)
        if (this.heading_section[index]) {
            this.heading = this.heading_section[index]
        }
        this.heading.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('heading-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.heading_section, 'id', self.element_id)
            if (self.heading_section[index]) {
                self.heading = self.heading_section[index]
            }
            self.heading.id = self.element_id
        }, 100);
    },
};
</script>
