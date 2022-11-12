<template>
    <div class="container">
        <div class="card m-3" style="width: 18rem;">
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
            </div>  
        </div>
        <div>
            <!-- form invio messaggio sviluppatore -->
            <form @submit.prevent="sendMessage()">
                <!-- Contenuto nome -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" :class="(errors.name)?'is-invalid':''" id="nome" v-model="name">

                    <div class="invalid-feedback" v-for="(error, index) in errors.name" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto cognome -->
                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" class="form-control" :class="(errors.lastname)?'is-invalid':''" id="cognome" v-model="lastname">

                    <div class="invalid-feedback" v-for="(error, index) in errors.lastname" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" :class="(errors.email)?'is-invalid':''" id="email" v-model="email">

                    <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto Messaggio -->
                <div class="form-group">
                    <label for="messaggio">Messaggio</label>
                    <textarea class="form-control" :class="(errors.text)?'is-invalid':''" id="messaggio" rows="6" v-model="text"></textarea>

                    <div class="invalid-feedback" v-for="(error, index) in errors.text" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Dai un voto -->
                <label for="messaggio">Lascia un voto da 1 a 5</label>
                <div>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </div>

                <!-- Bottone invio messaggio -->
                <button class="btn btn-primary" type="button" disabled v-if="(disabledButton)">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Invio
                </button>
                
                <button v-else type="submit" class="btn btn-primary">Invia messaggio</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SingleDev',
    data(){
        return{
            name: '',
            lastname: '',
            email: '',
            text: '',
            developer: null,
            idDev: '',
            errors: {},
            status: false,
            disabledButton: false,
        }
    },
    methods:{
        getDeveloper(){
            let slug = this.$route.params.slug;

            axios.get('/api/developer/' + slug)
            .then(res =>{
                this.developer = res.data.result
                this.idDev = res.data.result.id
                console.log(res.data.result)
                
            })
        },
        sendMessage(){
            this.disabledButton = true;
            axios.post('/api/message', {
                    'name': this.name,
                    'lastname': this.lastname,
                    'email': this.email,
                    'text': this.text,
                    'user_id': this.idDev,
                }).then(res =>{
                    this.status = res.data.status;
                    this.disabledButton = false;

                    if(this.status){
                        this.error = {};
                        this.name = '';
                        this.lastname = '';
                        this.email = '';
                        this.text = '';
                    }else{
                        this.errors = res.data.error;
                    }
                    console.log(this.errors)
                    console.log(res)

                });                
        }
    },
    mounted(){
        this.getDeveloper();
    }
}
</script>

<style>

</style>