<template>
    <div class="wt-bannerthree-form">
        <form class="wt-formtheme wt-form-service">
            <div class="wt-formtitlethree">
                <h3><span>{{slider.search_form_subtitle}}</span>{{slider.search_form_title}}</h3>
            </div>
            <fieldset>
                <div class="form-group">
                    <vue-bootstrap-typeahead
                        class="mb-4"
                        size="sm"
                        v-model="query"
                        :data="searchable_data"
                        :placeholder="placeholder"
                        :serializer="item => item.name"
                        ref="searchfield"
                        @input="watchSearchResults(types)"
                        inputClass="search-field"
                        @hit="recordSelected"
                    >
                        <template slot="suggestion" slot-scope="{ data, htmlText }">
                            <div class="d-flex align-items-center">
                                <span class="ml-4" v-html="htmlText"></span>
                            </div>
                            <input type="hidden" name="keyword" :value="data.slug" id="hidden_field">
                        </template>
                    </vue-bootstrap-typeahead>
                    <span v-if="is_show" class="no-record-span">{{no_record}}</span>
                </div>
                <div class="form-group">
                    <span class="wt-select">
                        <select v-model="types" v-on:change="getSearchableData(types), emptyField(types)">
                            <option v-for="(filter, index) in filters" :key="index" :value="filter.value">{{filter.title}}</option>
                        </select>
                    </span>
                </div>
                <div class="form-group">
                    <span class="wt-select">
                        <select 
                            class="locations" 
                            name="locations"
                            v-html="locations">
                        </select>
                    </span>
                </div>
                <div class="form-group wt-pricerange-group" v-if="types=='job' || types=='service'">
                    <h4>{{slider.price_range_title}}</h4>
                    <div class="wt-amountbox">
                        <input type="text" :value="symbol+start+'-'+symbol+end" id="wt-consultationfeeamount" readonly="">
                    </div>
                    <!-- <span>{{slider.listing_tagline}}</span> -->
                    <a-slider 
                        id="wt-pricerange"
                        class="wt-productrangeslider wt-themerangeslider"
                        range
                        :min="0" 
                        :max="max_value"
                        :reverse="reverse"
                        @change="onChange" 
                        :defaultValue="[0, max_value]"
                    />
                </div>
            </fieldset>
        </form>
        <div class="wt-bannerthreeform-footer">
            <a href="javascript:void(0);" class="wt-btntwo" v-on:click.prevent="submitSearchForm(types)">{{trans('lang.search_now')}}</a>
        </div>
    </div>
