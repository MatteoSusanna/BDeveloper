<template>
    <div>
        <MyJumbo/>        
        <div class="mb-5 container">
            <!-- Sezione Sviluppatori sponsorizzati-->
            <div  v-if="sponsorizations.length > 0">

                <h1 class="text-center">Profili in evidenza</h1>

                <div class="sponsored_container">
                    <!-- card sviluppatori sponsorizzati-->
                    <div class="d-flex">
                        <div class=" mt-5 p-3 card profile-card " v-for="(developer, index) in sponsorizations" :key="index">
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

                                <router-link class="btn btn-show" :to="{name: 'profile-details', params: {slug: developer.slug}}" title="Maggiori dettagli">Vedi Profilo</router-link>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- **INIZIO Sezione Filtra per** -->
            <div class="d-flex align-items-center justify-content-center filter-btn mt-4" :class="filterList == false ? 'mb-3':''"  v-on:click="filterList = !filterList">
                <h4 class="mt-2">Filtra per </h4>
                <i class="fa-solid fa-circle-chevron-up ml-1" :class="filterList == true? 'filter-arrow': ''"></i>
            </div>
            
            <div class="d-flex-column mt-4 mb-5 position-relative" v-show="filterList">


                <div class="d-flex justify-content-center">
                    
                    <!-- filtraggio specializzazioni -->
                    <h4 class="mr-3 align-self-center">Specializzazione:</h4>
                    <div class="input-group-prepend">
                        <button type="button" class="btn search-btn m-2" v-for="(spec, index) in SelectedSpecializations" :key="index" 
                            @click="filter(spec.name); btnSpec = index" :class="(btnSpec == index)?'color-btn':''">
                            {{spec.name}}
                        </button>
                    </div>

                </div>

                <div class="d-flex justify-content-center align-items-center">
                    
                    <!-- filtraggio per media voto -->
                    <h4 class="mt-2 mr-3">Media voto:</h4>
                    <div class="input-group-prepend">
                        <button type="button" class="btn search-btn m-2" :class="(btnVote == n)? 'color-btn': ''" v-for="n in 5" :key="n" 
                            @click="filterVote(n); btnVote = n">
                            {{n}}
                        </button>
                    </div>
                

                    <!-- filtraggio numero recensioni -->            
                    <h4 class="mt-2 mx-3">Numero recensioni:</h4>
                    <div class="input-group-prepend">
                        <button type="button" class="btn search-btn m-2" :class="(btnRev == numero)? 'color-btn': ''" v-for="(numero, index) in numRecFilter" :key="index" 
                            @click="filterNum(numero); btnRev = numero">
                            Maggiore di {{numero}}
                        </button>
                    </div>


                    <!-- tasto reset -->
                    <div>
                        <button type="button" class="btn reset" @click="getAllDeveloper(); btnSpec = 0.1"><i class="fa-solid fa-x"></i></button>
                    </div>

                </div>
                
            </div>
            <!-- **FINE Sezione Filtra per** -->



            <!-- **INIZIO Ordina Filtra per** -->
            <div class="d-flex align-items-center justify-content-center filter-btn mt-2" :class="sortList == false ? 'mb-5':''"  v-on:click="sortList = !sortList">
                <h4 class="mt-2">Ordina per </h4>
                <i class="fa-solid fa-circle-chevron-up ml-1" :class="sortList == true? 'filter-arrow': ''"></i>
            </div>

            <div class=" mt-4 mb-5 position-relative text-center" v-show="sortList">
                
                    <button class="mr-2 btn search-btn m-2 p-1" :class="orderBtn == 1 ? 'color-btn' : '' " @click="sortB('review'); orderBtn=1">Recensioni <i class="fas fa-sort-amount-up"></i> </button>
            
                    <button class="mr-2 btn search-btn m-2 p-1" :class="orderBtn == 2 ? 'color-btn' : '' " @click="sortA('review'); orderBtn=2">Recensioni  <i class="fa-solid fa-arrow-down-wide-short"></i>  </button>
                
                    <button class="mr-2 btn search-btn m-2 p-1" :class="orderBtn == 3 ? 'color-btn' : '' " @click="sortB('avg'); orderBtn=3">Voto <i class="fas fa-sort-amount-up"></i> </button>
                
                    <button class="mr-2 btn search-btn m-2 p-1" :class="orderBtn == 4 ? 'color-btn' : '' " @click="sortA('avg'); orderBtn=4">Voto <i class="fa-solid fa-arrow-down-wide-short"></i>  </button>
            
                    <button class="btn reset" @click="sortReset('id'); orderBtn=0"><i class="fa-solid fa-x"></i></button>
                
            </div>
            <!-- **FINE Ordina Filtra per** -->



            <!-- **INIZIO Sezione Spinner** -->

            <!--Spinner di caricamento post-->
            <div class="d-flex justify-content-center" v-if="spinner">
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>

            <!-- Risultati trovati -->
            <h2 v-if="provaFiltraggio.length > 0" class="text-center my-4">Risultati trovati {{provaFiltraggio.length}}</h2>
            <h2 v-else class="text-center my-4">Nessun risultato trovato</h2>

            <!-- **FINE Sezione Spinner** -->



            <!-- **INIZIO Sezione Sviluppatori** -->
            <div class="d-flex flex-wrap" >
                
                <!-- card sviluppatori -->
                <div class="p-3 card profile-card container" v-for="(developer, index) in provaFiltraggio" :key="index" :class="{'d-none': developer.review.length < selectNum}" >
                    <div class="m-auto img-container rounded-circle">
                        <img :src="developer.cover" class="img-fluid" >
                    </div>

                    <div class="card-body mb-5">

                        <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>

                        <button type="button" class="my_button_review box">
                            Recensioni <span class="my_review">{{developer.review.length}}</span>
                        </button>

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
            <!-- **FINE Sezione Sviluppatori** -->

        </div>
        <MyFooter/>
    </div>

</template>

<script>
import MyJumbo from '../components/MyJumbo.vue'
import MyFooter from '../components/MyFooter.vue'
import axios from "axios";
    export default {
        name: 'HomePage',
        components: {
        MyJumbo,
        MyFooter,
        },
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
            sortList: false,
            vote: null,
            orderBtn: 0,
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

            sortB(prop){
                this.developers.sort((a,b) => {
                    if(a[prop] > b[prop] ){
                        return 1;
                    }
                    if( a[prop] < b[prop] ){
                        return -1;
                    }
                    return 0;
                })
            },
            sortA(prop){
                this.developers.sort((a,b) => {
                    if(a[prop] > b[prop] ){
                        return -1;
                    }
                    if( a[prop] < b[prop] ){
                        return 1;
                    }
                    return 0;
                })
            },

            sortReset(prop){
                this.developers.sort((a,b) => {
                    if(a[prop] > b[prop] ){
                        return 1;
                    }
                    if( a[prop] < b[prop] ){
                        return -1;
                    }
                    return 0;
                })
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

.my_button_review{
    outline: 2px solid #374566 ;
    outline-offset: 2px;
    margin-bottom: 8px;
    .my_review{

    }
}

.sponsored_container {
    min-height: 400px;
    overflow-x: auto;
    padding-left: 5px;
    padding-right: 20px;
    .sponsored-card-container {
        
        &:last-child{
        margin-right: 20px;
        }
    }
    
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
    flex-shrink: 0;

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