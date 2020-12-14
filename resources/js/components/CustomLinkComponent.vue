<template>
    <div>
        <div class="wt-formtheme wt-skillsform wt-pageorder">
            <transition name="fade">
                <div v-if="isShow" class="sj-jump-messeges">{{ trans('lang.no_record') }}</div>
            </transition>
            <fieldset>
                <div class="wt-multiple-input">
                    <div class="form-group">
                        <input v-model="menu.custom_title" type="text" class="form-control" min="0" :placeholder="trans('lang.title')">
                    </div>
                    <div class="form-group">
                        <input v-model="menu.custom_link" type="text" class="form-control" min="0" :placeholder="trans('lang.custom_link')">
                    </div>
                     <div class="form-group" v-if="parent_menus.length > 0">
                        <span class="wt-select">
                            <select id="pages_select" v-model="menu.parent_menu">
                                <option  value="">
                                    {{ trans('lang.select_parent_menu') }}
                                </option>
                                <option v-for="(menu, index) in parent_menus" :key="index" :value="menu.custom_slug">
                                    {{menu.custom_title}}
                                </option>
                            </select>
                        </span>
                    </div>
                    <div class="form-group wt-btnarea">
                        <a href="javascript:void(0);" class="wt-btn" @click="addCustomLink">{{trans('lang.add_custom_link')}}</a>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="wt-myskills">
            <ul id="skill_list" class="sortable list">
                <li v-for="(menuItem, index) in stored_menus" :key="index" v-if="stored_menus" class="skill-element" :ref="'skill-'+index">
                    <div class="wt-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">
                        {{menuItem.custom_title}} (<em class="skill-val">{{menuItem.custom_link}}</em>)</span>
                    <span class="skill-dynamic-field sss">
                        <input type="hidden" v-bind:name="'menu[custom_links]['+index+'][parent_menu]'" :value="menuItem.parent_menu">
                        <input type="hidden" v-bind:name="'menu[custom_links]['+index+'][custom_link]'" :value="menuItem.custom_link">
                        <input type="hidden" v-bind:name="'menu[custom_links]['+index+'][custom_slug]'" :value="menuItem.custom_slug">
                        <input type="text" v-bind:name="'menu[custom_links]['+index+'][custom_title]'" :value="menuItem.custom_title">
                    </span>
                    <div class="wt-rightarea">
                        <a href="javascript:void(0);" class="wt-deleteinfo delete-skill" @click="removeStoredPage(index, menuItem.custom_slug)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
                <li v-for="(customItem, index) in custom_links" :key="index+customItem.count">
                    <div class="wt-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">{{customItem.custom_title}} (<em class="skill-val">{{customItem.custom_link}}</em>)</span>
                    <span class="skill-dynamic-field">
                        <input type="hidden" v-bind:name="'menu[custom_links]['+[customItem.count]+'][parent_menu]'" :value="customItem.parent_menu">
                        <input type="hidden" v-bind:name="'menu[custom_links]['+[customItem.count]+'][custom_link]'" :value="customItem.custom_link">
                        <input type="hidden" v-bind:name="'menu[custom_links]['+[customItem.count]+'][custom_slug]'" :value="customItem.custom_slug">
                        <input type="text" v-bind:name="'menu[custom_links]['+[customItem.count]+'][custom_title]'" :value="customItem.custom_title">
                    </span>
                    <div class="wt-rightarea">
                        <a href="javascript:void(0);" class="wt-deleteinfo" @click="removeOrder(index, customItem.custom_slug)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
<script>
 export default{
        data() {
            return {
                custom_links:[],
                isShow: false,
                pagesLength:'',
                pageOrdersList: [],
                parent_menus:[],
                selected_page: '',
                selected_page_order:'',
                selected_page_text:'',
                edit_class: false,
                edit_skill: '',
                page: {
                    id: '',
                    order: '',
                    title:'',
                    type:'',
                    count: 0
                },
                menu: {
                    parent_menu:'',
                    custom_link:'',
                    custom_title:'',
                    custom_slug:'',
                    count: 0
                },
                pages: [],
                stored_menus: [],
                counts:0,
                notificationSystem: {
                    error: {
                        position: "topRight",
                        timeout: 4000
                    }
                },
            }
        },
        methods: {
            createSlug (string) {
                return string
                    .toString()
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, "-")
                    .replace(/[^\w\-]+/g, "")
                    .replace(/\-\-+/g, "-")
                    .replace(/^-+/, "")
                    .replace(/-+$/, "");
            },
            showError(error){
                return this.$toast.error(' ', error, this.notificationSystem.error);
            },
            getPages(){
                let self = this;
                axios.get(APP_URL + '/get-parent-menu-list')
                .then(function (response) {
                    self.parent_menus = response.data.parent_menus;
                    if (self.parent_menus) {
                        self.pagesLength = self.parent_menus.length
                    }
                });
            },
            getSavedPages(){
                let self = this;
                axios.get(APP_URL + '/get-saved-custom-menus-list')
                .then(function (response) {
                    self.stored_menus = response.data.stored_menus;
                });
            },
            addCustomLink: function () {
                if (this.menu.custom_title == '') {
                    this.showError('Custom title field is required');
                } else {
                    var custom_list_count = jQuery('.wt-btn').parents('.wt-skillsform').next('.wt-myskills').find('ul#skill_list li').length;
                    custom_list_count = custom_list_count - 1;
                    this.menu.count = custom_list_count;
                    this.menu.custom_slug = this.createSlug(this.menu.custom_title) + '-'+this.menu.count++
                    this.custom_links.push(Vue.util.extend({}, this.menu, this.menu.count++, this.menu.custom_title, this.menu.custom_link, this.menu.parent_menu, this.menu.custom_slug ))
                    if (!this.menu.parent_menu) {
                        this.parent_menus.push(this.menu)
                    }
                    this.menu = {  parent_menu:'', custom_link:'', custom_title:'', custom_slug:'',count: 0 }
                }
            },
            removeOrder: function (index, slug) {
                var self = this;
                this.$swal({
                    title: "Delete Order",
                    text: "Are you Sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        var count_index = 0
                        self.parent_menus.forEach(element => {
                            if (element.custom_slug == slug) {
                                self.parent_menus.splice(count_index, 1);
                            }
                            count_index++
                        }),

                        self.custom_links.forEach(element => {
                            if (element.parent_menu == slug) {
                                element.parent_menu = ''
                            }
                            
                        }),
                        self.custom_links.splice(index, 1);
                        self.$swal('Deleted', 'Custom Menu Deleted', 'success')
                        self.pagesLength++
                    } else {
                        this.$swal.close()
                    }
                  })
            },
            removeStoredPage: function (index, slug) {
                var self = this;
                this.$swal({
                    title: "Delete Order",
                    text: "Are you Sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        var count_index = 0
                        self.parent_menus.forEach(element => {
                            if (element.custom_slug == slug) {
                                self.parent_menus.splice(count_index, 1);
                            }
                            count_index++
                        }),
                        self.stored_menus.forEach(element => {
                            if (element.parent_menu == slug) {
                                element.parent_menu = ''
                            }
                        }),
                        self.stored_menus.splice(index, 1);
                        self.$swal('Deleted', 'Custom Menu Deleted', 'success')
                        self.pagesLength++
                    } else {
                        this.$swal.close()
                    }
                  })
            },
            editInput: function (index) {
                this.edit_class = true;
            }
        },
        created: function() {
            this.getPages();
            this.getSavedPages();
        } 
    }
</script>