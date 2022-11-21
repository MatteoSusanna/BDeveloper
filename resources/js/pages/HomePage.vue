<template>
    <div class="mb-5">
        <h1 class="text-center mt-4">Profili in evidenza</h1>
        <div class="my_card sponsored-container">
            
            <div class="d-flex flex-wrap" v-for="(developer, index) in sponsorizations" :key="index">
                <!-- card sviluppatori sponsorizzati-->
                <div class="p-3 card profile-card" v-if="developer.sponsorization.length > 0">
    
                    <div class="m-auto img-container rounded-circle">
                        <img :src="developer.cover" class="img-fluid" >
                    </div>

                    <div class="card-body mb-5">

                        <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>

                        <div v-if="developer.avg > 0">
                            <i class="fa-star" v-for="n in 5" :key="n" :class="(n>developer.avg)?'fa-regular':'fa-solid'"></i>
                        </div>
                        <div v-else>
                            <i v-for="n in 5" :key="n" class="fa-star fa-regular"></i>
                        </div>

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


        <div class="d-flex align-items-center justify-content-center filter-btn mt-2" :class="filterList == false ? 'mb-5':''"  v-on:click="filterList = !filterList">
            <h4 class="mt-2">Filtra per </h4>
            <i class="fa-solid fa-circle-chevron-up ml-1" :class="filterList == true? 'filter-arrow': ''"></i>
        </div>
        
        <div class="d-flex-column mt-4 mb-5 position-relative" v-show="filterList">
            <div class="d-flex justify-content-center">
                <h4 class="mr-3 align-self-center">Specializzazione:</h4>
                <div class="input-group-prepend">
                    <!-- filtraggio specializzazioni -->

                    <button type="button" class="btn search-btn m-2" v-for="(spec, index) in SelectedSpecializations" :key="index" 
                            @click="filter(spec.name); btnSpec = index" :class="(btnSpec == index)?'color-btn':''">
                            {{spec.name}}
                    </button>
                    
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <h4 class="mt-2 mr-3">Media voto:</h4>
                <!-- filtraggio per media voto -->
                <div class="input-group-prepend">

                    <button type="button" class="btn search-btn m-2" :class="(btnVote == n)? 'color-btn': ''" v-for="n in 5" :key="n" 
                        @click="filterVote(n); btnVote = n">
                        {{n}}
                    </button>

                </div>

                <h4 class="mt-2 mx-3">Numero recensioni:</h4>
                <!-- filtraggio numero recensioni -->            
                <div class="input-group-prepend">

                    <button type="button" class="btn search-btn m-2" :class="(btnRev == numero)? 'color-btn': ''" v-for="(numero, index) in numRecFilter" :key="index" 
                        @click="filterNum(numero); btnRev = numero">
                        Maggiore di {{numero}}
                    </button>
                </div>
                <!-- tasto reset -->
                <button type="button" class="btn reset" @click="getAllDeveloper(); btnSpec = 0.1"><i class="fa-solid fa-x"></i></button>
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
            <div class="p-3 card profile-card" v-for="(developer, index) in provaFiltraggio" :key="index" :class="{'d-none': developer.review.length < selectNum}" >
                <div class="m-auto img-container rounded-circle">
                    <img :src="developer.cover" class="img-fluid" >
                </div>

                <div class="card-body mb-5">

                    <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>

                    <div v-if="developer.avg > 0">
                        <i class="fa-star" v-for="n in 5" :key="n" :class="(n>developer.avg)?'fa-regular':'fa-solid'"></i>
                    </div>
                    <div v-else>
                        <i v-for="n in 5" :key="n" class="fa-star fa-regular"></i>
                    </div>

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
            btnSpec: 0.1,
            btnVote: '',
            btnRev: '',
            spinner: false,
            SelectedSpecializations: '', //specializzazioni recuperate back
            nomeSpec: '', //nome specializzazione
            numRecFilter: [5, 20, 50, 100],
            review: null,
            avgVote: null,
            selectNum: null,
            numeroEguale: '', //numero al click sul filtra voto
            filterList: false,
            sponsorizations: [],

            vote: null,

            }
        },
        methods:{
            getDeveloper(){
                this.spinner = true;
                axios.get('/api/developer/')
                .then((response) =>{
                    this.spinner = false;
                    this.developers = response.data.results

                    this.review = response.data.review

                    this.avgVote = response.data.avg
                    
                    console.log(this.developers)
                    /* console.log(this.media) */
                })  
            },
            getAllDeveloper(){
                this.numeroEguale = '';
                this.selectNum = null;
                this.nomeSpec = '';
                this.btnRev = '';
                this.btnVote = '';
                this.btnSpec = 0.1;

            },
            getSpecializations(){
                axios.get('/api/specializations/')
                .then((response) =>{
                    this.SelectedSpecializations = response.data.results
                })  
            },

            getSponsor(){
                axios.get('/api/sponsorization/')
                    .then((response) =>{
                        this.sponsorizations = response.data.results
                        console.log(response.data.results);
                        this.vote = response.data.avg
                        this.filterAvgSpons();
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


            filterAvgSpons(){
                this.sponsorizations.forEach(developer =>{
                    this.vote.forEach(avg =>{
                        if(avg.user_id == developer.id){
                            return developer.avg = avg.average
                        }
                            
                        if(developer.avg == undefined){
                            return developer.avg = '';
                        }
                            
                    })
                })

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
            this.getSponsor();
        },
        computed:{

            provaFiltraggio(){

                this.filterAvg();
                return this.developers.filter(develop =>{
                    for(let i = 0; i < develop.specialization.length; i++){
                        if(develop.specialization[i].name.includes(this.nomeSpec)){

                            if(this.review.length == 0){
                                return develop.specialization[i].name.includes(this.nomeSpec)
                            }else{
                                if(develop.review.length >= this.selectNum){
                                    if(develop.avg >= this.numeroEguale ){
                                        return develop.specialization[i].name.includes(this.nomeSpec)
                                    }
                                }
                            }   
                            
                            
                        }
                    }
                })
            }
            
        }
        
                
    }
</script>

<style lang="scss">
.sponsored-container {
    min-height: 600px;
}

.my_card{
    height: 400px;
    width: 100%;
    overflow: hidden;
    overflow-y: scroll;
    padding: 30px;
}

.filter-btn {
    border: #141913 solid 1px;
    border-radius: 5px;
    width: 180px;
    height: 40px;
    padding: 10px;
    font-size: 20px;
    cursor: pointer;
    margin: 0 auto;

    .filter-arrow {
        transform: rotate(180deg);
    }
}

.reset {
    font-size: 25px;
    position: absolute;
    right: 0;
    top: 0;
}

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