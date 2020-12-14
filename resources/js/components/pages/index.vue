<template>
    <div class="col-lg-8">
        <div class="at-dhb-main_content at-listing-holder">
            <div class="at-dhb-heading">
                <h3>{{ $t('pages') }}</h3>
            </div>
            <router-link :to="{ name: 'addPage' }" class="at-btn float-right">
                <span> 
                    {{ $t('add') }}
                </span> 
            </router-link>
            <table class="table at-my-payouts__table at-listing-table" id="at-del-table">
                <thead>
                    <tr>
                        <th scope="col">{{ $t('name') }}</th>
                        <th scope="col">{{ $t('slug') }}</th>
                        <th scope="col">{{ $t('action') }}</th>
                    </tr>
                </thead>
                <tr v-for="(item, index) in pages.data" :key="index">
                    <td>{{item.title}}</td>
                    <td>{{item.slug}}</td>
                    <td>
                        <router-link :to="{ name: 'editPage', params: { id: item.id }}" class="at-actionbtn at-edit">
                            {{ $t('edit') }}
                        </router-link>
                        <delete :id= item.id :message="$t('page_deleted')"
                           :url="'/api/delete-page'" :index="index" :storeActionURL='"page/deletePage"'
                        />
                    </td>
                </tr>
            </table>
            <nav class="at-pagination at-mt-30">
                <pagination :data="pages" @pagination-change-page="getPages"></pagination>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    created: function() {
        this.getPages()
    },
    methods:{
        async getPages(page='') {

        }
    }  
}
</script>