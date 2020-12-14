<template>
    <div class="form-group form-group-half wt-formwithlabel job-cost-input">
        <date-pick 
            v-model="expiry_date"
            :weekdays="weekdayList" 
            :months="monthsList" 
            :nextMonthCaption="trans('lang.next_month')"
            :prevMonthCaption="trans('lang.pre_month')"
            :setTimeCaption="trans('lang.set_time')">
        </date-pick>
        <input
            type="hidden"
            name="expiry_date"
            :value="expiry_date"
            :placeholder="ph_expiry_date"
        />
    </div>
</template>
<script>
import DatePick from "vue-date-pick";
export default {
    components: { DatePick },
    props: ['ph_expiry_date', 'db_expiry_date', 'weekdays', 'months'], 
    data () {
        return {
            weekdayList:JSON.parse(this.weekdays),
            monthsList:JSON.parse(this.months),
            expiry_date: this.getExpiry(),
        }
    },
    methods: {
        getExpiry:function() {
            if (this.db_expiry_date) {
                return this.db_expiry_date
            } else {
                return this.ph_expiry_date
            }
        }
    }
}
</script>