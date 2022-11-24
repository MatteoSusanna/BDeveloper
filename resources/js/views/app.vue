<template>
    <div>
        <MyAppHeader />
        <MyMain />
    </div>
</template>

<script>
    import MyAppHeader from '../components/MyAppHeader.vue'
    import MyMain from '../components/MyMain.vue'

    export default {
        name: 'App',
        components: {
            MyMain,
            MyAppHeader,

        }
    }
</script>