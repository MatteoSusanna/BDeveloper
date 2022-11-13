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
            <h3>Invia un messaggio allo sviluppatore</h3>
            <!-- In caso messaggio inviato con successo -->
            <div class="alert alert-success" role="alert" v-if="status">
                Messaggio inviato con successo!!
            </div>

            <!-- form invio messaggio sviluppatore -->
            <form @submit.prevent="sendMessage()">
                <!-- Contenuto nome -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" :class="(errors.name)?'is-invalid':''" id="nome" v-model="name" required placeholder="Scrivi il tuo nome">

                    <div class="invalid-feedback" v-for="(error, index) in errors.name" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto cognome -->
                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" class="form-control" :class="(errors.lastname)?'is-invalid':''" id="cognome" v-model="lastname" required placeholder="Scrivi il tuo cognome">

                    <div class="invalid-feedback" v-for="(error, index) in errors.lastname" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" :class="(errors.email)?'is-invalid':''" id="email" v-model="email" required placeholder="Scrivi la tua email">

                    <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto Messaggio -->
                <div class="form-group">
                    <label for="messaggio">Messaggio</label>
                    <textarea class="form-control" :class="(errors.text)?'is-invalid':''" id="messaggio" rows="6" v-model="text" required placeholder="Scrivi il tuo messaggio per lo sviluppatore"></textarea>

                    <div class="invalid-feedback" v-for="(error, index) in errors.text" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Bottone invio messaggio -->
                <button class="btn btn-primary my-3" type="button" disabled v-if="(disabledButton)">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Invio
                </button>
                
                <button v-else type="submit" class="btn btn-dark my-3">Invia messaggio</button>
                <a href="/" class="btn btn-dark my-3">Indietro</a>
            </form>
        </div>


        <div>
            <h3>Invia una recensione allo sviluppatore</h3>
            <!-- In caso recensione inviato con successo -->
            <div class="alert alert-success" role="alert" v-if="status">
                Recensione inviato con successo!!
            </div>

            <!-- form invio recensione sviluppatore -->
            <form @submit.prevent="sendReview()">
                <!-- Contenuto nome -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" :class="(errors.nome)?'is-invalid':''" id="nome" v-model="nome" required placeholder="Scrivi il tuo nome">

                    <div class="invalid-feedback" v-for="(error, index) in errors.nome" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto cognome -->
                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" class="form-control" :class="(errors.cognome)?'is-invalid':''" id="cognome" v-model="cognome" required placeholder="Scrivi il tuo cognome">

                    <div class="invalid-feedback" v-for="(error, index) in errors.cognome" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Contenuto Messaggio -->
                <div class="form-group">
                    <label for="messaggio">Messaggio</label>
                    <textarea class="form-control" :class="(errors.messaggio)?'is-invalid':''" id="messaggio" rows="6" v-model="messaggio" required placeholder="Scrivi la recensione per lo sviluppatore"></textarea>

                    <div class="invalid-feedback" v-for="(error, index) in errors.messaggio" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Voto Recensione -->
                <div class="form-group col-md-4">
                    <label for="inputState">Voto</label>
                    <select id="inputState" class="form-control" v-model="voto">
                        <option selected disabled>Scegli il tuo voto da 1 a 5</option>
                        <option value="1" required>1</option>
                        <option value="2" required>2</option>
                        <option value="3" required>3</option>
                        <option value="4" required>4</option>
                        <option value="5" required>5</option>
                    </select>
                </div>

                <!-- Bottone invio recensione -->
                <button class="btn btn-primary my-3" type="button" disabled v-if="(disabledButton)">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Invio
                </button>
                
                <button v-else type="submit" class="btn btn-dark my-3">Invia Recensione</button>
                <a href="/" class="btn btn-dark my-3">Indietro</a>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SingleDev',
    data(){
        return{
            //messaggio
            name: '',
            lastname: '',
            email: '',
            text: '',
            //recensione
            nome: '',
            cognome: '',
            messaggio: '',
            voto: '',

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
            })
        },
        //invia messaggio
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

                });                
        },
        //invia recensione
        sendReview(){
            this.disabledButton = true;
            axios.post('/api/review', {
                    'nome': this.nome,
                    'cognome': this.cognome,
                    'messaggio': this.messaggio,
                    'voto': this.voto,
                    'user_id': this.idDev,
                }).then(res =>{
                    this.status = res.data.status;
                    this.disabledButton = false;

                    if(this.status){
                        this.error = {};
                        this.nome = '';
                        this.cognome = '';
                        this.messaggio = '';
                        this.voto = '';
                    }else{
                        this.errors = res.data.error;
                    }

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