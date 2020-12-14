<template>
  <div >
    <GmapMap style="width: 100%; height: 210px;" :zoom="7" :center="{lat: this.latitude, lng: this.longitude}"
        ref="map">
      <GmapMarker v-for="(marker, index) in markers"
        :key="index"
        :position="marker.latLng"
        />
    </GmapMap>
     <!-- <GmapMarker
    :key="index"
    v-for="(m, index) in markers"
    :position="m.position"
    :clickable="true"
    :draggable="true"
    @click="center=m.position"
  />
</GmapMap> -->
  </div>
</template>

<script>
export default {
    props: ['latitude', 'longitude'], 
    data () {
        return {
        markers: [],
        place: null,
        long_val:null,
        lat_val:null,
        show_map:false
        }
    },
    // mounted () {
    //     console.log(typeof 31.5727279)
    //     console.log(typeof this.longitude)
    //     this.long_val = this.longitude
    //     this.lat_val = this.latitude
    //     var self = this
    //     setTimeout(function() {
    //         console.log('gaskdgkas')
    //         if (self.longitude && self.latitude) {
    //             self.show_map = true
    //         }
    //     },2000 )
    // },
    description: `
    In which a random set of points are generated, and
    the bounds of the map are changed to fit the points
    `,
    watch: {
        markers(markers) {
        if (markers.length > 2) {
            const bounds = new google.maps.LatLngBounds()
            for (let m of markers) {
            bounds.extend(m.latLng)
            }
            this.$refs.map.fitBounds(bounds)
        }
        }
    },
    methods: {
        generate() {
        const spread = Math.random() + 0.001
        this.center = {
            lat: 1.38 + (Math.random() - 0.5) * spread,
            lng: 103.8 + (Math.random() - 0.5) * spread,
        }
        this.markers = _.range(30)
            .map(m => ({
            latLng: {
                lat: this.center.lat + (Math.random() - 0.5) * spread,
                lng: this.center.lng + (Math.random() - 0.5) * spread,
            }
            }))
        }
    }
}
</script>