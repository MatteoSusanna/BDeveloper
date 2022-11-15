<template>
    <div class="mb-5">
        <div class="d-flex justify-content-center align-items-center mt-4 mb-5">
            <h3 class="mt-2 mr-3">Filtra per specializzazione:</h3>
            <div class="input-group-prepend">

                <button type="button" class="btn search-btn m-2" :class="(activeButton == 3)? 'color-btn': ''" @click="getAllDeveloper(); activeButton = 3">Tutti</button>

                <button type="button" class="btn search-btn m-2" v-for="(specialization, index) in SelectedSpecializations" :key="index" 
                        @click="filter(specialization.id); activeButton = index" :class="(activeButton == index)?'color-btn':''">
                        {{specialization.name}}
                </button>
                
            </div>

            <h3 class="mt-2 mr-3">Filtra per voto:</h3>

            <div class="input-group-prepend">
                <select class="custom-select" id="inputGroupSelect03">
                    <option selected disabled>Seleziona voto</option>
                    <option v-for="n in 5" :key="n" :value="n" @click="filterVote(n)">{{n}}</option>
                </select>
            </div>

            <h3 class="mt-2 mr-3">Numero recensioni:</h3>
            
            <div class="input-group-prepend">
                <select class="custom-select" id="inputGroupSelect04">
                    <option selected disabled>Selezione per numero recensioni</option>
                    <option value="5">Maggiore di 5</option>
                    <option value="20">Maggiore di 20</option>
                    <option value="50">Maggiore di 50</option>
                    <option value="100">Maggiore di 100</option>
                </select>
            </div>

        </div>
        <!--Spinner di caricamento post-->
        <div class="d-flex justify-content-center" v-if="spinner">
            <div class="spinner-border text-secondary" role="status">
                <span class="sr-only"></span>
            </div>
        </div>

        <div class="d-flex flex-wrap">
            <div class="p-3 card profile-card" v-for="(developer, index) in developers" :key="index">
                <div class="m-auto img-container rounded-circle">
                    <img :src="developer.cover" class="img-fluid" >
                </div>

                <div class="card-body mb-5">

                    <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>
                    <h5 class="card-text" v-for="(specialization, index) in developer.specialization" :key="index">{{specialization.name}} Developer</h5>
    
                    <h5>Skills:</h5>
                    <div class="d-flex flex-wrap">
                        <p class="skill-container mr-2" v-for="(skill, index) in developer.skill" :key="index">{{skill.name}}</p>
                    </div>

                </div>

                <router-link class="btn btn-show mb-0" :to="{name: 'profile-details', params: {slug: developer.slug}}" title="Maggiori dettagli">Vedi Profilo</router-link>

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
            vote: '',
            }
        },
        methods:{
            getDeveloper(){
                this.spinner = true;
                axios.get('/api/developer/', {
                    params:{
                        inputText: this.nomeSpec,
                        inputVote: this.vote,
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
            filterVote(n){
                this.vote = n
                //this.getDeveloper();
            }
        },
        mounted(){
            this.getDeveloper();
            this.getSpecializations();
        }
        
                
    }
</script>

<style lang="scss">


.search-btn {
    border: 1px solid #141913;

    &:hover {
    background-color: #141913;
    color: #95f50f;
    }
}

.color-btn{
    background-color: #141913;
    color: #95f50f;
}

.profile-card {

    width: calc(25% - 20px);
    margin: 0 10px 36px 10px;
    border: 1px solid #141913;
    background-color: rgba($color: #000000, $alpha: 0);
    position: relative;

    &:hover {
        transform: scale(1.1);
        box-shadow: 0.15rem 0.15rem 0.25rem #141913;
    }

    .img-container {
        width: 120px;
        height: 120px;
        overflow: hidden;
    }

    .skill-container {
        min-width: 40px;
        min-height: 25px;
        background-color: #141913;
        border-radius: 5px;
        color: #95f50f;
        text-align: center;
        line-height: 25px;
        font-size: 15px;
        padding: 0 4px 0 4px;
    }

    .btn-show, .color- {
        background-color: #141913;
        color: #95f50f;
        position: absolute;
        left: 50%;
        transform: translate(-50%);
        bottom: 10px;

        &:hover {
            background-color: #090908;
            box-shadow: 0.15rem 0.15rem 0.25rem #31372c;
            color: #95f50f;
        }

    }

}
</style>