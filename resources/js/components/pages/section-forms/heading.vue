<template>
    <div class="element-form-wrapper" v-if="headings">
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"><h3>{{ trans('lang.content') }}</h3></div>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group"><input type="text" v-model="headings.title" :placeholder="trans('lang.title')" class="form-control"></div>
                <div class="form-group">
                    <span class="amt-checkbox">
                        <input id="at-headingLink" type="checkbox" v-model="headings.link" value="1"> 
                        <label for="at-headingLink">{{ trans('lang.add_link') }}</label>
                    </span>
                </div>
                <div class="form-group" v-if="headings.link"><input type="text" v-model="headings.url" placeholder="type url" class="form-control">
                    <span class="amt-checkbox" v-if="headings.link">
                        <input id="at-headingAction" type="checkbox" v-model="headings.action" value="blank"> 
                        <label for="at-headingAction">{{ trans('lang.open_in_new_window') }}</label>
                    </span>
                </div>
                <div class="form-group">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.html_tag') }}</h6>
                        <div class="amt-element-content">
                            <div class="amt-select">
                                <select class="form-control" name="parent_id" v-model="headings.tag">
                                    <option v-for="(tag, index) in getHeadingTags()" :key="index" :value="tag">{{tag}}</option> 
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.alignment') }}</h6>
                    </div>
                    <ul class="amt-guestsinfo">
                        <li> 
                            <div class="amt-guests-radioholder">
                                <span class="amt-radio"><input id="at-left" type="radio" v-model="headings.alignment" value="left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                <span class="amt-radio"><input id="at-center" type="radio" v-model="headings.alignment" value="center"> <label for="at-center">{{ trans('lang.center') }}</label></span>   
                                <span class="amt-radio"><input id="at-right" type="radio" v-model="headings.alignment" value="right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                <span class="amt-radio"><input id="at-justified" type="radio" v-model="headings.alignment" value="justify"> <label for="at-justified">{{ trans('lang.justified') }}</label></span>   
                            </div>
                        </li>  
                    </ul>
                </div>
            </fieldset>
                <div class="amt-dhb-main_content">
                    <div class="amt-dhb-heading"><h3>{{ trans('lang.style') }}</h3></div>
                </div>
                <div class="amt-element-title amt-element-titlecontent">
                    <h6>{{ trans('lang.txt_clr') }}</h6>
                    <verte menuPosition="right" model="hex" v-model="headings.color"></verte>
                </div>
            <div class="amt-formcontactus">
                <fieldset>
                    <div class="form-group"><input type="text" v-model="headings.elementClass" :placeholder="trans('lang.elem_class')" class="form-control"></div>
                    <div class="form-group"><input type="text" v-model="headings.elementId" :placeholder="trans('lang.elem_id')" class="form-control"></div>
                </fieldset>
            </div>
             <div class="amt-dhb-main_content">
                <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
            </div>
            <div class="amt-formcontactus">
                <fieldset>
                    <div class="form-group">
                        <div class="amt-element-title">
                            <h6>{{ trans('lang.padding') }}</h6>
                            <div class="amt-guests-radioholder">
                                <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="headings.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                                <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="headings.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                            </div>
                        </div>
                        <div class="amt-spacing">
                            <ul class="amt-guestsinfo">
                                <li> 
                                    <div class="amt-guests-radioholder">
                                        <span class="amt-radio"><input type="number" v-model="headings.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                        <span class="amt-radio"><input type="number" v-model="headings.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                        <span class="amt-radio"><input type="number" v-model="headings.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                        <span class="amt-radio"><input type="number" v-model="headings.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                    </div>
                                </li>  
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="amt-element-title">
                            <h6>{{ trans('lang.margin') }}</h6>
                            <div class="amt-guests-radioholder">
                                <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="headings.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                                <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="headings.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                            </div>
                        </div>
                        <div class="amt-spacing">
                            <ul class="amt-guestsinfo">
                                <li> 
                                    <div class="amt-guests-radioholder">
                                        <span class="amt-radio"><input type="number" v-model="headings.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                        <span class="amt-radio"><input type="number" v-model="headings.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                        <span class="amt-radio"><input type="number" v-model="headings.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                        <span class="amt-radio"><input type="number" v-model="headings.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                    </div>
                                </li>  
                            </ul>
                        </div>
                    </div>
                    <div class="form-group"><input type="text" v-model="headings.sectionClass" :placeholder="trans('lang.elem_class')" class="form-control"></div>
                    <div class="form-group"><input type="text" v-model="headings.sectionId" :placeholder="trans('lang.elem_id')" class="form-control"></div>
                </fieldset>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['parent_index', 'element_id', 'headings'],
};
</script>
