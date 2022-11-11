<template>
  <div class="container-fluid my_header">

    <div class="d-flex justify-content-between">
      <h1>logo header</h1>

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
    background-color: #0f0e17;
    color: white;
  }
</style>