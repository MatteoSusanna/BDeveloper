<template>
  <div class="container-fluid my_header">

    <div class="d-flex justify-content-between">
      <div style="width: 10rem;">
        <img src="/img/logo.PNG" class="img-fluid ">
      </div>

      <div class="d-flex align-items-center">
        <a class="p-3" href="/login">Login</a>
        <a class="p-3" href="/register">Registrati</a>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: "MyAppHeader",
  data(){
    return{
      developer: [],
    }
  },
  methods:{
    getDeveloper(){
      axios.get('/api/developer/').then((response) =>{
        this.developer = response.data.results
        console.log(response.data);
      })  
    }
  },
  mounted(){
    this.getDeveloper();
  }
};
</script>

<style>
  .my_header{
    background-color: black;
    color: white;
  }
</style>