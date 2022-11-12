<template>
    <div>
        <div class="d-flex align-items-center">
            <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-dark m-2" :class="(activeButton = 3)? 'color_button': ''" @click="getAllDeveloper(); activeButton = 3">Tutti</button>

                <button type="button" class="btn btn-outline-dark m-2" v-for="(specialization, index) in SelectedSpecializations" :key="index" 
                        @click="filter(specialization.id); activeButton = index" :class="(activeButton == index)?'color_button':''">
                        {{specialization.name}}
                </button>
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
                    <router-link class="btn btn-primary" :to="{name: 'profile-details', params: {slug: developer.slug}}">Vedi Profilo</router-link>
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
            searchBar: null,
            activeButton: 3,

            SelectedSpecializations: '',
            nomeSpec: '',
            }
        },
        methods:{
            getDeveloper(){
                axios.get('/api/developer/', {
                    params:{
                        inputText: this.nomeSpec,
                    }
                })
                .then((response) =>{
                    this.developers = response.data.results
                })  
            },
            getAllDeveloper(){
                axios.get('/api/developer/', {
                    params:{
                        inputText: '',
                    }
                })
                .then((response) =>{
                    this.developers = response.data.results
                })  
            },
            getSpecializations(){
                axios.get('/api/specializations/')
                .then((response) =>{
                    this.SelectedSpecializations = response.data.results
                    console.log(response.data.results);
                })  
            },
            filter(specialization){
                this.nomeSpec = specialization;
                this.getDeveloper();                
            },
        },
        mounted(){
            this.getDeveloper();
            this.getSpecializations();
        }
        
                
    }
</script>

<style>
.color_button{
    background-color: black;
    color: white;
}
</style>