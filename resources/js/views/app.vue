<template>
    <div>
        <MyAppHeader />
        <MyJumbo/>
        <MyMain />
        <MyFooter/>
    </div>
</template>

<script>
    import MyAppHeader from '../components/MyAppHeader.vue'
    import MyMain from '../components/MyMain.vue'
    import MyJumbo from '../components/MyJumbo.vue'
    import MyFooter from '../components/MyFooter.vue'

    export default {
        name: 'App',
        components: {
    MyMain,
    MyAppHeader,
    MyJumbo,
    MyFooter
}
    }
</script>