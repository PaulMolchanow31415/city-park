<script>
import { defineComponent } from 'vue'

export default defineComponent({
	name: 'PlaceLink',
	
	props: {
		placeName: {
			type: String,
			required: true,
		},
	},
	
	methods: {
		openGoogleMaps() {
			open(
        `https://www.google.com/maps/search/?api=1&query=${ encodeURIComponent(this.placeName) }`,
        '_blank'
      )
		},
	},
})
</script>

<template>
	<button type="button" @click="openGoogleMaps">
		{{ placeName }}
	</button>
</template>