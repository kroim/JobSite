<template>
    <section 
        :class="category.sectionClass + ' wt-haslayout  wt-main-section'"
        :id="category.sectionId" 
        :style="sectionStyle" 
        v-if="Object.entries(category).length != 0"
    >
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-sectionhead wt-textcenter">
                        <div class="wt-sectiontitle">
                            <h2 :style="{color:category.titleColor}" v-if="category.title">{{category.title}}</h2>
                            <span :style="{color:category.subtitleColor}" v-if="category.subtitle">{{category.subtitle}}</span>
                        </div>
                        <div class="wt-description" v-if="category.description" v-html="category.description"></div>
                    </div>
                </div>
                <div class="wt-categoryexpl">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 float-left" v-for="(cat, index) in categoryList" :key="index">
                        <div class="wt-categorycontent">
                            <figure><img :src="baseUrl+'/uploads/categories/'+ cat.image" :alt="cat.title"></figure>
                            <div class="wt-cattitle">
                                <h3><a :href="baseUrl+'/search-results?type='+ type+'&category%5B%5D='+cat.slug">{{ cat.title }}</a></h3>                            
                            </div>
                            <div class="wt-categoryslidup">
                                <p v-if="cat.abstract">{{ cat.abstract }}</p>
                                <a :href="baseUrl+'/search-results?type='+type+'&category%5B%5D='+cat.slug">{{ trans('lang.explore') }} <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
// import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'categories', 'pageID', 'howWorkContent', 'type'],
    data() {
        return {
            category:{},
            categoryList:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.category.padding ? `${this.category.padding.top}${this.category.padding.unit} ${this.category.padding.right}${this.category.padding.unit} ${this.category.padding.bottom}${this.category.padding.unit} ${this.category.padding.left}${this.category.padding.unit}` : '',
                margin: this.category.margin ? `${this.category.margin.top}${this.category.margin.unit} ${this.category.margin.right}${this.category.margin.unit} ${this.category.margin.bottom}${this.category.margin.unit} ${this.category.margin.left}${this.category.margin.unit}` : '',
                'text-align': this.category.alignment,
                background: this.category.sectionColor
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
        Event.$on('category-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        getCategories: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-categories")
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
