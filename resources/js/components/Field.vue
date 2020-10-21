<template>
    <div v-html="field.value"></div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    mounted() {
        this.field.fill = this.fill
    },
    methods: {
        fill(formData) {}
    }
}
</script>