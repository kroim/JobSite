<template>
    <div class="amt-section-select amt-profile-settings">
        <ul class="at-profile-setting__imgs">
            <li v-for="(style, index) in getFooterStyles()" :key="index">
                <input type="radio" name="footer-image" :id="'footer-image1'+index" v-model='form.meta.footer' :value="style.value">
                <label :for="'footer-image1'+index">
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