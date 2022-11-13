<template>
  <div class="container-fluid my_header mb-3">

    <div class="container d-flex justify-content-between">
      <a href="/">
        <img src="/img/logo.jpeg" class="img-fluid w-25">
      </a>

      <div class="d-flex align-items-center">
        <div v-if="!developer">
          <a class="p-3 link" href="/login">Login</a>
          <a class="p-3 link" href="/register">Registrati</a>
        </div>
        <div v-else>
          <a class="p-3" href="/admin"><i class="fs-5 fas fa-user"></i></a>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "MyAppHeader",
  data(){
    return{
      developer: null,
    }
  },
  // methods:{
  //   getDeveloper(){
  //     axios.get('/api/developer/').then((response) =>{
  //       this.developer = response.data.results
  //       console.log(response.data);
  //     })  
  //   }
  // },
  mounted(){
    // this.getDeveloper();
    axios.get('/api/developer/').then((response) =>{
        this.developer = response.data.results
        console.log(response.data);
      }) 
  }
};
</script>

<style lang="scss">
  .my_header{
    background-color: #141913;
    box-shadow: 0.5rem 0.25rem 0.25rem #2d362c;

    .link {
      color: #95f50f;
      font-size: 20px;
    }
  }
</style>