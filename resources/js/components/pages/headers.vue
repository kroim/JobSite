<template>
    <div class="amt-section-select amt-profile-settings">
        <ul class="at-profile-setting__imgs">
            <li v-for="(style, index) in getHeaderStyles()" :key="index">
                <input type="radio" name="image" :id="'image1'+index" v-model='form.meta.header' :value="style.value">
                <label :for="'image1'+index">
                    <span>
                        <img :src='style.img' alt="Image Description">
                        <span class="at-tick"><span><i class="fas fa-check"></i></span></span>
                    </span>
                </label>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props:['form']
}
</script>