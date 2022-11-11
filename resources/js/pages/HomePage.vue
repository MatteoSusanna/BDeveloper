<template>
    <div>
        <div class="d-flex align-items-center">
            <input type="text" class="form-control my-2" placeholder="Ricerca sviluppatori" style="width: 20rem;" v-model="searchBar">
            <div class="input-group-prepend">
                <button class="input-group-text" id="basic-addon1" @click="getDeveloper()" >Ricerca</button>
            </div>
        </div>

        <div class="d-flex">
            <div class="card m-3" style="width: 18rem;" v-for="(developer, index) in developers" :key="index">

                <div style="width: 10rem;" class="m-auto py-2">
                    <img :src="developer.cover" class="card-img-top img-fluid" >
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{developer.name}} {{developer.lastname}}</h5>
                    <p class="card-text">{{developer.address}}</p>
                    <p class="card-text">{{developer.phone}}</p>
                    
                    <p class="card-text" v-for="(specialization, index) in developer.specialization" :key="index">{{specialization.name}}</p>

                    <div class="d-flex">
                        <p class="badge badge-dark mr-2" v-for="(skill, index) in developer.skill" :key="index">{{skill.name}}</p>
                    </div>
                    <a href="#" class="btn btn-primary">Vedi profilo</a>
                </div>  
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'HomePage',
        data(){
            return{
            developers: [],
            searchBar: '',
            }
        },
        methods:{
            getDeveloper(){
                axios.get('/api/developer/', {
                    params:{
                        inputText: this.searchBar,
                    }
                })
                .then((response) =>{
                    this.developers = response.data.results
                    console.log(response.data);
                })  
            },
        },
        mounted(){
            this.getDeveloper();
        }
        
                
    }
</script>

<style>

</style>