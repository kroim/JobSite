<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="category.sectionClass + ' wt-haslayout  wt-main-section wt-bg-holder wt-categories-wrap'"
            :id="category.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(category).length != 0"
        >
            <div class="wt-overlay-1" :style="[newBgImage ?
                {'background-image': 'url('+tempUrl+category.backgroundImg+')'} :
                pageID && category.backgroundImg ?
                {'background-image': 'url('+imageUrl+category.backgroundImg+')'} : '']">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="wt-categories-holder">
                            <div class="wt-sectionheadvtwo">
                                <div class="wt-sectiontitlevtwo">
                                    <span :style="{color:category.subtitleColor}" v-if="category.subtitle">{{category.subtitle}}</span>
                                    <h2 :style="{color:category.titleColor}">{{category.title}} 
                                        <em :style="{color:category.titleTwoColor}">{{category.titleTwo}} </em>
                                    </h2>
                                </div>
                                <div class="wt-description" v-html="category.description">
                                </div>
                                <div class="wt-btnarea">
                                    <a :href="category.showAllBtnUrl" class="wt-btntwo">{{ trans('lang.show_all') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <ul class="wt-categoryvtwo">
                            <li v-for="(cat, index) in categoryList.slice(0, 4)" :key="index">
                                <div class="wt-categorycontentvtwo">
                                    <figure><img :src="baseUrl+'/uploads/categories/'+ cat.image" :alt="cat.title"></figure>
                                    <div class="wt-cattitlevtwo">
                                        <h4><a :href="baseUrl+'/search-results?type='+ type+'&category%5B%5D='+cat.slug">{{ cat.title }}</a></h4>
                                    </div>
                                    <div class="wt-description">
                                        <p v-if="cat.abstract">{{ cat.abstract }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'categories', 'pageID', 'howWorkContent', 'type'],
    data() {
        return {
            category:{},
            categoryList:[],
            isActive:false,
            baseUrl: APP_URL,
            newBgImage:false,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.category.padding ? `${this.category.padding.top}${this.category.padding.unit} ${this.category.padding.right}${this.category.padding.unit} ${this.category.padding.bottom}${this.category.padding.unit} ${this.category.padding.left}${this.category.padding.unit}` : '',
                margin: this.category.margin ? `${this.category.margin.top}${this.category.margin.unit} ${this.category.margin.right}${this.category.margin.unit} ${this.category.margin.bottom}${this.category.margin.unit} ${this.category.margin.left}${this.category.margin.unit}` : '',
                'text-align': this.category.alignment,
                background: !this.category.backgroundImg ? this.category.sectionColor : ''
            }
        },
        contentSectionStyle() {
            return {
                background:this.category.contentBackground,
                color:this.category.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.categories, 'id', this.element_id)
        if (this.category[index]) {
            this.category = this.category[index]
        }
        this.category.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('category-sectionV3-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        Event.$on('new-category-bg-image'+self.element_id, (data) => {
            this.newBgImage = true
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        getCategories: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-seven-categories")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.categoryList =response.data.categories
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.categories, 'id', self.element_id)
            if (self.categories[index]) {
                self.category = self.categories[index]
            }
        }, 100);
        this.getCategories()
    },
};
</script>
