<template>
    <div class="mb-5">
        <div class="d-flex justify-content-center align-items-center mt-4 mb-5">
            <h3 class="mt-2 mr-3">Filtra per specializzazione:</h3>
            <div class="input-group-prepend">
                <!-- filtraggio specializzazioni -->
                <button type="button" class="btn search-btn m-2" :class="(activeButton == 3)? 'color-btn': ''" @click="getAllDeveloper(); activeButton = 3">Tutti</button>

                <button type="button" class="btn search-btn m-2" v-for="(spec, index) in SelectedSpecializations" :key="index" 
                        @click="filter(spec.name); activeButton = index" :class="(activeButton == index)?'color-btn':''">
                        {{spec.name}}
                </button>
                
            </div>

            <h3 class="mt-2 mr-3">Filtra per voto:</h3>
            <!-- filtraggio per media voto -->
            <div class="input-group-prepend">

                <button type="button" class="btn search-btn m-2" v-for="n in 5" :key="n" 
                    @click="filterVote(n)">
                    {{n}}
                </button>

            </div>

            <h3 class="mt-2 mr-3">Numero recensioni:</h3>
            <!-- filtraggio numero recensioni -->            
            <div class="input-group-prepend">

                <button type="button" class="btn search-btn m-2" v-for="(numero, index) in numRecFilter" :key="index" 
                    @click="filterNum(numero)">
                    Maggiore di {{numero}}
                </button>
            </div>

        </div>
        <!--Spinner di caricamento post-->
        <div class="d-flex justify-content-center" v-if="spinner">
            <div class="spinner-border text-secondary" role="status">
                <span class="sr-only"></span>
            </div>
        </div>

        <div class="d-flex flex-wrap" >
            <!-- card sviluppatori -->
            <div class="p-3 card profile-card" v-for="(developer, index) in provaFiltraggio" :key="index" :class="{'d-none': developer.review.length < selectNum}">
                <div class="m-auto img-container rounded-circle">
                    <img :src="developer.cover" class="img-fluid" >
                </div>

                <div class="card-body mb-5">

                    <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>
                    {{developer.avg}}

                    <h4>Specializzazioni:</h4>
                    <div class="d-flex flex-wrap">
                        <h4 class="box mr-2" v-for="(specialization, index) in developer.specialization" :key="index">{{specialization.name}}</h4>
                    </div>
    
                    <h5 class="mt-3">Skills:</h5>
                    <div class="d-flex flex-wrap">
                        <h5 class="box mr-2" v-for="(skill, index) in developer.skill" :key="index">{{skill.name}}</h5>
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
            SelectedSpecializations: '', //specializzazioni recuperate back
            nomeSpec: '', //nome specializzazione
            numRecFilter: [5, 20, 50, 100],
            
            avgVote: null,

            selectNum: null,

            numeroEguale: '', //numero al click sul filtra voto
            }
        },
        methods:{
            getDeveloper(){
                this.spinner = true;
                axios.get('/api/developer/')
                .then((response) =>{
                    this.spinner = false;
                    this.developers = response.data.results

                    this.avgVote = response.data.avg
                    
                    console.log(this.developers)
                    /* console.log(this.media) */
                })  
            },

            getAllDeveloper(){
                this.spinner = true;
                this.selectNum = '';
                axios.get('/api/developer/')
                .then((response) =>{
                    this.spinner = false;
                    this.developers = response.data.results

                    this.avgVote = response.data.avg

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
                //this.getDeveloper();                
            },
            filterNum(numero){
                console.log(this.selectNum)
                this.selectNum = numero;
            },            




            filterVote(n){
                console.log(n)
                this.numeroEguale = n
                //this.getDeveloper();  

                
            },


            filterAvg(){
                this.developers.forEach(developer =>{
                    this.avgVote.forEach(avg =>{
                        if(avg.user_id == developer.id){
                            return developer.avg = avg.average
                        }
                            
                        if(developer.avg == undefined){
                            return developer.avg = '';
                        }
                            
                    })
                })

            }


            
        },
        mounted(){
            this.getDeveloper();
            this.getSpecializations();
        },
        computed:{

            provaFiltraggio(){


                this.filterAvg();
                return this.developers.filter(develop =>{
                    for(let i = 0; i < develop.specialization.length; i++){
                        if(develop.specialization[i].name.includes(this.nomeSpec)){
                            return develop.specialization[i].name.includes(this.nomeSpec)  && develop.review.length >= this.selectNum  && develop.avg >= this.numeroEguale 
                        }
                    }
                }) 
            },
        }
    }
</script>

<style lang="scss">
.d-block{
    display: block;
}

.d-none{
    display: none;
}


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

    .box {
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