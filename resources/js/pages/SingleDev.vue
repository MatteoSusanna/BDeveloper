<template>
  <h1>ciao</h1>
</template>

<script>
export default {
    name: 'SingleDev',
    data(){
        return{
            developer: [],
        }
    },
    methods:{
        getDeveloper(){
            let slug = this.$route.params.slug;

            axios.get('/api/developer/' + slug)
            .then(res =>{
                this.developer = res.data.results
                console.log(res.data.results)
            })
        }
    },
    mounted(){
        this.getDeveloper();
    }
}
</script>

<style>

</style>