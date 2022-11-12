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
            <div class="p-2 card m-3" style="width: 18rem;" v-for="(developer, index) in developers" :key="index">
                <div class="m-auto img-container rounded-circle">
                    <img :src="developer.cover" class="img-fluid" >
                </div>

                <div class="card-body">
                    <h4 class="card-title">{{developer.name}} {{developer.lastname}}</h4>
                    <h5 class="card-text" v-for="(specialization, index) in developer.specialization" :key="index">{{specialization.name}} Developer</h5>
                    <p class="card-text">Indirizzo: {{developer.address}}</p>
                    <p class="card-text">Telefono: {{developer.phone}}</p>
                    
                    

                    <div class="d-flex">
                        <p class="badge badge-dark mr-2" v-for="(skill, index) in developer.skill" :key="index">{{skill.name}}</p>
                    </div>
                    <router-link class="btn btn-show" :to="{name: 'profile-details', params: {slug: developer.slug}}">Vedi Profilo</router-link>
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

<style lang="scss">

.img-container {
    width: 120px;
    height: 120px;
    overflow: hidden;
}

.color_button{
    background-color: #141913;
    color: white;
}

.btn-show {
    background-color: #141913;
    color: #95f50f;
}

.btn-show:hover {
    background-color: #090908;
    box-shadow: 0.15rem 0.15rem 0.25rem #31372c;
    color: #95f50f;
}
</style>