</template>
<script>
 export default{
    props: ['style_type', 'widget_type', 'no_record_message', 'placeholder', 'freelancer_placeholder', 'employer_placeholder', 'job_placeholder', 'service_placeholder', 'slider', 'symbol'],
        data(){
            return {
                reverse: false,
                selected_location:'',
                locations:'',
                filters:[],
                isActive: false,
                searchable_data:[],
                freelancers:[],
                employers:[],
                jobs:[],
                query:'',
                types:'freelancer',
                selected_type:'',
                no_record:this.no_record_message,
                is_show: false,
                related_results:false,
                url: APP_URL + '/search-results',
                type_change:false,
                start:0,
                end:1000,
                max_value:1000,
            }
        },
        methods: {
            onChange (value) {
                this.start = value[0]
                this.end = value[1]
            },
            displayFiltersName(type) {
                if(type == 'freelancer') {
                    this.selected_type = this.freelancer_placeholder;
                } else if(type == 'employer') {
                    this.selected_type = this.employer_placeholder;
                } else if(type == 'job') {
                    this.selected_type = this.job_placeholder;
                } else if(type == 'service') {
                    this.selected_type = this.service_placeholder;
                }
            },
            getFilters () {
                let self = this;
                axios.get(APP_URL + '/search/get-search-filtersV2')
                .then(function (response) {
                    if ( response.data.type == 'success') {
                        self.filters = response.data.result;
                    }
                });
            },
            getPriceRangeLimit () {
                let self = this;
                axios.get(APP_URL + '/search/get-price-limit')
                .then(function (response) {
                    self.max_value = response.data
                    self.end = response.data
                });
            },
            getLocations () {
                let self = this;
                axios.get(APP_URL + '/search/location-list')
                .then(function (response) {
                    self.locations = response.data;
                    setTimeout(function(){ 
                        jQuery("body select.locations").msDropDown();
                    }, 100);
                });
            },
            changeFilter(){
                this.type_change = true;
            },
            getSearchableData: function (type, newQuery) {
                this.displayFiltersName(type);
                let self = this;
                self.selected_location = jQuery("body select.locations").find(":selected").val()
                axios.post(APP_URL + '/search/get-searchable-data-v2',{
                    type:type, location:self.selected_location
                })
                .then(function (response) {
                    if (response.data.type == 'success') {
                        if (type == 'freelancer') {
                            self.searchable_data = response.data.searchables;
                        } else if (type == 'employer') {
                            self.searchable_data = response.data.searchables;
                        } else if (type == 'job') {
                            self.searchable_data = response.data.searchables;
                        } else if (type == 'service') {
                            self.searchable_data = response.data.searchables;
                        }
                    }
                });
            },
            emptyField:function(types){
                this.$refs.searchfield.inputValue = '';
                this.isActive = false;
            },
            watchSearchResults:function(types){
                if(jQuery('.wt-radioholder').css('display') == 'block') {
                    jQuery('.wt-radioholder').css("display", "none");
                }
                if ( !(jQuery('.list-group').hasClass( "input-searching" )) ) {
                    jQuery('.list-group').addClass('input-searching');
                }
                if(this.$refs.searchfield.$children[0].matchedItems == '') {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "block");
                    jQuery('.wt-related-result').remove();
                    this.is_show = true;
                } else {
                    let keyword = this.query;
                    var urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.get('type') && this.type_change == false) {
                        var type = urlParams.get('type');
                    } else {
                        var type = types;
                    }
                    if(type == 'Freelancers') {
                        type = 'freelancer';
                    } else if(type == 'Employers') {
                        type = 'employer';
                    } else if(type == 'Jobs') {
                        type = 'job';
                    } else if(type == 'Services') {
                        type = 'service';
                    }
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "none");
                    jQuery('.wt-related-result').remove();
                    var html = '<a href="'+this.url+'?s='+keyword+'&type='+type+'" class="wt-related-result"><span v-if="related_results">show all result related to'+' <em>'+ keyword+'</em></span></a>';
                    jQuery(".list-group").append(html);
                    this.related_results = true;
                    this.is_show = false;
                }
            },
            recordSelected:function(){
                if (jQuery('.list-group').hasClass( "input-searching" )) {
                    jQuery('.list-group').removeClass('input-searching');
                }
            },
            toggleDropdown: function(){
                if (this.isActive == false) {
                    this.isActive = true;
                    jQuery('.wt-related-result').remove();
                } else {
                    this.isActive = false;
                }
            },
            submitSearchForm: function(type) {
                this.selected_location = jQuery("body select.locations").find(":selected").val() 
                var minprice = this.start ? '&minprice='+this.start : '&minprice='+0
                var maxprice = this.end ? '&maxprice='+this.end : '&maxprice='+0
                var location = this.selected_location ? '&locations='+this.selected_location : ''
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('type') && this.type_change == false) {
                    var type = urlParams.get('type');
                }   else {
                        if(type == 'Freelancers') {
                            type = 'freelancer';
                        }   else if(type == 'Employers') {
                                type = 'employer';
                        }   else if(type == 'Jobs') {
                                type = 'job';
                        } else if(type == 'Services') {
                                type = 'service';
                        }
                }
                if (this.$refs.searchfield.inputValue != '') {
                    let slug = document.getElementById('hidden_field').value;
                    let keyword = this.query;
                    if (type == 'job') {
                        window.location.replace(APP_URL+'/job/'+slug);
                    } else if (type == 'service'){
                        window.location.replace(APP_URL+'/service/'+slug);
                    } 
                    else {
                        window.location.replace(APP_URL+'/profile/'+slug);
                    }
                } else {
                    if (type=='job'|| type=='service') {
                        window.location.replace(APP_URL+'/search-results?type='+type+location+minprice+maxprice);
                    } else {
                        window.location.replace(APP_URL+'/search-results?type='+type+location);
                    }
                }

            },
        },
        watch: {
            query: _.debounce(function(newQuery) { this.getSearchableData(newQuery) }, 250)
        },
        mounted: function () {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('type')) {
                var type = urlParams.get('type');
                this.displayFiltersName(type);
            }
            jQuery(".search-field").keydown(function(){
                var input = jQuery('.search-field');
                input.on('keydown', function() {
                    var key = event.keyCode || event.charCode;
                    if( key == 8 || key == 46 ) {
                        if(!jQuery(this).val()) {
                            jQuery(this).parents('.form-group').find('span.no-record-span').css("display", "none");
                        } else {
                            jQuery('.wt-related-result').remove();
                            this.is_show = true;
                        }
                    }
                });
            });
            if ($("body").hasClass("rtl")) {
                this.reverse = true
            }
        },
        created: function () {
            this.getFilters();
            this.getLocations();
            this.getPriceRangeLimit();
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('type')) {
                var type = urlParams.get('type');
                this.displayFiltersName(type);
                this.getSearchableData(type);
            } else {
                this.getSearchableData('freelancer');
            }
        }
    }
</script>
<style scoped>
@import '~ant-design-vue/lib/slider/style/index.css';
@import '~ant-design-vue/lib/tooltip/style/index.css';
</style>

<style>
.wt-radioholder{transition: 1s;}
.ant-slider-track{
	height: 2px;
	background: var(--terthemecolor);
}
.ant-slider-rail{
	background: #ddd;
	height: 2px;
}
.ant-slider-step{height: 2px;}
.ant-slider-handle{
    border: 2px solid var(--terthemecolor);
    width: 24px;
    height: 24px;
    margin-top: -11px;
}
.ant-slider-handle:focus{
	box-shadow: none;
    border-color: var(--terthemecolor);
}
.ant-slider:hover .ant-slider-track{
    background: var(--terthemecolor);
}
.ant-slider:hover .ant-slider-handle:not(.ant-tooltip-open){border-color: var(--terthemecolor);}
</style>