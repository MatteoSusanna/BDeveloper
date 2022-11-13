<template>
    <div>
        <div class="d-flex justify-content-center align-items-center mt-4 mb-5">
            <h3 class="mt-2 mr-3">Filtra per specializzazione:</h3>
            <div class="input-group-prepend">

                <button type="button" class="btn btn-outline-dark m-2" :class="(activeButton == 3)? 'color_button': ''" @click="getAllDeveloper(); activeButton = 3">Tutti</button>

                <button type="button" class="btn btn-outline-dark m-2" v-for="(specialization, index) in SelectedSpecializations" :key="index" 
                        @click="filter(specialization.id); activeButton = index" :class="(activeButton == index)?'color_button':''">
                        {{specialization.name}}
                </button>
                
            </div>
        </div>
        <!--Spinner di caricamento post-->
        <div class="d-flex justify-content-center" v-if="spinner">
            <div class="spinner-border text-secondary" role="status">
                <span class="sr-only"></span>
            </div>
        </div>

        <div class="d-flex">
            <div class="p-2 card m-3 profile-card bg-light" style="width: 18rem;" v-for="(developer, index) in developers" :key="index">
                <div class="m-auto img-container rounded-circle">
                    <img :src="developer.cover" class="img-fluid" >
                </div>

                <div class="card-body">

                    <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>
                    <h5 class="card-text" v-for="(specialization, index) in developer.specialization" :key="index">{{specialization.name}} Developer</h5>
                    <p class="card-text">Indirizzo: {{developer.address}}</p>
                    <p class="card-text">Telefono: {{developer.phone}}</p>
    
                    <h5>Skills:</h5>
                    <div class="d-flex">
                        <p class="badge badge-dark mr-2" v-for="(skill, index) in developer.skill" :key="index">{{skill.name}}</p>
                    </div>

                    <router-link class="btn btn-show" :to="{name: 'profile-details', params: {slug: developer.slug}}" title="Maggiori dettagli">Vedi Profilo</router-link>

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
            spinner: false,

            SelectedSpecializations: '',
            nomeSpec: '',
            }
        },
        methods:{
            getDeveloper(){
                this.spinner = true;
                axios.get('/api/developer/', {
                    params:{
                        inputText: this.nomeSpec,
                    }
                })
                .then((response) =>{
                    this.spinner = false;
                    this.developers = response.data.results
                    console.log(response.data)
                })  
            },
            getAllDeveloper(){
                this.spinner = true;
                axios.get('/api/developer/', {
                    params:{
                        inputText: '',
                    }
                })
                .then((response) =>{
                    this.spinner = false;
                    this.developers = response.data.results
                })  
            },
            getSpecializations(){
                axios.get('/api/specializations/')
                .then((response) =>{
                    this.SelectedSpecializations = response.data.results
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

<style lang="scss">

.color_button{
    background-color: #141913;
    color: #95f50f;
}

.profile-card {

    &:hover {
        transform: scale(1.1);
        box-shadow: 0.15rem 0.15rem 0.25rem #141913;
    }

    .img-container {
        width: 120px;
        height: 120px;
        overflow: hidden;
    }

    .btn-show {
        background-color: #141913;
        color: #95f50f;

        &:hover {
            background-color: #090908;
            box-shadow: 0.15rem 0.15rem 0.25rem #31372c;
            color: #95f50f;
        }

    }

}
</style>